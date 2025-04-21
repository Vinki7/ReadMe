<?php

namespace App\Services\Helpers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;
use Illuminate\Validation\ValidationException;

/**
 * ValidatorHelper is a helper class for validating user input.
 * It provides methods to validate email, username, password, name, and surname.
 * It also combines results from multiple validations and resets the state.
 */
class ValidationService
{
    /**
     * @var array $results
     * @var array $messages
     */
    private array $results = [];
    private MessageBag $messages;

    public function __construct()
    {
        $this->messages = new MessageBag();
    }

    /**
     * Provides results of the validation.
     * This method returns an array of validated data.
     *
     * @return array
     */
    public function getResults(): array
    {
        return $this->results;
    }

    /**
     * Provides messages of the validation.
     * This method returns a MessageBag instance containing error messages.
     *
     * @return MessageBag
     */
    public function getMessages(): MessageBag
    {
        return $this->messages;
    }

    /**
     * Validate the given field with the specified rules.
     * This method uses the Laravel Validator to validate the field.
     *
     * @param string $field
     * @param mixed $value
     * @param array $rules
     * @return bool
     */
    public function validateField(string $field, mixed $value, array $rules): bool
    {
        $data = is_array($value) ? $value : [$field => $value];

        $validator = Validator::make(
            $data,
            is_array($rules[$field] ?? null) ? $rules : [$field => $rules]
        );

        if ($validator->fails()) {
            $this->messages->merge($validator->errors());

            return false;
        }

        $this->results = array_merge($this->results, $validator->validated());

        return true;
    }

    public function hasErrors(): bool
    {
        return $this->messages->isNotEmpty();
    }

    /**
     * Check if the validation has passed. If not, throw a ValidationException which contains the error messages.
     *
     * @return void
     */
    public function throwIfInvalid(): void
    {
        if ($this->messages->isNotEmpty()) {
            throw ValidationException::withMessages($this->messages->toArray());
        }
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
        $this->messages = new MessageBag();
    }

    /**
     * Combine results from multiple validations.
     * If any validation fails, it returns false.
     * If all validations pass, it returns true.
     *
     * @return bool
     */
    public function combineResults(): bool
    {
        if ($this->messages->isNotEmpty()) {
            return false;
        }

        return true;
    }
}
