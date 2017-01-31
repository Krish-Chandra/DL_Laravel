<?php
use App\Book;

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::group(['middleware' => ['web', 'auth'], 'namespace' => 'Admin', 'prefix' => 'admin'], function()
{
	Route::get('/', 'bookcontroller@index');

    Route::get('author', 'authorcontroller@index');
    Route::get('author/addnewauthor', 'authorcontroller@getaddnewauthor');
    Route::post('author/addnewauthor', 'authorcontroller@postaddnewauthor');
    Route::post('author/deleteauthor', 'authorcontroller@deleteauthor');
    Route::get('author/editauthor/{authorId}', 'authorcontroller@geteditauthor');
    Route::patch('author/editauthor/{authorId}', 'authorcontroller@updateauthor');

    Route::get('book', 'bookcontroller@index');
    Route::get('book/addnewbook', 'bookcontroller@getaddnewbook');
    Route::post('book/addnewbook', 'bookcontroller@postaddnewbook');
    Route::get('book/editbook/{bookId}', 'bookcontroller@geteditbook');
    Route::patch('book/editbook/{bookId}', 'bookcontroller@updatebook');
    Route::post('book/deletebook', 'bookcontroller@deletebook');

    Route::get('publisher', 'publishercontroller@index');
    Route::get('publisher/addnewpublisher', 'publishercontroller@getaddnewpublisher');
    Route::post('publisher/addnewpublisher', 'publishercontroller@postaddnewpublisher');
    Route::get('publisher/editpublisher/{publisherId}', 'publishercontroller@geteditpublisher');
    Route::patch('publisher/editpublisher/{publisherId}', 'publishercontroller@updatepublisher');

    Route::post('publisher/deletepublisher', 'publishercontroller@deletepublisher');

    Route::get('category', 'categorycontroller@index');
    Route::get('category/addnewcategory', 'categorycontroller@addnewcategory');    
    Route::post('category/createcategory', 'categorycontroller@createcategory');    
    Route::get('category/editcategory/{categoryId}', 'categorycontroller@geteditcategory');    
    Route::patch('category/editcategory/{categoryId}', 'categorycontroller@updatecategory');
    Route::post('category/deletecategory', 'categorycontroller@deletecategory');    

    Route::get('request', 'requestcontroller@index');
    Route::post('request/issuebook/{requestId}', 'requestcontroller@issuebook');

    Route::get('issue', 'issuecontroller@index');
    Route::post('issue/returnbook/{issueId}', 'issueController@returnbook');

    Route::get('role', 'rolecontroller@index');
    Route::get('role/addnewrole', 'rolecontroller@addnewrole');    
    Route::post('role/addnewrole', 'rolecontroller@postaddnewrole');    
    Route::get('role/editrole/{id}', 'rolecontroller@geteditrole');    
    Route::patch('role/editrole/{id}', 'rolecontroller@updaterole');
    Route::delete('role/{id}', 'rolecontroller@deleterole');    

    Route::get('adminuser', 'adminusercontroller@index');
    Route::get('newadminuser', 'adminusercontroller@addnewadminuser');
    Route::post('newadminuser', 'adminusercontroller@createnewadminuser');
    Route::get('adminuser/{userId}', 'adminusercontroller@editadminuser');
    Route::patch('adminuser/{userId}', 'adminusercontroller@updateadminuser');
    Route::delete('adminuser/{userId}', 'adminusercontroller@deleteadminuser');    

});

Route::group(['middleware' => ['web']], function () {


	Route::get('/', 'librarycontroller@index');
    Route::post('/addtocart/{id}', 'librarycontroller@addtoCart');
	Route::post('/deletefromcart/{id}', 'librarycontroller@deletefromcart');

	//Assume you want only logged in users can view their cart
	Route::get('/viewcart', [
	    'uses' => 'librarycontroller@viewrequestcart'
	]);

	Route::get('/checkout', [
	    'middleware' => 'auth',
	    'uses' => 'librarycontroller@checkout'
	]);

	Route::auth();

});

