@extends('commands::layouts.master')

@section('content')
    <h1>Hello World</h1>

    <p>Module: {!! config('commands.name') !!}</p>
@endsection
