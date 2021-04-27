<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Spatie\Permission\Exceptions\PermissionDoesNotExist;

use Role;
use Permission;
use Route;
use App\User;

class UserEdit
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::guest()) {
            throw UnauthorizedException::notLoggedIn();
        }

        $permission = 'edit_user';
        if (Route::currentRouteName() == 'users.restore') {
            $modelId = User::withTrashed()->where('email', $request->route('user'))->first()->id;
        } else {
            $modelId = $request->route('user')->id;
        }

        try {
            if (! Auth::user()->can($permission) && $modelId != Auth::user()->id) {
                throw UnauthorizedException::forRolesOrPermissions([$permission]);
            }
        } catch (PermissionDoesNotExist $exception) {
        }

        return $next($request);
    }
}
