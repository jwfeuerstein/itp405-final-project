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
    <a href="{{ route('lineups.edit', ['id' => $lineup->id]) }}" style="display:inline-block;" class="btn btn-secondary btn-sm">Edit This Lineup</a>
    <form action="{{route('lineups.delete', ['id' => $lineup->id])}}" style="display:inline-block; margin-left:10px;" method="POST">
        @csrf
        <button type="submit" class="btn btn-danger btn-sm">
            Delete This Lineup
        </button>
    </form>
    <br />
    <br />
    <br />
    <form action="{{route('lineups.comment', ['id' => $lineup->id])}}" method="POST">
        @csrf
        <label for="content" class="form-label">Post a Comment:</label>
        <input type="text" name="content" id="content" class="form-control" value="{{old('content')}}">
        @error('content')
        <small class="text-danger">{{$message}}</small>
        @enderror
        <br/>
        <button type="submit" class="btn btn-primary btn-sm" style="margin-top:20px;">
            Post
        </button>
    </form>
    <br/>
    <br />
    <h4>Comments:</h4>
    <br/>
    @foreach($comments->sortByDesc('created_at') as $comment)
    <h5>{{ $comment->content }}</h5>
    <small>Posted {{ $comment->created_at }} by {{ $comment->name }}</small>
    <br />
    <br />
    @endforeach
@endsection