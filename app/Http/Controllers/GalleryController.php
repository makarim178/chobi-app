<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\Imagetag;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GalleryController extends Controller
{
    public function create($id) {
        $albumBelongsToUser = Album::where('user_id', auth()->user()->id)->where('id',$id)->exists();

        if($albumBelongsToUser) {
            $album_id = $id;
            session()->put('id', $id);
            return view('image.create',compact('album_id'));        
        }else {
            return redirect()->back();
        }
    }


    public function showTags($id) {
        $image = Image::with('imagetags')->findOrFail($id);
        return view('image.show', compact('image'));
    }

    public function addTags($id,Request $request) {

        $this->validate($request, [
            //'image'=>'required|mimes:png,jpg,jpeg',
            'tags'=>'required|array|min:1',
            'tags.*'=>'required|string|distinct|min:2'
        ]);

        $img = Image::where('id', $id)->exists();
        $existingTag = Imagetag::where('image_id', $id)->delete();

        if($img) {
            foreach ($request->tags as $tag) {
                $tagtosave =  Imagetag::create([
                    'tag'=>$tag,
                    'image_id'=>$id
                ]);
            }
        }

        $img = Image::with('imagetags')->findOrFail($id);

        return response()->json($img);
    }

    public function upload(Request $request) {
        $this->validate($request, [
            'files'=>' required',
            'files.*'=>'mimes:png,jpg,jpeg',

        ]);

        foreach($request->file('files') as $file) {
            $name = $file->hashName();
            $file->move(public_path().'/images/', $name);

            $file = new Image;
            $file->album_id = $request->album_id;
            $file->image = $name;
            $file->save();
        }

        return response()->json(['success' => 'Your Images successfully uploaded']);
    }

    public function images() {
        return Image::where('album_id', session()->get('id'))->get();
    }

    public function getImagesbytags($tag = null) {
        $images = Image::with('imagetags')->get();
        if ($tag != null) 
        {
            $images = Image::join('imagetags', 'imagetags.image_id', '=', 'images.id')
                ->where('imagetags.tag', 'LIKE', '%'.$tag.'%')->get();

        }
        //dd($images);
        return $images;
    }

    public function destroy($id) {
        $image = Image::findOrFail($id);
        if($image) {
            unlink(public_path('/images/'.$image->image));
            return $image->delete();
        }
    }

    public function viewAlbum ($slug, $id) {
        $albums = Album::with('albumimages')->where('slug',$slug)->where('id', $id)->get();
        $userId=null;
        $follows=false;
        
        if(Auth::check()) {
            
            $userId = Album::where('id', $id)->first()->user_id;
            $follows = (new User)->amIfollowing($userId);
        }

        return view('album.show', compact('albums','follows', 'userId'));
    }
}
