<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Post;
use App\Models\Question;
use App\Models\Group;
use Illuminate\Http\Request;
use Auth;
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
    public function index(string $type, string $slug = null)
    {
        $groups = Auth::user()->groups;
        $categories = Category::latest()->get();
        $selected_category = null;


        $isArticle = $type === 'article';


        if ($slug !== null) {
            $selected_category = Category::where('slug', $slug)->firstOrFail();

            if ($isArticle) {
                $posts = Post::where('category_id', $selected_category->id)->latest()->get();
                return view('home', compact('groups', 'categories', 'selected_category', 'posts'));
            } else {
                $questions = Question::where('category_id', $selected_category->id)->latest()->get();
                return view('home', compact('groups', 'categories', 'selected_category', 'questions'));
            }
        }
        if ($isArticle) {
            $posts = Post::latest()->get();
            return view('home', compact('groups', 'categories', 'selected_category', 'posts'));
        } else {
            $questions = Question::latest()->get();
            return view('home', compact('groups', 'categories', 'selected_category', 'questions'));
        }
    }
}
