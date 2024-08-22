@extends('layouts.app')

@section('content')
    <h2>Recipes</h2>
    <ul>
        @foreach ($recipes as $recipe)
            <li>
                <strong>{{ $recipe['name'] }}</strong><br>
                Ingredients:
                <ul>
                    @foreach ($recipe['ingredients'] as $ingredient => $quantity)
                        <li>{{ $ingredient }}: {{ $quantity }}</li>
                    @endforeach
                </ul>
            </li>
        @endforeach
    </ul>
@endsection
