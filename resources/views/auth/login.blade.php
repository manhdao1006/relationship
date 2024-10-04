@extends('layouts.master')

@section('title')
    Login
@endsection

@section('content')
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('login') }}" method="post">
    @csrf

    <label for="email" class="mt-4">Email</label>
    <input type="email" name="email" id="email" class="form-control">

    <label for="password" class="mt-4">Password</label>
    <input type="password" name="password" id="password" class="form-control">

    <button type="submit" class="btn btn-primary mt-4">Login</button>

    </form>
@endsection