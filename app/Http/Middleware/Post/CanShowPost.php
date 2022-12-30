<?php

namespace App\Http\Middleware\Post;

use App\Common\Helpers\Permission;
use App\Common\Helpers\Role;
use App\Exceptions\ForbiddenException;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CanShowPost
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::user()->ability(Role::SADMIN, Permission::POST_SHOW)) {
            throw new ForbiddenException();
        }

        return $next($request);
    }
}
