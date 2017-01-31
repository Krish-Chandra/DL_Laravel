<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\User;
use App\Role;

use Validator;

class AdminUserController extends Controller
{
    public function __construct()
    {
        parent::__construct();        
    }

    public function Index()
    {
    	return view('admin.adminuser.adminuserindex', ['adminUsers' => User::getAdminUsers()]);
    }

    public function addnewadminuser()
    {
    	return view('admin.adminuser.addnewadminuser',  ['roles' => Role::all()]);
    }

    public function createnewadminuser(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6', 
            'role_id' => 'required'           
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        if ($user)
        {
            $user->roles()->attach(intval($request->role_id));
        }
        return redirect('/admin/adminuser');
    }

    public function editAdminUser($userId)
    {
        $adminUser = User::findOrFail($userId);
        return view('admin.adminuser.editadminuser', ['adminUser' => $adminUser, 'roles' => Role::all()]);
    }

    public function updateAdminUser(Request $request, $userId)
    {

        $this->validate($request, [
            'email' => ['required', 'email', 'unique:users,email,'.$userId],
            'role_id' => 'required|integer' 
        ]);

        $adminUser = User::findOrFail($userId);
        $input = $request->all();
        $adminUser->fill($input);
        $adminUser->update();

        $adminUser->roles()->detach();
        $adminUser->roles()->attach(intval($request->role_id));

        return redirect('/admin/adminuser');
    }

    public function deleteadminuser($userId)
    {
        $adminUser = User::findOrFail($userId);
        $adminUser->delete();
        return redirect('/admin/adminuser');

    }
    public static function getKey()
    {
        return 'author';
    }

}
