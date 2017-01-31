<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    public function __construct()
    {
        parent::__construct();        
    }

    public function Index()
    {

    	return view('admin.category.index', ['categories' => Category::getAll()]);
    }

    public function addNewCategory()
    {
    	return view('admin.category.addnewcategory');
    }

    public function createcategory(Request $request)    
    {
        $this->validate($request, [
            'categoryname' => 'required|max:128',  
            'description' => 'max:255',
        ]);

        Category::create([
            'categoryname' => $request->categoryname,
            'description' => $request->description
        ]);

        return redirect('/admin/category');
 
    }

    public function getEditCategory($id)
    {
        $category = Category::findOrFail($id);

        return view('admin.category.editcategory', ['category' => $category]);
    }

    public function updatecategory($id, Request $request)
    {
        $category = Category::findOrFail($id);
        $this->validate($request, [
            'categoryname' => 'required|max:128',  
            'description' => 'max:255'
        ]);

        $input = $request->all();

        $category->fill($input)->update();

        return redirect('/admin/category');
    }

    public function deletecategory(Request $request)
    {
        $categoryId = $request->input('categoryId');
        $category = Category::findOrFail($categoryId);
        $category->delete();
        return redirect('/admin/category');
    }

    public static function getKey()
    {
        return 'category';
    }

}
