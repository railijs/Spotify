use App\Http\Controllers\PlaylistController;

Route::get('/playlists', [PlaylistController::class, 'getPlaylistsByMood']);
