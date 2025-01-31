<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Post;
use App\Models\Question;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories= Category::latest()->get();
        $posts= Post::latest()->get();
        $questions= Question::latest()->get();
        return view('home')->with(compact('categories'))->with(compact('posts'))->with(compact('questions'));
    }
}
