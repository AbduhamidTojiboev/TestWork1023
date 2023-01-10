<?php

namespace App\Providers;

use App\Repositories\Contract\BaseRepositoryContract;
use App\Repositories\Contract\PermissionRepositoryContract;
use App\Repositories\Contract\PostRepositoryContract;
use App\Repositories\Contract\RoleRepositoryContract;
use App\Repositories\Contract\UserRepositoryContract;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Eloquent\PermissionRepository;
use App\Repositories\Eloquent\PostRepository;
use App\Repositories\Eloquent\RoleRepository;
use App\Repositories\Eloquent\UserRepository;
use App\Services\BaseService;
use App\Services\Contract\BaseServiceContract;
use App\Services\Contract\RoleServiceContract;
use App\Services\Contract\UserServiceContract;
use App\Services\RoleService;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;

class ServiceBindingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(BaseServiceContract::class, BaseService::class);
        $this->app->bind(UserServiceContract::class, UserService::class);
        $this->app->bind(RoleServiceContract::class, RoleService::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
