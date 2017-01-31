<?php

namespace App;
use DB;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{
    use EntrustUserTrait; // add this trait to your user model
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function requests()
    {
        return $this->hasMany(BookRequest::class);
    }

    public static function getAdminUsers()
    {
        $adminUsers = User::whereDoesntHave('roles',function($q){
            $q->where('name', 'member');
        })->get();

        return $adminUsers;
    }
}
