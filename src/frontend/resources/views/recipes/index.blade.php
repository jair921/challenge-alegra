@extends('layouts.app')

@section('content')
    <h2>Recetas</h2>
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Receta</th>
                <th>Ingredientes</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($recipes as $recipe)
                <tr>
                    <td>{{ $recipe['id'] }}</td>
                    <td>{{ $recipe['name'] }}</td>
                    <td>
                        <ul>
                            @foreach ($recipe['ingredients'] as $ingredient => $quantity)
                                <li>{{ $ingredient }}: {{ $quantity }}</li>
                            @endforeach
                        </ul>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
