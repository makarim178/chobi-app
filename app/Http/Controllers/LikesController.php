<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Likes;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class LikesController extends Controller
{
    public function LikeUnlike(Request $request) {
        $userId = auth()->user()->id;

        //dd($request->imageid);
        $imageToLike= Image::findOrFail($request->imageid);

        $likeExists = Likes::where('image_id', $request->imageid)
            ->where('user_id', $userId)
            ->exists();


        if(!$likeExists){
            $like = Likes::create([
                'user_id'=>$userId,
                'image_id'=>$imageToLike->id,
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now()
            ]);
        }
        else {
            $like = Likes::where('image_id', $request->imageid)
            ->where('user_id', $userId)->delete();
        }



        //dd($imageToLike);
        //$userId->likes()->toggle($imageToLike);
        return response()->json($like);
    }

    public function doIlike($imageid) {
        $userId = auth()->user()->id;
        $like = Likes::where('image_id', $imageid)
            ->where('user_id', $userId)
            ->exists();

        return response()->json(["status"=>$like]);
    }
}
