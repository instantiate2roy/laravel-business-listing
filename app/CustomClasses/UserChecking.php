<?php

namespace App\CustomClasses;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserChecking
{

    /**
     * check if user has a specific role or any of the specified roles
     *
     * @param array $roles
     * 
     * @return bool
     * 
     */
    public static function hasRole(array $roles): bool
    {
        $result = false;
        if (!empty(Auth::user())) {
            foreach (Auth::user()->userRoles as $userRole) {
                if (in_array($userRole->ur_rolecode, $roles)) {
                    $result = true;
                    break;
                }
            }
        }
        return $result;
    }
}
