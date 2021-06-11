<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use App\Models\User as ModelUser;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profilePic',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function following() {
        return $this->belongsToMany(ModelUser::class, 'followers', 'follower_id', 'following_id');
    }

    public function amIfollowing($userId) {
        return DB::table('followers')
            ->where('follower_id',auth()->user()->id)
            ->where('following_id',$userId)
            ->exists();
    }

    public function likes() {
        return $this->belongsToMany(Image::class, 'likes', 'user_id', 'image_id');
    }

    // public function amILiking($userId) {
    //     return DB::table('likes')
    //         -where('user_id', auth()->user()->id)
    //         -where('')
    // }
}
