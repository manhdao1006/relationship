@extends('layouts.master')

@section('title')
    Dashboard Admin
@endsection

@section('content')
    <h2>Hi, {{ Auth::user()->name }}</h2>

    <form action="{{ route('logout') }}" method="post">
        @csrf

        <button type="submit" class="btn btn-danger mt-4">Logout</button>
    </form>
@endsection