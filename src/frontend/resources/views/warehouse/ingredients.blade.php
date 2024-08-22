@extends('layouts.app')

@section('content')
    <h2>Ingredients Status</h2>
    <ul>
        @foreach ($ingredients as $ingredient)
            <li>{{ $ingredient['name'] }}: {{ $ingredient['quantity'] }} available</li>
        @endforeach
    </ul>
@endsection
