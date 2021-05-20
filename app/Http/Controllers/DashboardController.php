<?php

namespace App\Http\Controllers;
use App\Models\Event;
use App\Models\Category;
use App\Charts\DashboardChart;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
      
      $chart = new DashboardChart;
      return view('admin.index')->with(compact('chart'))
      ->with('users_count', User::all()->count())
          ->with('categories_count', Category::all()->count())
          ->with('events_count', Event::all()->count());;
    }
}
