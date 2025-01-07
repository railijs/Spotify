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
        'spotify_playlist_link',
        'image_url',
    ];

    // Define the relationship with songs
    public function songs()
    {
        return $this->hasMany(Song::class); // Assuming Song is the related model
    }
}
