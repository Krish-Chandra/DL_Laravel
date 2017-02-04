<?php
namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Book;
use App\Author;
use App\Publisher;
use App\Category;
use Validator;

class BookController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function Index()
    {

    	return view('admin.book.bookindex', ['books' => Book::with('author', 'publisher', 'category')->get()]);
    }

    public function getAddNewBook()
    {
    	return view('admin.book.addNewBook', ['pubs' => Publisher::getAll(), 'cats' => Category::getAll(), 'auths' => Author::getAll()]);;
    }

    public function postAddNewBook(Request $request)    
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'author_id' => 'required|numeric',
            'category_id' => 'required|numeric',
            'publisher_id' => 'required|numeric',
            'isbn' => 'required|max:13',
            'total_copies' => 'required|numeric|min:1|max:50',
            // 'available_copies' => 'required|numeric'
        ]);


       
        Book::create([
            'title' => $request->title,
            'author_id' => $request->author_id,
            'category_id' => $request->category_id,
            'publisher_id' => $request->publisher_id,
            'isbn' => $request->isbn,
            'total_copies' => $request->total_copies,
            'available_copies' => $request->total_copies
        ]);
        event(new \App\Events\NewBookArrivalEvent("New Book has been added: $request->title"));
        return redirect('/admin');
 
    }

    public function getEditBook($id)
    {
        $book = Book::findOrFail($id);

        return view('admin.book.editbook', ['pubs' => Publisher::getAll(), 'cats' => Category::getAll(), 'auths' => Author::getAll()])->withBook($book);;
    }

    public function updatebook(Request $request, $id)
    {
        $book = Book::findOrFail($id);
        $input = $request->all();

        $this->validate($request, [
            'title' => 'required|max:255',
            'author_id' => 'required|numeric',
            'category_id' => 'required|numeric',
            'publisher_id' => 'required|numeric',
            'isbn' => 'required|max:13',
            'total_copies' => 'required|numeric|min:1|max:50',
        ]);
        
        $book->fill($input);
        $book->available_copies = $request->get('total_copies');
        $book->update();

        return redirect('/admin/book');
    }

    public function deletebook(Request $request)
    {
        $bookId = $request->input('bookId');
        $book = Book::findOrFail($bookId);
        $book->delete();
        return redirect('/admin/book');
    }

    public static function getKey()
    {
        return 'book';
    }

}
