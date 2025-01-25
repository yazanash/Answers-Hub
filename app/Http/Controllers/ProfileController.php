<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Auth;
class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        if($user->profile==null){

            return redirect()->route('profile.create');
        }
        $profile = $user->profile;
        return view('profile.show',compact('user'),compact('profile'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        return view('profile.create',compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
        $request->validate([
            'name'=> 'required',
            'bio'=> 'required',
            'gender'=> 'required',
           ]);
           $input=$request->all();
           if($photo=$request->file('photo')){
            $destination_path="images/profile/";
            $photo_path = date('YmdHis').".".$photo->getClientOriginalExtension();
            $photo->move($destination_path,$profile_path);
            $input['photo']=$photo_path;
       }
           $input['user_id']= Auth::user()->id;
           Profile::create($input);
           return redirect()->route('profile.index')->with('success','profile updated successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Profile $profile)
    {

        return view('profile.show',compact('profile'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profile $profile)
    {
        $user = Auth::user();
        return view('profile.edit',compact('profile'),compact('user'));
    
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Profile $profile)
    {
        $request->validate([
            'name'=> 'required',
            'bio'=> 'required',
            'gender'=> 'required'
           ]);
           $input=$request->all();
           if($photo=$request->file('photo')){
            $destination_path="images/profile";
            $photo_path = date('YmdHis').".".$photo->getClientOriginalExtension();
            $photo->move($destination_path,$photo_path);
            $input['photo']=$photo_path;
       }
           $profile->update($input);
           return redirect()->route('profile.index')->with('success','profile updated successfully');
    }

    
}
