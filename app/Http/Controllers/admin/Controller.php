<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Role;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function __construct()
    {
        $middleware = 'checkForRole:' . self::getAllowedRoles();
        $this->middleware($middleware);
    }

    /**
     * Get all the roles that have access to this controller
     * @return Array of all roles
     */
    private static function getAllowedRoles()
    {
        $roles = [];
        $allRoles = [];
        foreach (Role::all() as $role) {
            array_push($allRoles, $role->name);
        }

        $key = static::getKey();
        foreach (Role::all() as $role)
        {
            $permsForRole = [];
            foreach($role->perms()->get() as $perm)
            {
                array_push($permsForRole, $perm->name);
            }
            if (in_array($key, $permsForRole))
                array_push($roles, $role->name);
        }
        return implode(",", $roles);

    }
}
