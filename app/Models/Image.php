<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function imagetags() {
        return $this->hasMany(Imagetag::class, 'image_id', 'id');
    }

    public function likes() {
        return $this->belongsToMany(Image::class, 'likes', 'user_id', 'image_id');
    }
}
