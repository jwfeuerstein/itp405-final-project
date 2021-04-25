@extends('layouts.main')

@section('title', 'Lineups')

@section('content')

@foreach($lineups as $lineup)
    <a href="{{route('lineups.show', [ 'id' => $lineup->id ])}}">{{$lineup->name}}</a>
    <br/>
@endforeach
<br/>
<a href="{{ route('lineups.create') }}" class="btn btn-primary btn-sm">Create New Lineup</a>
@endsection