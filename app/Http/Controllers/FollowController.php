<?php

namespace App\Http\Controllers;

use App\Models\Follower;
use App\Models\User;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function followUnfollow(Request $request) {
        $followerId = User::findOrFail(auth()->user()->id);
        // dd($followerId);
        $followingId = User::findOrFail($request->userId);
        $followerId->following()->toggle($followingId);
        return redirect()->back();
    }

    public function profile() {
        $followings = Follower::where('follower_id', auth()->user()->id)->get();
        $userId=null;
        $follows=null;

        foreach ($followings as $following) {

            $userId = $following->userfollow->id;
            $follows = (new User())->amIfollowing($userId);
        }


        return view('profile', compact('userId', 'follows', 'followings'));
    }

    public function updateProfilePic(Request $request){
        $this->validate($request, [
            'image'=>'required|mimes:jpeg,jpg,png'
        ]);
        $image = $request->image->store('public/avatar');
        $authUser = auth()->user()->id;
        $user = User::where('id', $authUser)->update(['profilePic'=>$image]);

        return redirect()->back();

    }


    public function updateBgPic(Request $request){
        $this->validate($request, [
            'image'=>'required|mimes:jpeg,jpg,png'
        ]);
        $image = $request->image->store('public/avatar');
        $authUser = auth()->user()->id;
        $user = User::where('id', $authUser)->update(['bgPic'=>$image]);

        return redirect()->back();

    }

    

    public function userBgPic($id) {

        $user = User::findOrFail($id);
        return $user->bgpic;

    }
    public function userProfilePic($id) {

        $user = User::findOrFail($id);
        return $user->profilePic;

    }
}
