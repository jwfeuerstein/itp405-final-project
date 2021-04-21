<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LineupController extends Controller
{
    public function index()
    {
        $lineups = DB::table('lineups')->get([
            'id',
            'name'
        ]);
        return view('lineups.index', [
            'lineups' => $lineups,
        ]);
    }

    public function show($id)
    {
        $lineup = DB::table('lineups')->where('id', '=', $id)->first();

        $player1 = DB::table('lineups')
            ->join('players', 'lineups.player1_id', '=', 'players.id')
            ->join('statistics', 'lineups.player1_id', '=', 'statistics.player_id')
            ->first();

        $player2 = DB::table('lineups')
            ->join('players', 'lineups.player2_id', '=', 'players.id')
            ->join('statistics', 'lineups.player1_id', '=', 'statistics.player_id')
            ->first();

        $player3 = DB::table('lineups')
            ->join('players', 'lineups.player3_id', '=', 'players.id')
            ->join('statistics', 'lineups.player1_id', '=', 'statistics.player_id')
            ->first();

        $player4 = DB::table('lineups')
            ->join('players', 'lineups.player4_id', '=', 'players.id')
            ->join('statistics', 'lineups.player1_id', '=', 'statistics.player_id')
            ->first();

        $player5 = DB::table('lineups')
            ->join('players', 'lineups.player5_id', '=', 'players.id')
            ->join('statistics', 'lineups.player1_id', '=', 'statistics.player_id')
            ->first();

        $total_ppg = $player1->points_per_game + $player2->points_per_game +
            $player3->points_per_game + $player4->points_per_game +
            $player5->points_per_game;

        $total_rpg = $player1->rebounds_per_game + $player2->rebounds_per_game +
            $player3->rebounds_per_game + $player4->rebounds_per_game +
            $player5->rebounds_per_game;

        $total_apg = $player1->assists_per_game + $player2->assists_per_game +
            $player3->assists_per_game + $player4->assists_per_game +
            $player5->assists_per_game;

        $avg_fgp = ($player1->fg_percentage + $player2->fg_percentage +
            $player3->fg_percentage + $player4->fg_percentage +
            $player5->fg_percentage) / 5.0;

        $avg_per = ($player1->efficiency + $player2->efficiency +
            $player3->efficiency + $player4->efficiency +
            $player5->efficiency) / 5.0;

        return view('lineups.show', [
            'lineup' => $lineup,
            'player1' => $player1,
            'player2' => $player2,
            'player3' => $player3,
            'player4' => $player4,
            'player5' => $player5,
            'total_ppg' => $total_ppg,
            'total_rpg' => $total_rpg,
            'total_apg' => $total_apg,
            'avg_fgp' => $avg_fgp,
            'avg_per' => $avg_per,
        ]);
    }
}
