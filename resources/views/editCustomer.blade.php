@extends('layout.app') {{-- or your base layout --}}

@section('content')
<div class="container mt-5">
    <h2>Edit Customer</h2>

    <form action="{{ route('customer.update', $customer->customer_id) }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" value="{{ $customer->name }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" value="{{ $customer->email }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Gender</label>
            <select name="gender" class="form-control">
                <option value="male" {{ $customer->gender == 'male' ? 'selected' : '' }}>Male</option>
                <option value="female" {{ $customer->gender == 'female' ? 'selected' : '' }}>Female</option>
            </select>
        </div>

        <div class="mb-3">
            <label>City</label>
            <input type="text" name="city" value="{{ $customer->city }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Address</label>
            <input type="text" name="address" value="{{ $customer->address }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Contact</label>
            <input type="text" name="contact" value="{{ $customer->contact }}" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('viewcustomer') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
