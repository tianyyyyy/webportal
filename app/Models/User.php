<?php

namespace App\Models;

use App\Models\File;
use App\Models\Profile;
use App\Models\Organization;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

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
        'username',
        'email',
        'password',
        'admin',
        'position',
        'organization_id',
        'status',
        'schlyr_id'
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

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function receivedLikes()
    {
        return $this->hasManyThrough(Like::class, Post::class);
    }

    public function files()
    {
        return $this->hasMany(File::class);
    }

    public function organizations()
    {
        return $this->hasMany(Organization::class);
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function profiles()
    {
        return $this->hasMany(Profile::class);
    }
}
