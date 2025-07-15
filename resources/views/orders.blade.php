@extends('layout.app')

@section('content')
    <div class="container mt-5">
        <h2>Create New Order</h2>

        <form id="orderForm" method="POST">
            @csrf

            {{-- Customer Dropdown --}}
            <div class="mb-4">
                <label for="customer_id" class="form-label">Select Customer</label>
                <select name="customer_id" id="customer_id" class="form-select w-50">
                    <option value="">-- Select Customer --</option>
                    @foreach ($customers as $customer)
                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Product Row --}}
            <div id="productRows">
                <div class="row align-items-end product-row">
                    {{-- Product Dropdown --}}
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Select Product</label>
                        <select name="product_id[]" class="form-select product_id">
                            <option value="">-- Select Product --</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}" data-price="{{ $product->price }}">
                                    {{ $product->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Price --}}
                    <div class="col-md-2 mb-3">
                        <label class="form-label">Product Price</label>
                        <input type="text" class="form-control price" name="price[]" readonly>
                    </div>

                    {{-- Quantity --}}
                    <div class="col-md-2 mb-3">
                        <label class="form-label">Product Qty</label>
                        <input type="number" class="form-control qty" name="qty[]" min="1">
                    </div>

                    {{-- Total --}}
                    <div class="col-md-2 mb-3">
                        <label class="form-label">Total</label>
                        <input type="text" class="form-control total" name="total[]" readonly>
                    </div>

                    {{-- Action --}}
                    <div class="col-md-2 mb-3 button-col">
                        <label class="form-label">Action</label><br>
                        <button type="button" class="btn btn-danger addNew">
                            <i class="fa-solid fa-cart-plus"></i>
                        </button>
                    </div>
                </div>
            </div>

            {{-- Subtotal --}}
            <div class="row mt-3">
                <div class="col-md-3">
                    <label class="form-label">Sub Total</label>
                    <input type="text" class="form-control" id="subtotal" name="subtotal" readonly>
                </div>
            </div>

            {{-- Submit --}}
            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Place Order</button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        function calculateTotal(row) {
            const price = parseFloat(row.find('.price').val()) || 0;
            const qty = parseFloat(row.find('.qty').val()) || 0;
            const total = price * qty;
            row.find('.total').val(total.toFixed(2));
            updateSubTotal();
        }

        function updateSubTotal() {
            let subtotal = 0;
            $('.total').each(function() {
                subtotal += parseFloat($(this).val()) || 0;
            });
            $('#subtotal').val(subtotal.toFixed(2));
        }

        $(document).on('change', '.product_id', function() {
            const price = $(this).find(':selected').data('price') || 0;
            const row = $(this).closest('.product-row');
            row.find('.price').val(price);
            calculateTotal(row);
        });

        $(document).on('input', '.qty', function() {
            const row = $(this).closest('.product-row');
            calculateTotal(row);
        });

        $(document).on('click', '.addNew', function() {
            const clone = $('.product-row:first').clone();
            clone.find('select, input').val('');
            clone.find('.button-col').html(`
                <label class="form-label">Action</label><br>
                <button type="button" class="btn btn-secondary removeRow">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            `);
            $('#productRows').append(clone);
        });

        $(document).on('click', '.removeRow', function() {
            $(this).closest('.product-row').remove();
            updateSubTotal();
        });



        $("#orderForm").on('submit', function(e) {
            let formData = $(this).serialize();

            $.ajax({
                url: "{{ route('orders.store') }}",
                type: "POST",
                data: formData,
                contentType: false,
                procssData: false,
                success: function(response) {
                    Swal.fire('Success', 'ordered successfully!', 'success');
                    $('#orderForm')[0].reset();
                },
                error: function(xhr) {
                    let errorMsg = "Something went wrong!";
                    if (xhr.responseJSON?.errors) {
                        const errors = xhr.responseJSON.errors;
                        const firstKey = Object.keys(errors)[0];
                        errorMsg = errors[firstKey][0];
                    }
                    Swal.fire('Error', errorMsg, 'error');
                },
            })
        });
    </script>
@endpush
