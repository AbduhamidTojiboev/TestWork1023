<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\Contract\UserRepositoryContract;
use App\Services\Contract\UserServiceContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class UserService extends BaseService implements UserServiceContract
{
    /**
     * UserService constructor
     *
     * @param UserRepositoryContract $repository
     */
    public function __construct(UserRepositoryContract $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @param array $payload
     * @return Model|null
     */
    public function create(array $payload): ?Model
    {
        $model = parent::create($this->hashPassword($payload));
        $this->setPermissions($payload, $model);
        $this->setRoles($payload, $model);

        return $model;

    }

    /**
     * @param int $id
     * @param array $payload
     * @return Model|null
     */
    public function update(int $id, array $payload): ?Model
    {
        $model = parent::update($id, $this->hashPassword($payload));
        $this->setPermissions($payload, $model);
        $this->setRoles($payload, $model);

        return $model;
    }

    /**
     * @param array $payload
     * @return array
     */
    private function hashPassword(array $payload): array
    {
        if (isset($payload['password'])){
            $payload['password'] = Hash::make($payload['password']);
        }

        return $payload;
    }

    /**
     * @param array $payload
     * @param User $model
     * @return void
     */
    private function setPermissions(array $payload, User $model): void
    {
        if (isset($payload['permissions_id'])) {
            ($payload['permissions_id'] === null)
                ? $this->repository->setPermissions([], $model)
                : $this->repository->setPermissions($payload['permissions_id'], $model);
        } else {
            $this->repository->setPermissions([], $model);
        }
    }


    /**
     * @param array $payload
     * @param User $model
     * @return void
     */
    private function setRoles(array $payload, User $model): void
    {
        if (isset($payload['roles_id'])) {
            ($payload['roles_id'] === null)
                ? $this->repository->setRoles([], $model)
                : $this->repository->setRoles($payload['roles_id'], $model);
        } else {
            $this->repository->setRoles([], $model);
        }
    }
}
