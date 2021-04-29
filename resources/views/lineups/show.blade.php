@extends('layouts.main')

@section('title') 
{{$lineup->name}} Lineup
@endsection

@section('content')
    <br/>
    <div style="display: inline-block;">
    <h5>Starting Lineup</h5>
    <p style="display: inline-block;">Point Guard: </p>
    <a href="{{route('players.show', [ 'id' => $player1->id ])}}" style="display: inline-block;">{{$player1->name}}</a>
    <br />
    <p style="display: inline-block;">Shooting Guard: </p>
    <a href="{{route('players.show', [ 'id' => $player2->id ])}}" style="display: inline-block;">{{$player2->name}}</a>
    <br />
    <p style="display: inline-block;">Small Forward: </p>
    <a href="{{route('players.show', [ 'id' => $player3->id ])}}" style="display: inline-block;">{{$player3->name}}</a>
    <br/>
    <p style="display: inline-block;">Power Forward: </p>
    <a href="{{route('players.show', [ 'id' => $player4->id ])}}" style="display: inline-block;">{{$player4->name}}</a>
    <br/>
    <p style="display: inline-block;">Center: </p>
    <a href="{{route('players.show', [ 'id' => $player5->id ])}}" style="display: inline-block;">{{$player5->name}}</a>
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