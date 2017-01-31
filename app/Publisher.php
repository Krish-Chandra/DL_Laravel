<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
	protected $fillable = ['publishername', 'address', 'city', 'state', 'zip', 'email_id', 'phone'];	

    public static function getAll()
    {
    	return Publisher::all();
    }


	public function books()
    {
        return $this->hasMany(Book::class);
    }    

}
