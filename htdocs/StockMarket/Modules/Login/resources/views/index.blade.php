@extends('login::layouts.master')

@section('content')
    <h1>Hello World</h1>

    <p>Module: {!! config('login.name') !!}</p>
@endsection
