<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Playlist;

class PlaylistSeeder extends Seeder
{
    public function run()
    {
        Playlist::create([
            'name' => 'Sad Playlist',
            'mood' => 'sad',
            'description' => 'A playlist for when you feel down.',
            'spotify_playlist_link' => 'https://open.spotify.com/playlist/37i9dQZF1EIh4v230xvJvd', // Sad playlist link
            'image_url' => 'https://static.vecteezy.com/system/resources/thumbnails/034/381/072/small_2x/blue-toy-and-alone-a-sad-emotion-on-a-rainy-day-with-a-natural-background-ai-generated-photo.jpg', // Sad playlist image
        ]);

        // Add more playlists as needed...
        Playlist::create([
            'name' => 'Happy Playlist',
            'mood' => 'happy',
            'description' => 'A playlist for when you are feeling good.',
            'spotify_playlist_link' => 'https://open.spotify.com/playlist/0RH319xCjeU8VyTSqCF6M4', // Happy playlist link
            'image_url' => 'https://rachelziv.com.au/wp-content/uploads/2020/01/happy.jpg', // Happy playlist image
        ]);
    }
}
