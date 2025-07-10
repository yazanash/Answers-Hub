<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Group;
use App\Models\Profile;
use Illuminate\Http\Request;
use Auth;
use Share;
use App\Models\Subscription;
use App\Notifications\NewPostNotification;
use App\Events\PostCreated;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts= Post::latest()->paginate(5);
        return view('post.index',compact('posts'))->with('1'.(request()->input('page',1) -1 )*5);
   
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories= Category::all();
        $groups= Group::all();
        return view('post.create',compact('groups'),compact('categories'));
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
            'poster' => 'required|image|mimes:png,jpg,jpeg|max:2048'
           ]);
           $input=$request->all();
           if($poster=$request->file('poster')){
                $destination_path="images/";
                $proster_path = date('YmdHis').".".$poster->getClientOriginalExtension();
                $poster->move($destination_path,$proster_path);
                $input['poster']=$proster_path;
           }
           $input['user_id']= Auth::user()->id;
           $post = Post::create($input);
           $subscriptions = Subscription::where('group_id', $post->group_id)->get();

           foreach ($subscriptions as $subscription) {
               $subscription->user->notify(new NewPostNotification($post));
           }
           event(new PostCreated($post)); // send question created event
           return redirect()->route('posts.show',$post->id)->with('success','Post created successfully');
    
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $groups= Group::latest()->get()->take(5);
        $posts=Post::latest()->get()->take(5);
        $profile=$post->user->profile;
        // dd($groups);
        $shareLinks = Share::page(route('posts.show.slug',$post->slug))
    ->facebook()
    ->twitter()
    ->linkedin()
    ->whatsapp()
    ->reddit()
    ->getRawLinks();
        return view('post.show',compact('post'),compact('groups'))
        ->with(compact('posts'))->with(compact('profile'))->with(['shareLinks' => $shareLinks]);
    }
    public function public_show($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        $groups= Group::latest()->get()->take(5);
        $posts=Post::latest()->get()->take(5);
        $profile=$post->user->profile;
        $shareLinks = Share::page(route('posts.show.slug',$post->slug))
        ->facebook()
        ->twitter()
        ->linkedin()
        ->whatsapp()
        ->reddit()
        ->getRawLinks();
        return view('post.show', compact('post'),compact('groups'))->with(compact('profile'))->with(compact('posts'))
        ->with(['shareLinks' => $shareLinks]);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $categories= Category::all();
        $groups= Group::all();
        return view('post.edit',compact('post'),compact('groups'))->with(compact('categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title'=> 'required',
            'content' =>  'required',
            'group_id' =>  'required',
            'category_id' =>  'required',
           ]);
           $input=$request->all();
           if($poster=$request->file('poster')){
                $destination_path='images/';
                $proster_path = date('YmdHis').".".$poster->getClientOriginalExtension();
                $poster->move($destination_path,$proster_path);
                $input['poster']=$proster_path;
           }
           else{
            unset($input['poster']);
           }
           $post->update($input);
           return redirect()->route('posts.show',$post->id)->with('success','Post updated successfully');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
       return redirect()->route('home')->with('success','Post deleted successfully');
    
    }
}
