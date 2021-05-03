<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class LineupController extends Controller
{

    public function home()
    {
        return view('home');
    }

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
        if (!$lineup) {
            abort(404);
        }
        $player1 = DB::table('lineups')
            ->where('lineups.id', '=', $id)
            ->join('players', 'lineups.player1_id', '=', 'players.id')
            ->join('statistics', 'lineups.player1_id', '=', 'statistics.player_id')
            ->first();

        $player2 = DB::table('lineups')
            ->where('lineups.id', '=', $id)
            ->join('players', 'lineups.player2_id', '=', 'players.id')
            ->join('statistics', 'lineups.player2_id', '=', 'statistics.player_id')
            ->first();

        $player3 = DB::table('lineups')
            ->where('lineups.id', '=', $id)
            ->join('players', 'lineups.player3_id', '=', 'players.id')
            ->join('statistics', 'lineups.player3_id', '=', 'statistics.player_id')
            ->first();

        $player4 = DB::table('lineups')
            ->where('lineups.id', '=', $id)
            ->join('players', 'lineups.player4_id', '=', 'players.id')
            ->join('statistics', 'lineups.player4_id', '=', 'statistics.player_id')
            ->first();

        $player5 = DB::table('lineups')
            ->where('lineups.id', '=', $id)
            ->join('players', 'lineups.player5_id', '=', 'players.id')
            ->join('statistics', 'lineups.player5_id', '=', 'statistics.player_id')
            ->first();

        /*
        $players = DB::table('lineups')
            ->where('lineups.id', '=', $id)
            ->join('players', function ($join) {
                $join->on('lineups.player1_id', '=', 'players.id');
                $join->orOn('lineups.player2_id', '=', 'players.id');
                $join->orOn('lineups.player3_id', '=', 'players.id');
                $join->orOn('lineups.player4_id', '=', 'players.id');
                $join->orOn('lineups.player5_id', '=', 'players.id');
            })
            ->join('statistics', function ($join) {
                $join->on('players.id', '=', 'statistics.player_id');
            })
            ->get();
            */
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

        $comments = DB::table('comments')
            ->where('comments.lineup_id', '=', $lineup->id)
            ->join('users', 'comments.user_id', '=', 'users.id')
            ->get();

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
            'comments' => $comments,
        ]);
    }

    public function create()
    {
        $players = DB::table('players')->orderBy('name')->get();
        return view('lineups.create', [
            'players' => $players,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:50',
            'pg' => 'required|exists:players,id',
            'sg' => 'required|exists:players,id',
            'sf' => 'required|exists:players,id',
            'pf' => 'required|exists:players,id',
            'c' => 'required|exists:players,id',
        ]);

        //Get the max id from that table and add 1 to it
        $seq = DB::table('lineups')->max('id') + 1;

        // alter the sequence to now RESTART WITH the new sequence index from above        
        DB::select('ALTER SEQUENCE ' . 'lineups' . '_id_seq RESTART WITH ' . $seq);

        DB::table('lineups')->insert([
            'name' => $request->input('name'),
            'player1_id' => $request->input('pg'),
            'player2_id' => $request->input('sg'),
            'player3_id' => $request->input('sf'),
            'player4_id' => $request->input('pf'),
            'player5_id' => $request->input('c'),
        ]);

        return redirect()
            ->route('lineups.index')
            ->with('success', "Successfully created {$request->input('name')}");
    }

    public function delete($id)
    {
        $lineup = DB::table('lineups')->where('id', '=', $id)->first();
        DB::table('comments')->where('lineup_id', '=', $id)->delete();
        DB::table('lineups')->where('id', '=', $id)->delete();
        return redirect()
            ->route('lineups.index')
            ->with('success', "Successfully deleted {$lineup->name}");
    }

    public function edit($id)
    {
        $lineup = DB::table('lineups')->where('id', '=', $id)->first();
        if (!$lineup) {
            abort(404);
        }
        $players = DB::table('players')->orderBy('name')->get();

        return view('lineups.edit', [
            'lineup' => $lineup,
            'players' => $players,
        ]);
    }

    public function save($id, Request $request)
    {
        $request->validate([
            'name' => 'required|max:50',
            'pg' => 'required|exists:players,id',
            'sg' => 'required|exists:players,id',
            'sf' => 'required|exists:players,id',
            'pf' => 'required|exists:players,id',
            'c' => 'required|exists:players,id',
        ]);

        DB::table('lineups')->where('id', '=', $id)->update([
            'name' => $request->input('name'),
            'player1_id' => $request->input('pg'),
            'player2_id' => $request->input('sg'),
            'player3_id' => $request->input('sf'),
            'player4_id' => $request->input('pf'),
            'player5_id' => $request->input('c'),
        ]);

        return redirect()
            ->route('lineups.index')
            ->with('success', "Successfully edited {$request->input('name')}");
    }

    public function comment($id, Request $request)
    {
        $request->validate([
            'content' => 'required|min:5',
        ]);

        if (!Auth::check()) {
            return redirect()
                ->route('lineups.show', ['id' => $id])
                ->with('error', 'Must be logged in to post a comment.');
        }

        DB::table('comments')->insert([
            'user_id' => Auth::id(),
            'lineup_id' => $id,
            'content' => $request->input('content'),
            'created_time' => Carbon::now(),
            'updated_time' => Carbon::now(),
        ]);

        return redirect()
            ->route('lineups.show', ['id' => $id])
            ->with('success', 'Successfully posted comment.');
    }
}
