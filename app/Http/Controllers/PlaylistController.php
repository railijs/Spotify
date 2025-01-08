<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use Illuminate\Http\Request;

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
        'spotify_playlist_link' => 'nullable|url', // Accept Spotify playlist link
    ]);

    // Create a new playlist with all relevant details
    Playlist::create([
        'name' => $request->name,
        'mood' => $request->mood,
        'description' => $request->description,
        'spotify_playlist_link' => $request->spotify_playlist_link,
    ]);

    return response()->json(['success' => true], 201); // Return a success response after saving
}

    public function history()
    {
        $playlists = Playlist::with('songs')->get(); // Fetch playlists with their songs
        return view('playlists.history', compact('playlists'));
    }

    private function addSongsFromSpotifyPlaylist(Playlist $playlist, string $playlistLink)
    {
        // Extract the playlist ID from the link
        preg_match('/(?:https?:\/\/)?(?:www\.)?(?:open\.|play\.|music\.)?spotify\.com\/playlist\/([a-zA-Z0-9]+)/', $playlistLink, $matches);

        if (isset($matches[1])) {
            $playlistId = $matches[1];

            // Here you would typically fetch the playlist details using an API call.
            // However, since we are not using the API, we will assume you have a way to get the song details.
            // For demonstration purposes, let's assume you have a method that fetches songs from your database or a predefined list.

            // Example: Fetch songs based on your own logic or data source
            // This is a placeholder for actual song retrieval logic
            $songs = [
                ['spotify_id' => 'song_id_1', 'name' => 'Song 1', 'artist' => 'Artist 1'],
                ['spotify_id' => 'song_id_2', 'name' => 'Song 2', 'artist' => 'Artist 2'],
                // Add more songs as needed
            ];

            foreach ($songs as $song) {
                $playlist->songs()->create($song);
            }
        }
    }
    public function index()
{
    return Playlist::all(); // Return all playlists as JSON
}

}
