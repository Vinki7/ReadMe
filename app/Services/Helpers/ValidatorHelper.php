<?php

namespace App\Services\Helpers;

use Illuminate\Support\Facades\Validator;

/**
 * ValidatorHelper is a helper class for validating user input.
 * It provides methods to validate email, username, password, name, and surname.
 * It also combines results from multiple validations and resets the state.
 */
class ValidatorHelper
{
    /**
     * @var array $results
     * @var array $messages
     */
    private array $results = [];
    private array $messages = [];

    public function getResults(): array
    {
        return $this->results;
    }

    public function getMessages(): array
    {
        return $this->messages;
    }

    /**
     * Validate the email address.
     *
     * @param string $email
     * @return bool
     */
    public function validateEmail(string $email): bool
    {
        $validator = Validator::make(['email' => $email], [
            'email' => 'required|email|max:255|unique:users,email',
        ]);

        $result = $this->evaluate($validator);

        return $result;
    }

    /**
     * Validate the username.
     *
     * @param string $username
     * @return bool
     */
    public function validateUsername(string $username): bool
    {
        $validator = Validator::make(['username' => $username], [
            'username' => 'required|string|max:255|unique:users,username',
        ]);

        $result = $this->evaluate($validator);

        return $result;
    }

    /**
     * Validate the password.
     *
     * @param string $password
     * @param string $passwordConfirmation
     * @return bool
     */
    public function validatePassword(string $password, string $passwordConfirmation): bool
    {
        $validator = Validator::make([
            'password' => $password,
            'password_confirmation' => $passwordConfirmation,
        ], [
            'password' => 'required|confirmed|min:8',
            'password_confirmation' => 'required_with:password|same:password|min:8',
        ]);

        $result = $this->evaluate($validator);

        return $result;
    }

    /**
     * Validate the name.
     *
     * @param string $name
     * @return bool
     */
    public function validateName(string $name): bool
    {
        $validator = Validator::make(['name' => $name], [
            'name' => 'required|string|max:255',
        ]);

        $result = $this->evaluate($validator);

        return $result;
    }

    /**
     * Validate the surname.
     *
     * @param string $surname
     * @return bool
     */
    public function validateSurname(string $surname): bool
    {
        $validator = Validator::make(['surname' => $surname], [
            'surname' => 'required|string|max:255',
        ]);

        $result = $this->evaluate($validator);

        return $result;
    }

    /**
     * Reset the results and messages to refresh the state of the instance.
     * This is useful when you want to reuse the same instance for a new validation process.
     *
     * @return void
     */
    public function reset(): void
    {
        $this->results = [];
        $this->messages = [];
    }

    /**
     * Combine results from multiple validations.
     * If any validation fails, it returns false.
     * If all validations pass, it returns true.
     *
     * @param array $results
     * @return bool
     */
    public function combineResults(array $results): bool
    {
        foreach ($results as $result) {
            if (!$result) {
                return false;
            }
        }

        return true;
    }

    /**
     * Evaluate the validation result.
     * If validation fails, it merges the error messages into the messages array.
     * If validation passes, it merges the validated data into the results array.
     *
     * @param \Illuminate\Validation\Validator $validator
     * @return bool
     */
    private function evaluate(\Illuminate\Validation\Validator $validator): bool
    {
        if ($validator->fails()) {
            $this->messages = array_merge($this->messages, $validator->errors()->messages());
            return false;
        }

        $this->results = array_merge($this->results, $validator->validated());
        return true;
    }
}
