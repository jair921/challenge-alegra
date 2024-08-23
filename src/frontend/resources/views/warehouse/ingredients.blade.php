@extends('layouts.app')

@section('content')
    <h2>Ingredientes</h2>

    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Ingrediente</th>
            <th>Cantidad disponible</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($ingredients as $ingredient)
                <tr>
                    <td>{{ $ingredient['name'] }}</td>
                    <td>{{ $ingredient['quantity'] }} unidades</td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection
