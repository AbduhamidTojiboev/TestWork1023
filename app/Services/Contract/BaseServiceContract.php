<?php

namespace App\Services\Contract;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface BaseServiceContract
{
    /**
     * Get all models
     *
     * @param array $columns
     * @param array $relations
     * @return Collection
     */
    public function all(array $columns = ['*'], array $relations = []): Collection;

    /**
     * Get list models
     *
     * @param string $column
     * @return Collection
     */
    public function list(string $column = 'name'): \Illuminate\Support\Collection;

    /**
     * Find model by id
     *
     * @param int $id
     * @param array $columns
     * @param array $relations
     * @return Model|null
     */
    public function findById(int $id, array $columns = ['*'], array $relations = []): ?Model;

    /**
     * Create a model
     *
     * @param array $payload
     * @return Model|null
     */
    public function create(array $payload): ?Model;

    /**
     * Update existing model
     * @param int $id
     * @param array $payload
     * @return Model|null
     */
    public function update(int $id, array $payload): ?Model;

    /**
     * Delete model by id
     * @param int $id
     * @return bool|null
     */
    public function destroy(int $id): ?bool;
}
