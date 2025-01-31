<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
class ImageUploadController extends Controller
{
    public function upload(Request $request)
    {
        if($image=$request->file('image')){
            $destination_path='images/posts/';
            $image_path = date('YmdHis').".".$image->getClientOriginalExtension();
            $image->move($destination_path,$image_path);
            return response()->json(['success' => true, 'url' => '/'.$destination_path.$image_path ]);
       }
    //    else{
    //     unset($input['poster']);
    //    }
    //     if ($request->hasFile('image')) {
    //         $file = $request->file('image');
    //         $path = $file->store('images', 'public');
    //         return response()->json(['success' => true, 'url' => Storage::url($path)]);
    //     }
        return response()->json(['success' => false, 'message' => 'Image upload failed']);
    }
}
