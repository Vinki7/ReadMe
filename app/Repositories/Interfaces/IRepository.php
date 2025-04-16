<?php

namespace App;

/**
 * Interface IRepository
 * @package App
 * @description This interface defines the basic CRUD operations for a repository.
 *             It can be implemented by any class that needs to perform CRUD operations on a model.
 */
interface IRepository
{
    /**
     * Get all records from the repository.
     *
     * @return mixed
     */
    public function getAll();

    /**
     * Get a record by its ID.
     *
     * @param int $id
     * @return mixed
     */
    public function getById($id);

    /**
     * Create a new record in the repository.
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data);

    /**
     * Update an existing record in the repository.
     *
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function update($id, array $data);

    /**
     * Delete a record from the repository.
     *
     * @param int $id
     * @return mixed
     */
    public function delete($id);

}
