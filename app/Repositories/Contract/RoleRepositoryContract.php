<?php

namespace App\Repositories\Contract;

use App\Models\Role;

interface RoleRepositoryContract extends BaseRepositoryContract
{
    /**
     * @param array $payload
     * @param Role $model
     * @return void
     */
    public function setPermissions(array $payload, Role $model): void;
}
