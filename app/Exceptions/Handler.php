<?php

namespace App\Exceptions;

use Illuminate\Database\QueryException;
use Illuminate\Session\TokenMismatchException;
use Throwable;
use PDOException;

class Handler
{
    public function render($request, Throwable $exception)
    {
        print('Exception: ' . get_class($exception));

        if ($exception instanceof PDOException || $exception instanceof QueryException) {
            if (str_contains($exception->getMessage(), 'could not connect to server')) {
                return response()->view('errors.db-down', [], 503);
            }
        }

        if ($exception instanceof TokenMismatchException) {
            return redirect()->back()->withErrors([
                'token' => 'Session expired. Please try again.'
            ])->withInput($request->except('_token'));
        }

        return response()->view('errors.500', [], 500)
            ->header('Content-Type', 'text/html');
    }
}
