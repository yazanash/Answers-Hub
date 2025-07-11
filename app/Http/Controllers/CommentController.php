<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Notifications\CommentAdded;
use Illuminate\Http\Request;
use Auth;
class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,Post $post)
    {
        $request->validate([
            'content' =>  'required'
           ]);
           $input=$request->all();
           $input['user_id']= Auth::user()->id;
           $input['post_id']= $post->id;
           Comment::create($input);
           if ($post->user_id !== auth()->id()) {
                $post->user->notify(new CommentAdded(
                     'Add comment on your Article',
                    route('posts.show', $post->id),
                    Auth::user()->profile->name
                ));
}
           return redirect()->back();
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        $request->validate([
            'content' =>  'required'
           ]);
        $input=$request->all();
        $comment->update($input);
        return redirect()->back()->with('success','comments updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return redirect()->back()->with('success','comments deleted successfully');
    }
}
