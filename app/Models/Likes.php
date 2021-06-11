<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Likes extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function userLikes() {
        return $this->belongsTo(Image::class, 'image_id', 'id');
    }
}
