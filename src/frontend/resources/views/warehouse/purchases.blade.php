@extends('layouts.app')

@section('content')
    <h2>Compras Plaza</h2>

    @if ($purchases['data'])
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Cantidad</th>
                <th>Ingrediente</th>
                <th>Estado</th>
                <th>Fecha Solicitud</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($purchases['data'] as $purchase)
                <tr>
                    <td>{{ $purchase['quantity'] }}</td>
                    <td>{{ $purchase['ingredient_name'] }}</td>
                    <td>{{ $purchase['status'] }}</td>
                    <td>{{ $purchase['purchase_date'] }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <nav>
            <ul class="pagination">
                <li class="page-item {{ is_null($purchases['prev_page_url']) ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $purchases['prev_page_url'] }}" aria-label="Previous">
                        <span aria-hidden="true">&laquo; Previous</span>
                    </a>
                </li>

                @foreach ($purchases['links'] as $link)
                    @if ($link['url'])
                        <li class="page-item {{ $link['active'] ? 'active' : '' }}">
                            <a class="page-link" href="{{ $link['url'] }}">{{ $link['label'] }}</a>
                        </li>
                    @endif
                @endforeach

                <li class="page-item {{ is_null($purchases['next_page_url']) ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $purchases['next_page_url'] }}" aria-label="Next">
                        <span aria-hidden="true">Next &raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>

    @else
        <div class="alert alert-info">No orders found.</div>
    @endif
@endsection
