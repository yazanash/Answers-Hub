<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Auth;
class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $groups= Group::latest()->paginate(10);
        $subscriptions = Subscription::where('user_id', Auth::user()->id)->pluck('group_id')->toArray();
        return view('group.index',compact('groups','subscriptions'))->with('1'.(request()->input('page',1) -1 )*10);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('group.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'name'=> 'required',
            'description' =>  'required',
            'poster' => 'required|image|mimes:png,jpg,jpeg|max:2048'
           ]);
           $input=$request->all();
           if($poster=$request->file('poster')){
                $destination_path="images/";
                $proster_path = date('YmdHis').".".$poster->getClientOriginalExtension();
                $poster->move($destination_path,$proster_path);
                $input['poster']=$proster_path;
           }
           Group::create($input);
           return redirect()->route('groups.index')->with('success','Group created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Group $group)
    {
        return view('group.show',compact('group'));
    }
    public function public_show($slug)
    {
        $group = Group::where('slug', $slug)->firstOrFail();
        return view('group.show',compact('group'));
    
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Group $group)
    {
        return view('group.edit',compact('group'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Group $group)
    {
        $request->validate([
            'name'=> 'required',
            'description' =>  'required',
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
           $group->update($input);
           return redirect()->route('groups.index')->with('success','Group updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Group $group)
    {
        $group->delete();
       return redirect()->route('groups.index')->with('success','Group deleted successfully');
    }
}
