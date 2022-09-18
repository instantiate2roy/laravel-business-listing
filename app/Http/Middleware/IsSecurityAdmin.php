<?php

namespace App\Http\Middleware;

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
        $secAdmin = false;
        
        foreach (Auth::user()->userRoles as $userRole) {
            if ($userRole->ur_rolecode == 'SEC_ADMIN' || $userRole->ur_rolecode == 'SU_ADMIN') {
                $secAdmin = true;
                break;
            }
        }

        if (!$secAdmin) {
            return abort(403, 'Unauthorized Access.');
        }

        return $next($request);
    }
}
