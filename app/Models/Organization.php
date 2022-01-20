<?php

namespace App\Models;

use App\Models\User;
use App\Models\Schlyr;
use App\Models\Profile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Organization extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'image',
        'schlyr_id'
    ];

    public function schlyr()
    {
        return $this->belongsTo(Schlyr::class);
    }

    public function profile()
    {
        return $this->hasMany(Profile::class);
    }

    public function files()
    {
        return $this->hasMany(File::class);
    }
}
