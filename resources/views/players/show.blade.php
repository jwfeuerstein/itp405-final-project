@extends('layouts.main')

@section('title')
{{$player->name}} Statistics
@endsection


@section('content')
<br />
<p>Points Per Game: {{$player->points_per_game}}</p>
<p>Rebounds Per Game: {{$player->rebounds_per_game}}</p>
<p>Assists Per Game: {{$player->assists_per_game}}</p>
<p>Field Goal Percentage: {{$player->fg_percentage}}%</p>
<p>Player Efficiency Rating: {{$player->efficiency}}</p>
@endsection