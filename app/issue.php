<?php

namespace App;

use App\User;
use DB;
use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
	protected $table = 'issues';

    public static function getAll()
    {
        return Issue::all();
    }


    public function book()
    {
        return $this->belongsTo(Book::class);
    }    

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    /**
    *  Returning a book involves the following steps:
    *   - Deleting the record from the issue table for the book/user
    *   - Inecrementing the available number of copies of the book and updating the respective book record in the book table
    **/
    public function returnBook()
    {
        DB::beginTransaction();
        try
        {

            DB::delete("DELETE FROM issues WHERE Id = :issueId", ['issueId' => $this->id]);
           
            $availableCopies = DB::table('books')->select('available_copies')->where('id', $this->book_id)->first();
            
            DB::update("UPDATE books SET available_copies=? WHERE Id=?",[++$availableCopies->available_copies, $this->book_id] );   

            DB::commit();
            $retVal = TRUE;             
        }   
        catch(Exception $e)
        {
            DB::rollBack();
            $retVal = FALSE;
            
        }
        return $retVal;
    }


}
