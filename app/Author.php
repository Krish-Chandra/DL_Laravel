<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
	protected $fillable = ['authorname', 'address', 'city', 'state', 'zip', 'email_id', 'phone'];
    public static function getAll()
    {
    	return Author::all();
    }

	public function author()
    {
        return $this->hasMany(Book::class);
    }    
}
