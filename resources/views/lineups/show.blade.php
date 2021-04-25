@extends('layouts.main')

@section('title', $lineup->name)

@section('content')
    <br/>
    <div style="display: inline-block">
    <h5>Starting Lineup</h5>
    <p>Point Guard: {{$player1->name}}</p>
    <p>Shooting Guard: {{$player2->name}}</p>
    <p>Small Forward: {{$player3->name}}</p>
    <p>Power Forward: {{$player4->name}}</p>
    <p>Center: {{$player5->name}}</p>
    </div>

    <div style="display: inline-block; margin-left: 300px;">
        <h5>Lineup Statistics</h5>
        <p>Total Points Per Game: {{$total_ppg}}</p>
        <p>Total Rebounds Per Game: {{$total_rpg}}</p>
        <p>Total Assists Per Game: {{$total_apg}}</p>
        <p>Average Field Goal Percentage: {{$avg_fgp}}%</p>
        <p>Average Player Efficiency Rating: {{$avg_per}}</p>
    </div>
    <br/>
    <br/>
    <form action="{{route('lineups.delete', ['id' => $lineup->id])}}" method="POST">
        @csrf
        <button type="submit" class="btn btn-danger btn-sm">
            Delete Lineup
        </button>
    </form>
    
@endsection