<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'mood',
        'description',
    ];

    // Define the relationship with Song
    public function songs()
    {
        return $this->hasMany(Song::class);
    }
}
