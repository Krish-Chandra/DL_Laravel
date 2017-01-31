<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Author;

use Validator;

class AuthorController extends Controller
{
    public function __construct()
    {
        parent::__construct();        
    }

    public function Index()
    {
    	return view('admin.author.authorindex', ['authors' => Author::getAll()]);
    }

    public function getAddNewAuthor()
    {
    	return view('admin.author.addNewAuthor');;
    }

    public function postAddNewAuthor(Request $request)
    {
        $this->validate($request, [
            'authorname' => 'required|max:255',
            'email_id' => 'required|email|unique:authors',
            'phone' => 'required',
        ]);

        Author::create([
            'authorname' => $request->authorname,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'zip' => $request->zip,            
            'email_id' => $request->email_id,
            'phone' => $request->phone

        ]);

        return redirect('/admin/author');
 
    }

    public function getEditAuthor($id)
    {
        $author = Author::findOrFail($id);

        return view('admin.author.editauthor')->with('author', $author);
    }

    public function updateAuthor(Request $request, $authorId)
    {
        $this->validate($request, [
            'authorname' => 'required|max:255',
            'email_id' => ['required', 'email', 'unique:authors,email_id,'.$authorId],
            'phone' => 'required',
        ]);


        $author = Author::findOrFail($authorId);
        $input = $request->all();
        $author->fill($input);
        $author->update();

        return redirect('/admin/author');
    }

    public function deleteauthor(Request $request)
    {
        $authorId = $request->input('authorId');
        $author = Author::findOrFail($authorId);
        $author->delete();
        return redirect('/admin/author');

    }
    public static function getKey()
    {
        return 'author';
    }

}
