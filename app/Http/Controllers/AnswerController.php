<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;
use Auth;
class AnswerController extends Controller
{
   

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,Question $question)
    {
        $request->validate([
            'content' =>  'required'
           ]);
           $input=$request->all();
           $input['user_id']= Auth::user()->id;
           $input['question_id']= $question->id;
           Answer::create($input);
           return redirect()->back();
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Answer $answer)
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
    public function destroy(Answer $answer)
    {
        $comment->delete();
        return redirect()->back()->with('success','comments deleted successfully');
    }
    public function markAsHelpful(Request $request, Answer $answer)
{
    $user = $request->user();
    $answer->helpfulVotes()->syncWithoutDetaching([$user->id]);
    return redirect()->back();
}
}
