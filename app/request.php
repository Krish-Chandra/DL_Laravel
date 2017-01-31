<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Request extends Model
{

    public static function getAll()
    {
    	return Request::all();
    }


	public function user()
    {
        return $this->belongsTo(User::class);
    }    
	public function book()
    {
        return $this->belongsTo(Book::class);
    }    

    /**
    *  Issuing a book involves the following steps:
    *   - Inserting a record in the issue table for the book/user
    *   - Deleting the corresponding request record from the request table
    *   - Decrementing the available number of copies of the book and updating the respective book record in the book table
    **/
    public function issueBook($requestId, $bookId, $userId)
    {
        DB:beginTransaction();
        try
        {
            $issueDate = date("y/m/d");
            $dueDate = Date('y/m/d', strtotime("+14 days"));

            DB::insert('INSERT INTO issue (user_id, book_id, issue_date, due_date) VALUES (?,?,?,?)', [$userId, $bookId, $issueDate, $dueDate]);
            
            DB::delete("DELETE FROM request WHERE Id = :reqId", ['reqId' => $requestId]);
            
            DB::select("SELECT available_copies FROM book WHERE Id=:bId", ['bId' => $bookId]);
            
            DB::update("UPDATE book SET available_copies=? WHERE Id=?",[$availableCopies, $bookId] );   

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

    /**
    *  Returning a book involves the following steps:
    *   - Deleting the record from the issue table for the book/user
    *   - Inecrementing the available number of copies of the book and updating the respective book record in the book table
    **/
        
    public function returnBook($BookId, $UserId)
    {
        DB::beginTransaction();
        try
        {

            $sql = "DELETE FROM issue WHERE user_id = :uId AND  book_id = :bId";
            $command=$conn->createCommand($sql);
            $command->bindParam(":uId", $UserId);
            $command->bindParam(":bId", $BookId);               
            $command->execute();
            
            $sql = "SELECT available_copies FROM book WHERE id=:bId";
            $command_2 = $conn->createCommand($sql);                
            $command_2->bindParam(":bId", $BookId);             
            $availableCopies = $command_2->queryScalar();
            $availableCopies++;
            
            $sql = "UPDATE book SET available_copies=:aCopies WHERE Id=:bId";   
            $command_3 = $conn->createCommand($sql);
            $command_3->bindParam(":aCopies", $availableCopies);
            $command_3->bindParam(":bId", $BookId);             
            $command_3->execute();

            DB:commit();
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
