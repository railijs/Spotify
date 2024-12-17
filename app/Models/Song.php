<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    use HasFactory;

    protected $fillable = [
        'playlist_id',
        'spotify_id',
        'name',
        'artist',
    ];

    public function playlist()
    {
        return $this->belongsTo(Playlist::class);
    }
}
