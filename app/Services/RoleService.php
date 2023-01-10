<?php

namespace App\Services;

use App\Models\Role;
use App\Repositories\Contract\RoleRepositoryContract;
use App\Services\Contract\RoleServiceContract;
use Illuminate\Database\Eloquent\Model;

class RoleService extends BaseService implements RoleServiceContract
{
    /**
     * RoleService constructor
     *
     * @param RoleRepositoryContract $repository
     */
    public function __construct(RoleRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array $payload
     * @return Model|null
     */
    public function create(array $payload): ?Model
    {
        $model = parent::create($payload);
        $this->setPermissions($payload, $model);

        return $model;
    }

    /**
     * @param int $id
     * @param array $payload
     * @return Model|null
     */
    public function update(int $id, array $payload): ?Model
    {
        $model = parent::update($id, $payload);
        $this->setPermissions($payload, $model);

        return $model;
    }

    /**
     * @param array $payload
     * @param Role $model
     * @return void
     */
    private function setPermissions(array $payload, Role $model): void
    {
        if (isset($payload['permissions_id'])) {
            ($payload['permissions_id'] === null)
                ? $this->repository->setPermissions([], $model)
                : $this->repository->setPermissions($payload['permissions_id'], $model);
        } else {
            $this->repository->setPermissions([], $model);
        }
    }
}
