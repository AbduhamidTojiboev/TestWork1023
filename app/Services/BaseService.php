<?php

namespace App\Services;

use App\Repositories\Eloquent\BaseRepository;
use App\Services\Contract\BaseServiceContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class BaseService implements BaseServiceContract
{
    /**
     * BaseService constructor
     *
     * @param BaseRepository $repository
     */
    public function __construct(protected BaseRepository $repository)
    {
    }

    /**
     * @param array $columns
     * @param array $relations
     * @return Collection
     */
    public function all(array $columns = ['*'], array $relations = []): \Illuminate\Database\Eloquent\Collection
    {
        return $this->repository->all($columns, $relations);
    }

    /**
     * @param string $column
     * @return Collection
     */
    public function list(string $column = 'name'): Collection
    {
        return $this->repository->list($column);
    }

    /**
     * @param int $id
     * @param array $columns
     * @param array $relations
     * @return Model|null
     */
    public function findById(int $id, array $columns = ['*'], array $relations = []): ?Model
    {
        return $this->repository->findById($id, $columns, $relations);
    }

    /**
     * @param array $payload
     * @return Model|null
     */
    public function create(array $payload): ?Model
    {
        return $this->repository->create($payload);
    }

    /**
     * @param int $id
     * @param array $payload
     * @return Model|null
     */
    public function update(int $id, array $payload): ?Model
    {
        return  $this->repository->update($id, $payload);
    }

    /**
     * @param int $id
     * @return bool|null
     */
    public function destroy(int $id): ?bool
    {
        return $this->repository->destroy($id);
    }
}
