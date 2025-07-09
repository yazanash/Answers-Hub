<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\Post;
use App\Models\Question;
use App\Models\Profile;
class MainController extends Controller
{
    public function index()
    {
        $groups= Group::orderBy('created_at', 'desc')->take(8)->get();
        $posts= Post::orderBy('created_at', 'desc')->take(3)->get();
        $questions= Question::orderBy('created_at', 'desc')->take(3)->get();
        $profiles = Profile::whereHas('user.roles', function ($query) {
    $query->where('name', '!=', 'user');
})->get();
        return view('welcome')->with(compact('profiles'))->with(compact('groups'))->with(compact('posts'))->with(compact('questions'));
    }
}
