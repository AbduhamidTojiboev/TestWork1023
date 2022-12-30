<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contract\BaseRepositoryContract;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository implements BaseRepositoryContract
{
    /**
     * BaseRepository constructor
     *
     * @param Model $model
     */
    public function __construct(protected Model $model)
    {
    }

    /**
     * @param array $columns
     * @param array $relations
     * @return Collection
     */
    public function all(array $columns = ['*'], array $relations = []): \Illuminate\Database\Eloquent\Collection
    {
        return $this->model->with($relations)->get($columns);
    }

    /**
     * @param string $column
     * @return Collection
     */
    public function list(string $column = 'name'): Collection
    {
        return $this->model->pluck($column, 'id');
    }

    /**
     * @param int $id
     * @param array $columns
     * @param array $relations
     * @return Model|null
     */
    public function findById(int $id, array $columns = ['*'], array $relations = []): ?Model
    {
        return $this->model->select($columns)->with($relations)->findOrFail($id);
    }

    /**
     * @param array $payload
     * @return Model|null
     */
    public function create(array $payload): ?Model
    {
        return $this->model->create($payload);
    }

    /**
     * @param int $id
     * @param array $payload
     * @return Model|null
     */
    public function update(int $id, array $payload): ?Model
    {
        return tap($this->findById($id), function ($model) use($payload){
            $model->update($payload);
        });
    }

    /**
     * @param int $id
     * @return bool|null
     */
    public function destroy(int $id): ?bool
    {
        return $this->findById($id)->delete();
    }
}
