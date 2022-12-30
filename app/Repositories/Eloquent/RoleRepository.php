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
     * @return Role|null
     */
    public function create(array $payload): ?Role
    {
        $model = parent::create($payload);
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
                ? $model->permissions()->sync([])
                : $model->permissions()->sync($payload['permissions_id']);
        } else {
            $model->permissions()->sync([]);
        }
    }

    /**
     * @param int $id
     * @param array $payload
     * @return Role|null
     */
    public function update(int $id, array $payload): ?Role
    {
        $model = parent::update($id, $payload);
        $this->setPermissions($payload, $model);

        return $model;
    }


    /**
     * @param int $id
     * @return bool|null
     */
    public function destroy(int $id): ?bool
    {
        $model = $this->findById($id);
        $model->permissions()->sync([]);

        return $model->delete();
    }
}
