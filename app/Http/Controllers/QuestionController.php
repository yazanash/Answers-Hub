<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Group;
use Auth;
use Share;
use App\Models\Subscription;
use App\Notifications\NewQuestionNotification;
use App\Events\QuestionCreated;
class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
        $questions= Question::latest()->paginate(5);
        return view('question.index',compact('questions'))->with('1'.(request()->input('page',1) -1 )*5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories= Category::all();
        $groups= Group::all();
        
        return view('question.create',compact('groups'),compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=> 'required',
            'content' =>  'required',
            'group_id' =>  'required',
            'category_id' =>  'required',
           ]);
           $input=$request->all();
           $input['user_id']= Auth::user()->id;
           $question = Question::create($input);
           $subscriptions = Subscription::where('group_id', $question->group_id)->get();

           foreach ($subscriptions as $subscription) {
               $subscription->user->notify(new NewQuestionNotification($question));
           }
            event(new QuestionCreated($question)); // send question created event
           return redirect()->route('questions.index')->with('success','question created successfully');
    
    }

    /**
     * Display the specified resource.
     */
    public function show(Question $question)
    {
        $groups= Group::latest()->get()->take(5);
        $questions=Question::latest()->get()->take(5);
        $profile=$question->user->profile;
        $shareLinks = Share::page(route('question.show.slug',$question->slug))
        ->facebook()
        ->twitter()
        ->linkedin()
        ->whatsapp()
        ->reddit()
        ->getRawLinks();
        return view('question.show',compact('question'),compact('groups'))
        ->with(compact('questions'))->with(compact('profile'))->with(['shareLinks' => $shareLinks]);
    
    }
    public function public_show($slug)
    {
        $question = Question::where('slug', $slug)->firstOrFail();
        $groups= Group::latest()->get()->take(5);
        $questions=Question::latest()->get()->take(5);
        $profile=$question->user->profile;
        $shareLinks = Share::page(route('question.show.slug',$question->slug))
        ->facebook()
        ->twitter()
        ->linkedin()
        ->whatsapp()
        ->reddit()
        ->getRawLinks();
        return view('question.show',compact('question'),compact('groups'))
        ->with(compact('questions'))->with(compact('profile'))->with(['shareLinks' => $shareLinks]);
    
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Question $question)
    {
        $categories= Category::all();
        $groups= Group::all();
        return view('question.edit',compact('question'),compact('groups'))->with(compact('categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Question $question)
    {
        $request->validate([
            'title'=> 'required',
            'content' =>  'required',
            'group_id' =>  'required',
            'category_id' =>  'required',
           ]);
           $input=$request->all();
           $question->update($input);
           return redirect()->route('questions.index')->with('success','question updated successfully');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question)
    {
        $question->delete();
       return redirect()->route('questions.index')->with('success','question deleted successfully');
    }
}
