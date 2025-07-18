@extends('layout.app')

@section('content')
<div class="container mt-5">
    <h4>Customer Ordered List</h4>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>#</th> 
                <th>Customer Name</th>
                <th>Products</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $index => $order)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $order->order->customer->name ?? 'N/A' }}</td>
                    <td>
                        @php
                            $products = json_decode($order->product_name, true);
                        @endphp
                        @foreach ($products as $i => $product)
                            {{ $i + 1 }}. {{ $product }}<br>
                        @endforeach
                    </td>
                    <td>{{ $order->subtotal }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
