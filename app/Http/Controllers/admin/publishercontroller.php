<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Publisher;

class PublisherController extends Controller
{
    public function __construct()
    {
        parent::__construct();        
    }

    public function Index()
    {
    	return view('admin.publisher.publisherindex', ['publishers' => Publisher::getAll()]);
    }

    public function getAddNewPublisher()
    {
    	return view('admin.publisher.addnewpublisher');;
    }

    public function postAddNewPublisher(Request $request)
    {
        $this->validate($request, [
            'publishername' => 'required|max:255',
            'email_id' => 'required|email|unique:publishers',
            'phone' => 'required',
        ]);

        Publisher::create([
            'publishername' => $request->publishername,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'zip' => $request->zip,            
            'email_id' => $request->email_id,
            'phone' => $request->phone

        ]);

        return redirect('/admin/publisher');
 
    }

    public function getEditPublisher($id)
    {
        $publisher = Publisher::findOrFail($id);

        return view('admin.publisher.editpublisher')->withPublisher($publisher);;
    }

    public function updatePublisher($id, Request $request)
    {
        $publisher = Publisher::findOrFail($id);
        $this->validate($request, [
            'publishername' => 'required|max:255',
            'email_id' => ['required', 'email', 'unique:publishers,email_id,'.$id],
            'phone' => 'required',
        ]);


        $input = $request->all();

        $publisher->fill($input)->update();

        return redirect('/admin/publisher');
    }


    public function deletepublisher(Request $request)
    {
        $pubId = $request->input('publisherId');
        $publisher = Publisher::findOrFail($pubId);
        $publisher->delete();
        return redirect('/admin/publisher');

    }
    public static function getKey()
    {
        return 'publisher';
    }

}
