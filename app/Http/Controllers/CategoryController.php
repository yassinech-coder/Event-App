<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Event;
class CategoryController extends Controller
{
    public function index($id)
    {
        $events = Event::where('category_id',$id)->paginate(5); 
        $categoryName = Category::where('id',$id)->first();       
      
        return view('events.events-category')->with(compact('events','categoryName'));
    }
    public function getcategory(Request $request)
  {
    $categories =  DB::table('categories')->get();
    return view('admin.show2')->with(compact('categories'));
  }

  public function store(Request $request)
     {
          $category = new category();
          Category::create([
               'name' => request('name'),
          ]);

          return redirect()->back()->with('message', 'Category Created Successfully !');
     }

     public function update(Request $request, $id)
     {
          $category = Category::findOrFail($id);
          $category->update(['name'=>request('name')]);

          return redirect()->back()->with('message', 'Category Successfully Updated!');
     }

     public function delete($id)
     {
          $category = Category::findOrFail($id);
          $category->delete();
          return redirect()->back()->with('message', 'Category Deleted!');
     }

}
