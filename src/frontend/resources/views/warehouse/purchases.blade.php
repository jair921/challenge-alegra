@extends('layouts.app')

@section('content')
    <h2>Purchase History</h2>
    <ul>
        @foreach ($purchases as $purchase)
            <li>
                Purchased {{ $purchase['quantity'] }} {{ $purchase['ingredient_name'] }} on {{ $purchase['purchase_date'] }} (Status: {{ $purchase['status'] }})
            </li>
        @endforeach
    </ul>
@endsection
