<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Question;

class SearchController extends Controller
{
   public function index(Request $request)
{
    $query = $request->input('q');

    if (!$query) {
        return redirect()->back()->with('error', 'يرجى إدخال كلمة للبحث.');
    }

    $postResults = \App\Models\Post::where('title', 'like', "%$query%")
        ->orWhere('content', 'like', "%$query%")
        ->get()
        ->map(function ($item) {
            return [
                'type' => 'post',
                'title' => $item->title,
                'url' => route('posts.show', $item->id),
                'created_at' => $item->created_at,
            ];
        });

    $questionResults = \App\Models\Question::where('title', 'like', "%$query%")
        ->orWhere('content', 'like', "%$query%")
        ->get()
        ->map(function ($item) {
            return [
                'type' => 'question',
                'title' => $item->title,
                'url' => route('questions.show', $item->id),
                'created_at' => $item->created_at,
            ];
        });

    $results = $postResults
        ->merge($questionResults)
        ->sortByDesc('created_at')
        ->values(); 

    return view('search.results', compact('results', 'query'));
}
}
