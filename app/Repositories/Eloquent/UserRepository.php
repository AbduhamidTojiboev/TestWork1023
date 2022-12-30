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
     * @return User|null
     */
    public function create(array $payload): ?User
    {
        $model = parent::create($payload);
        $this->setRoles($payload, $model);
        $this->setPermissions($payload, $model);

        return $model;
    }

    /**
     * @param int $id
     * @param array $payload
     * @return User|null
     */
    public function update(int $id, array $payload): ?User
    {
        $model = parent::update($id, $payload);
        $this->setRoles($payload, $model);
        $this->setPermissions($payload, $model);

        return $model;
    }

    /**
     * @param array $payload
     * @param User $model
     * @return void
     */
    private function setRoles(array $payload, User $model): void
    {
        if (isset($payload['roles_id'])) {
            ($payload['roles_id'] === null) ? $model->roles()->sync([]) : $model->roles()->sync($payload['roles_id']);
        } else {
            $model->roles()->sync([]);
        }
    }

    /**
     * @param array $payload
     * @param User $model
     * @return void
     */
    private function setPermissions(array $payload, User $model): void
    {
        if (isset($payload['permissions_id'])) {
            ($payload['permissions_id'] === null) ? $model->permissions()->sync([]) : $model->permissions()->sync($payload['permissions_id']);
        } else {
            $model->permissions()->sync([]);
        }
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
