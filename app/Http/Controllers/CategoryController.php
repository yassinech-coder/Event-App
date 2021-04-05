<?php

namespace App\Http\Controllers;

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
}
