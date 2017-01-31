<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Routing\Controller as BaseController;
// use App\Http\Requests;
use Illuminate\Http\Request;
use App\Category;
use App\User;
use App\BookRequest;

class RequestController extends Controller
{
    public function __construct()
    {
        parent::__construct();        
    }

    public function Index()
    {
    	return view('admin.request.index', ['requests' => BookRequest::with('user', 'book')->get()]);
    }


    public function issueBook($requestId, Request $request)
    {
        $bookRequest = BookRequest::findOrFail($requestId);
        if ($bookRequest->issueBook())
            $request->session()->flash('success', 'Successfully issued the book to the member!');
        else
            $request->session()->flash('failure', "Couldn't issue the book!");

        return redirect("/admin");

    }
    public static function getKey()
    {
        return 'request';
    }

}
