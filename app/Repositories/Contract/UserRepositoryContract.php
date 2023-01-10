<?php

namespace App\Repositories\Contract;

use App\Models\User;

interface UserRepositoryContract extends BaseRepositoryContract
{
    /**
     * @param array $payload
     * @param User $model
     * @return void
     */
    public function setPermissions(array $payload, User $model): void;

    /**
     * @param array $payload
     * @param User $model
     * @return void
     */
    public function setRoles(array $payload, User $model): void;
}
