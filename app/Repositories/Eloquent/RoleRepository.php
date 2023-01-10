<?php

namespace App\Repositories\Eloquent;

use App\Models\Role;
use App\Repositories\Contract\BaseRepositoryContract;
use App\Repositories\Contract\RoleRepositoryContract;
use Illuminate\Database\Eloquent\Model;

class RoleRepository extends BaseRepository implements RoleRepositoryContract
{
    /**
     * RoleRepository constructor
     *
     * @param Role $model
     */
    public function __construct(Role $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $payload
     * @param Role $model
     * @return void
     */
    public function setPermissions(array $payload, Role $model): void
    {
        $model->permissions()->sync($payload);
    }

}
