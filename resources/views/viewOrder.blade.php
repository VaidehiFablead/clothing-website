@extends('layout.app')

@section('content')
    <div class="container mt-5">
        <h4>Customer Ordered List</h4>

        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Customer ID</th> {{-- or Customer Name if you stored it --}}
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->customer_id }}</td>
                        <td>{{ $order->product_name }}</td>
                        <td>{{ $order->price }}</td>
                        <td>{{ $order->qty }}</td>
                        <td>{{ $order->subtotal }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
