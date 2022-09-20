<?php

namespace App\Http\Middleware;

use App\CustomClasses\UserChecking;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsSecurityAdmin
{

    /**
     *  Handle an incoming request.
     *
     * @param User $user
     * @param Request $request
     * @param Closure $next
     * 
     * @return [type]
     * 
     */
    public function handle(Request $request, Closure $next)
    {

        $secAdmin = UserChecking::hasRole(['SU_ADMIN', 'SU_ADMIN']);

        if (!$secAdmin) {
            return abort(403, 'Unauthorized Access.');
        }

        return $next($request);
    }
}
