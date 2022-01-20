<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'file',
        'optradio',
        'status',
        'organization_id',
        'schlyr_id'
    ];

    public function ownedBy(User $user)
    {
        return $user->id === $this->user_id;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
