<?php

namespace App\Http;

use App\Http\Middleware\Post\CanCreatePost;
use App\Http\Middleware\Post\CanDeletePost;
use App\Http\Middleware\Post\CanEditPost;
use App\Http\Middleware\Post\CanListPost;
use App\Http\Middleware\Post\CanShowPost;
use App\Http\Middleware\Role\CanCreateRole;
use App\Http\Middleware\Role\CanDeleteRole;
use App\Http\Middleware\Role\CanEditRole;
use App\Http\Middleware\Role\CanListRole;
use App\Http\Middleware\Role\CanShowRole;
use App\Http\Middleware\User\CanCreateUser;
use App\Http\Middleware\User\CanDeleteUser;
use App\Http\Middleware\User\CanEditUser;
use App\Http\Middleware\User\CanListUser;
use App\Http\Middleware\User\CanShowUser;
use Illuminate\Foundation\Http\Kernel as HttpKernel;

class   Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array<int, class-string|string>
     */
    protected $middleware = [
        // \App\Http\Middleware\TrustHosts::class,
        \App\Http\Middleware\TrustProxies::class,
        \Illuminate\Http\Middleware\HandleCors::class,
        \App\Http\Middleware\PreventRequestsDuringMaintenance::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array<string, array<int, class-string|string>>
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            // \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array<string, class-string|string>
     */
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'auth.session' => \Illuminate\Session\Middleware\AuthenticateSession::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
        'signed' => \App\Http\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,

        //USER
        'user.can-list' => CanListUser::class,
        'user.can-show' => CanShowUser::class,
        'user.can-edit' => CanEditUser::class,
        'user.can-create' => CanCreateUser::class,
        'user.can-delete' => CanDeleteUser::class,

        //POST
        'post.can-list' => CanListPost::class,
        'post.can-show' => CanShowPost::class,
        'post.can-edit' => CanEditPost::class,
        'post.can-create' => CanCreatePost::class,
        'post.can-delete' => CanDeletePost::class,

        //ROLE
        'role.can-list' => CanListRole::class,
        'role.can-show' => CanShowRole::class,
        'role.can-edit' => CanEditRole::class,
        'role.can-create' => CanCreateRole::class,
        'role.can-delete' => CanDeleteRole::class,
    ];
}
