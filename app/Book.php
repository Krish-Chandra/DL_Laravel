<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Book extends Model
{
    protected $fillable = ['title', 'author_id', 'category_id', 'publisher_id', 'isbn', 'total_copies', 'available_copies'];

    public static function getAll()
    {
    	return Book::all();
    }

	public function author()
    {
        return $this->belongsTo(Author::class);
    }    

	public function publisher()
    {
        return $this->belongsTo(Publisher::class);
    }    

	public function category()
    {
        return $this->belongsTo(Category::class);
    }    

    static public function getBookById($id)
    {
        $book = Book::find($id);
        return $book;
    }

    public static function getRequestedBooks($bookIds)
    {
        $requestedBooks = array();
         if ($bookIds != NULL)
         {
             foreach($bookIds as $val)
             {
                 $requestedBooks[] = self::getBookById($val);
             }

            //When we get to using the database, we need to use the following query builder
            // $users = DB::table('users')
            //         ->whereIn('id', $Ids)
            //         ->get();             
             return $requestedBooks;
         }
         else
         {
             return NULL;            
         }
    }


}
