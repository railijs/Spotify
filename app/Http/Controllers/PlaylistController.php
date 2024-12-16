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
        ]);

        // Create a new playlist
        Playlist::create([
            'name' => $request->name,
            'mood' => $request->mood,
            'description' => $request->description,
        ]);

        return redirect()->route('playlists.create')->with('success', 'Playlist created successfully!');
    }

    public function history()
{
    $playlists = Playlist::all(); // Fetch all playlists
    return view('playlists.history', compact('playlists'));
}
}
