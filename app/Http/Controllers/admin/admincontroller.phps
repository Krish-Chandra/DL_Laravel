<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Requests;
use Illuminate\Http\Request;

class AdminController extends Controller
{
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
            $allRoles = ['admin', 'librarian'];

            $key = static::getKey();
            //Get a list of all roles that are allowed access to the particular controller
            foreach($allRoles as $role)
            {
                $permissions = self::getPermissionsByRole($role);

                if (in_array($key, $permissions))
                    array_push($roles, $role);
            }
            //Return the array of allowed roles
            return implode(" ", $roles);
        }

        /**
         * Utility fn to remove an element from an array
         * @return Array without the deleted element
         */
        
        private static function array_delete($array, $element)
        {
            return array_diff($array, [$element]);
        }    


}
