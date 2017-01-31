<?php namespace App;

use Zizaco\Entrust\EntrustRole;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class Role extends EntrustRole
{
	use EntrustUserTrait; // To use $role->can($permission->name);

    protected $fillable = [
        'name', 'display_name', 'description'
    ];

}