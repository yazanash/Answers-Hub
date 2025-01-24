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

            return view('profile.show');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=> 'required'
           ]);
           $input=$request->all();
           Category::create($input);
           return redirect()->route('categories.index')->with('success','Category created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Profile $profile)
    {
        return view('category.show',compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profile $profile)
    {
        return view('category.edit',compact('category'));
    
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Profile $profile)
    {
        $request->validate([
            'name'=> 'required'
           ]);
           $input=$request->all();
           $category->update($input);
           return redirect()->route('categories.index')->with('success','Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profile $profile)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success','Category deleted successfully');
    }
}
