<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $categories= Category::latest()->paginate(10);
        return view('category.index',compact('categories'))->with('1'.(request()->input('page',1) -1 )*5);
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
    public function show(Category $category)
    {
        return view('category.show',compact('category'));
    }
    public function public_show($slug)
    {
        
        $category = Category::where('slug', $slug)->firstOrFail();
        return view('category.show',compact('category'));
    
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('category.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
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
    public function destroy(Category $category)
    {
        
       $category->delete();
       return redirect()->route('categories.index')->with('success','Category deleted successfully');
    }
}
