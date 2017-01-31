<?php

namespace App\Http\Controllers;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Book;
use App\BookRequest;

class LibraryController extends BaseController
{
    public function index()
    {
        // print_r(Book::getAllBooks());
    	return view('frontend.index', ['books' => Book::getAll()]);
    }


    //Add it to the session
    public function addToCart(Request $request, $id)
    {
        $book = Book::getBookById($id);
        if ($book)
        {
            $request->session()->push('requestedBooks', $id);
            $request->session()->flash('success', 'Successfully added the book to your request cart!');            
            // return redirect()->action('libraryController@index');
            return redirect("/");
        }

    }

    //Remove the book from the request cart
    public function deleteFromCart(Request $request, $bookId) 
    {
        if ($request->session()->has('requestedBooks'))
        {
            $reqCart = $request->session()->get('requestedBooks');;
        }
        
        if (isset($reqCart) && ($reqCart !== NULL))
        {
            $index = array_search($bookId, $reqCart);                   
            if ($index !== FALSE)
            {
                unset($reqCart[$index]);
                $reqCart = array_values($reqCart);
                $request->session()->forget('requestedBooks');                
                foreach ($reqCart as $value) {
                    $request->session()->push('requestedBooks', $value);    
                }
                $request->session()->flash('success', 'Successfully removed the book from your request cart!');
               return redirect("/");
            }
        }
        $request->session()->flash('failure', "Couldn't delete the book to your request cart!");
        return redirect("/");
    }


    public function viewRequestCart(Request $request)
    {
        $bookIds = $request->session()->get('requestedBooks');
        return view('frontend.requestcart', ['books' => Book::getRequestedBooks($bookIds)]);
    }

    public function checkout(Request $request)
    {
        $this->middleware('auth');
        $bookIds = $request->session()->get('requestedBooks');
        if (isset($bookIds))
        {
            if ((new BookRequest())->sendRequest($request, $bookIds) == count($bookIds))
            {
                $request->session()->flash('success', 'Successfully sent a request for all the books!');
            }
            else
                $request->session()->flash('failure', "Couldn't send a request for all the books! Please check with the Admin!!");            

            return redirect("/");
        }
    }

}
