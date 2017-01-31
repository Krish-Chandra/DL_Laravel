<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	protected $fillable = ['categoryname', 'description'];	

    public static function getAll()
    {
    	return Category::all();
    }


	public function books()
    {
        return $this->hasMany(Book::class);
    }    

}
