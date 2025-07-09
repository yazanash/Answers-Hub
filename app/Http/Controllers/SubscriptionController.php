<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;
use Auth;
class SubscriptionController extends Controller
{
    public function subscribe(Request $request)
    {
        $subscription = Subscription::create([
            'user_id' => Auth::user()->id,
            'group_id' => $request->group_id,
        ]);
    
        return redirect()->back();
    }
    
    public function unsubscribe(Request $request)
    {
        Subscription::where('user_id', Auth::user()->id)
            ->where('group_id', $request->group_id)
            ->delete();
    
            return redirect()->back();
    }
}
