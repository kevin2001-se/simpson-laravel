<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{

    public function favorites($user_id)
    {
        $favorites = Favorite::where('user_id', $user_id)->get();

        return response()->json([
            'data' => $favorites->map(function ($q) {
                return $q->idSimpson;
            })
        ], 200);
    }

    public function store(Request $request)
    {
        Favorite::create([
            'user_id' => $request->user_id,
            'idSimpson' => $request->idSimpson
        ]);

        return response()->json([
            'message' => 'Se agrego correctamente a tus favoritos.'
        ], 200);
    }

    public function delete(Request $request)
    {
        $favorite = Favorite::where('user_id', $request->user_id)->where('idSimpson', $request->idSimpson)->first();

        $favorite->delete();

        return response()->json([
            'message' => 'Se quito correctamente de tus favoritos.'
        ], 200);
    }
}
