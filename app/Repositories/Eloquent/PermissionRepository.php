<?php

namespace App\Repositories\Eloquent;

use App\Models\Permission;
use App\Repositories\Contract\PermissionRepositoryContract;
use Illuminate\Database\Eloquent\Model;

class PermissionRepository extends BaseRepository implements PermissionRepositoryContract
{
    /**
     * PermissionRepository constructor
     *
     * @param Permission $model
     */
    public function __construct(Permission $model)
    {
        $this->model = $model;
    }
}
