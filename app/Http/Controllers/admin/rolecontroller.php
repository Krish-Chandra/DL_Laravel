<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Role;
use App\Permission;

class RoleController extends Controller
{
    public function __construct()
    {
        parent::__construct();        
    }

    public function Index()
    {
    	return view('admin.role.roleindex', ['roles' => Role::all()]);
    }

    public function AddNewRole()
    {
    	return view('admin.role.addnewrole', ['permissions'=>Permission::all()]);
    }

    public function postAddNewRole(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);

        $role = Role::create([
            'name' => $request->name,
            'display_name' => $request->display_name,
            'description' => $request->description
        ]);


        $input = $request->all();

        foreach ($input['permissions'] as $permission)
        {
            $perm = Permission::where('name', $permission)->first();

            if ($perm)
            {
                $role->attachPermission($perm);
            }
        }

        return redirect('/admin/role');
     }

    public function getEditRole($id)
    {
        $role = Role::findOrFail($id);
        $rPerms = $role->perms()->select('name')->get();
        $rolePermissions = [];
        foreach ($rPerms as $rp) {
            $rolePermissions[] = $rp->name;
        }

        return view('admin.role.editrole', ['permissions'=>Permission::all(), 'role' => $role, 'rolePermissions' => $rolePermissions]);
    }

    public function updaterole($id, Request $request)
    {
        $role = Role::findOrFail($id);
        $this->validate($request, [
            'role_id' => 'required|max:255',
        ]);


        $input = $request->all();

        $perms = $role->perms()->get();

        $role->detachPermissions($perms);

        foreach ($input['permissions'] as $permission)
        {
            $perm = Permission::where('name', $permission)->first();
            if ($perm)
                $role->attachPermission($perm);
        }

        return redirect('/admin/role');
    }

    public function deleteRole($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        return redirect('/admin/role');

    }
    public static function getKey()
    {
        return 'role';
    }

}
