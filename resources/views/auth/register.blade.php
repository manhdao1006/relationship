@extends('layouts.master')

@section('title')
    Register
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

    <form action="{{ route('register') }}" method="post">
        @csrf
        
        <label for="name" class="mt-4">Name</label>
        <input type="text" name="name" id="name" class="form-control">

        <label for="email" class="mt-4">Email</label>
        <input type="email" name="email" id="email" class="form-control">

        <label for="password" class="mt-4">Password</label>
        <input type="password" name="password" id="password" class="form-control">

        <label for="password_confirmation" class="mt-4">Confirm Password</label>
        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">

        <button type="submit" class="btn btn-primary mt-4">Register</button>

    </form>
@endsection