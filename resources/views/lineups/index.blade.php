@extends('layouts.main')

@section('title', 'Lineups')

@section('content')

@foreach($lineups as $lineup)
    <a href="{{route('lineups.show', [ 'id' => $lineup->id ])}}">{{$lineup->name}}</a>
    <br/>
@endforeach

@endsection