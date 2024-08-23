@extends('layouts.app')

@section('title', 'Orders')

@section('content')
    <h1 class="mb-4">Ordenes</h1>

    <form action="{{ route('recipes.createOrder') }}" method="POST">
        @csrf
        <button class="btn btn-info mb-2" type="submit">Solicitar plato aleatorio</button>
    </form>


    @if ($orders['data'])
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Orden ID</th>
                <th>Receta/Plato</th>
                <th>Estado</th>
                <th>Fecha Solicitud</th>
                <th>Fecha Actualización</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($orders['data'] as $order)
                <tr>
                    <td>{{ $order['order_id'] }}</td>
                    <td>{{ $order['recipe'] }}</td>
                    <td>{{ $order['status'] }}</td>
                    <td>{{ $order['created_at'] }}</td>
                    <td>{{ $order['updated_at'] }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <nav>
            <ul class="pagination">


                @foreach ($orders['links'] as $link)
                    @if ($link['url'])
                        <li class="page-item {{ $link['active'] ? 'active' : '' }}">
                            <a class="page-link" href="{{ $link['url'] }}">{!!   $link['label'] !!}</a>
                        </li>
                    @endif
                @endforeach


            </ul>
        </nav>

    @else
        <div class="alert alert-info">No orders found.</div>
    @endif
@endsection
