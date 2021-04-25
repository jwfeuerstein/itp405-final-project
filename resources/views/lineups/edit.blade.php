@extends('layouts.main')

@section('title')
Editing {{$lineup->name}}
@endsection

@section('content')
<form action="{{route('lineups.save', ['id' => $lineup->id])}}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" name="name" id="name" class="form-control" value="{{old('name', $lineup->name)}}">
        @error('name')
            <small class="text-danger">{{$message}}</small>
        @enderror
    </div>
    <div class="mb-3">
        <label for="pg" class="form-label">Point Guard</label>
        <select name="pg" id="pg" class="form-select">
            <option value="">-- Select Point Guard --</option>
            @foreach($players as $player)
                <option
                 value="{{$player->id}}"
                 {{ (string) $player->id === old('pg') ? "selected" : ""}}
                 {{ $player->id === $lineup->player1_id ? "selected" : ""}}
                >
                    {{$player->name}}
                </option>
            @endforeach
        </select>
        @error('pg')
            <small class="text-danger">{{$message}}</small>
        @enderror
    </div>
    <div class="mb-3">
        <label for="sg" class="form-label">Shooting Guard</label>
        <select name="sg" id="sg" class="form-select">
            <option value="">-- Select Shooting Guard --</option>
            @foreach($players as $player)
                <option
                 value="{{$player->id}}"
                 {{ (string) $player->id === old('sg') ? "selected" : ""}}
                 {{ $player->id === $lineup->player2_id ? "selected" : ""}}
                >
                    {{$player->name}}
                </option>
            @endforeach
        </select>
        @error('sg')
            <small class="text-danger">{{$message}}</small>
        @enderror
    </div>
    <div class="mb-3">
        <label for="sf" class="form-label">Small Forward</label>
        <select name="sf" id="sf" class="form-select">
            <option value="">-- Select Small Forward --</option>
            @foreach($players as $player)
                <option
                 value="{{$player->id}}"
                 {{ (string) $player->id === old('sf') ? "selected" : ""}}
                 {{ $player->id === $lineup->player3_id ? "selected" : ""}}
                >
                    {{$player->name}}
                </option>
            @endforeach
        </select>
        @error('sf')
            <small class="text-danger">{{$message}}</small>
        @enderror
    </div>
    <div class="mb-3">
        <label for="pf" class="form-label">Power Forward</label>
        <select name="pf" id="pf" class="form-select">
            <option value="">-- Select Power Forward --</option>
            @foreach($players as $player)
                <option
                 value="{{$player->id}}"
                 {{ (string) $player->id === old('pf') ? "selected" : ""}}
                 {{ $player->id === $lineup->player4_id ? "selected" : ""}}
                >
                    {{$player->name}}
                </option>
            @endforeach
        </select>
        @error('pf')
            <small class="text-danger">{{$message}}</small>
        @enderror
    </div>
    <div class="mb-3">
        <label for="c" class="form-label">Center</label>
        <select name="c" id="c" class="form-select">
            <option value="">-- Select Center --</option>
            @foreach($players as $player)
                <option
                 value="{{$player->id}}"
                 {{ (string) $player->id === old('c') ? "selected" : ""}}
                 {{ $player->id === $lineup->player5_id ? "selected" : ""}}
                >
                    {{$player->name}}
                </option>
            @endforeach
        </select>
        @error('c')
            <small class="text-danger">{{$message}}</small>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">
        Save
    </button>
</form>
@endsection