<?php

namespace App\Models;

use App\Models\Organization;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'age',
        'yrsec',
        'image',
        'position',
        'organization_id',
        'schlyr_id',
        'user_id'
    ];

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }
}
