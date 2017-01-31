<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Routing\Controller as BaseController;
// use App\Http\Requests;
use Illuminate\Http\Request;
use App\Category;
use App\User;
use App\Issue;

class IssueController extends Controller
{
    public function __construct()
    {
        parent::__construct();        
    }

    public function Index()
    {
    	return view('admin.issue.index', ['issues' => Issue::with('user', 'book')->get()]);
    }


    public function returnBook($issueId, Request $request)
    {
        $issue = Issue::findOrFail($issueId);
        if ($issue->returnBook())
            $request->session()->flash('success', 'Successfully returned the book!');
        else
            $request->session()->flash('failure', "Couldn't return the book!");

        return redirect("/admin/issue");
    }
    public static function getKey()
    {
        return 'issue';
    }

}
