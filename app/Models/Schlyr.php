<?php

namespace App\Models;

use App\Models\Organization;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Schlyr extends Model
{
    use HasFactory;

    protected $fillable = [
        'schlyr',
    ];

    public function organization()
    {
        return $this->hasMany(Organization::class);
    }

    public function file()
    {
        return $this->hasMany(File::class);
    }
}
