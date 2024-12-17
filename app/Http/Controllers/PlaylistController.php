<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use App\Models\Song;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PlaylistController extends Controller
{
    public function create()
    {
        return view('playlists.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'mood' => 'required|string',
            'description' => 'nullable|string',
            'songs' => 'nullable|array', // Allow adding songs during playlist creation
            'songs.*' => 'string', // Each song must be a string (Spotify track ID or name)
        ]);

        // Create a new playlist
        $playlist = Playlist::create([
            'name' => $request->name,
            'mood' => $request->mood,
            'description' => $request->description,
        ]);

        // Add songs to the playlist (if provided)
        if ($request->songs) {
            foreach ($request->songs as $songName) {
                $spotifySong = $this->searchSongOnSpotify($songName);

                if ($spotifySong) {
                    $playlist->songs()->create([
                        'spotify_id' => $spotifySong['id'],
                        'name' => $spotifySong['name'],
                        'artist' => $spotifySong['artist'],
                    ]);
                }
            }
        }

        return redirect()->route('playlists.create')->with('success', 'Playlist created successfully!');
    }

    public function history()
    {
        $playlists = Playlist::with('songs')->get(); // Fetch playlists with their songs
        return view('playlists.history', compact('playlists'));
    }

    private function searchSongOnSpotify($songName)
    {
        $clientId = config('services.spotify.client_id');
        $clientSecret = config('services.spotify.client_secret');

        // Obtain access token
        $tokenResponse = Http::asForm()->post('https://accounts.spotify.com/api/token', [
            'grant_type' => 'client_credentials',
            'client_id' => $clientId,
            'client_secret' => $clientSecret,
        ]);

        if (!$tokenResponse->successful()) {
            return null; // Handle error if token request fails
        }

        $accessToken = $tokenResponse->json()['access_token'];

        // Search for the song
        $response = Http::withToken($accessToken)->get('https://api.spotify.com/v1/search', [
            'q' => $songName,
            'type' => 'track',
            'limit' => 1,
        ]);

        if (!$response->successful()) {
            return null; // Handle error if song search fails
        }

        $track = $response->json()['tracks']['items'][0] ?? null;

        if ($track) {
            return [
                'id' => $track['id'],
                'name' => $track['name'],
                'artist' => $track['artists'][0]['name'],
            ];
        }

        return null;
    }
}
