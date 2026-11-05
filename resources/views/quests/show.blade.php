@extends('layouts.app')

@section('title', $quest['title'])

@section('content')
    <h1>{{ $quest['title'] }}</h1>
    <p>{{ $quest['xp'] }} XP</p>
@endsection
