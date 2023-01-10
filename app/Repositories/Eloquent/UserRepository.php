<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\Contract\BaseRepositoryContract;
use App\Repositories\Contract\UserRepositoryContract;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class UserRepository extends BaseRepository implements UserRepositoryContract
{
    /**
     * UserRepository constructor
     *
     * @param User $model
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $payload
     * @param User $model
     * @return void
     */
    public function setRoles(array $payload, User $model): void
    {
        $model->roles()->sync($payload);
    }

    /**
     * @param array $payload
     * @param User $model
     * @return void
     */
    public function setPermissions(array $payload, User $model): void
    {
        $model->permissions()->sync($payload);
    }

    /**
     * @param int $id
     * @return bool|null
     */
    public function destroy(int $id): ?bool
    {
        $model = $this->findById($id);
        $model->permissions()->sync([]);
        $model->roles()->sync([]);

        return $model->delete();
    }
}
