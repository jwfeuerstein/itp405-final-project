<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlayerController extends Controller
{
    public function show($id)
    {
        $player = DB::table('players')
            ->where('players.id', '=', $id)
            ->join('statistics', 'players.id', '=', 'statistics.player_id')
            ->first();

        if (!$player) {
            abort(404);
        }

        return view('players.show', [
            'player' => $player,
        ]);
    }
}
