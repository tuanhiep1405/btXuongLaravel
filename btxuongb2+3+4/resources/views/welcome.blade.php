@extends('master')

@section('content')
    <h1 class="text-center">Chào các bà con đến web</h1>
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
@endsection
