@extends('front.layout.main')

@section('title', 'Cart - ')


@section('content')

    @include('front.layout.page_header', ['title' => 'Cart'])

    <!-- Cart Page Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="table-responsive">
                @if ($cart->count() > 0)
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Products</th>
                                <th scope="col">Name</th>
                                <th scope="col">Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Total</th>
                                <th scope="col">Handle</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cart as $item)
                                <tr>
                                    <th scope="row">
                                        <div class="d-flex align-items-center">
                                            <img src="{{ $item->options->image }}" class="img-fluid me-5 rounded-circle"
                                                style="width: 80px; height: 80px;" alt="">
                                        </div>
                                    </th>
                                    <td>
                                        <p class="mb-0 mt-4">
                                            {{ $item->name }}{{ $item->options->variation ? '[' . $item->options->variation . ']' : '' }}
                                        </p>
                                    </td>
                                    <td>
                                        <p class="mb-0 mt-4">&#2547;<span class="currentCost">{{ $item->price }}</span></p>
                                    </td>
                                    <td>
                                        <div class="input-group quantity mt-4" style="width: 100px;">
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm sub_qty btn-minus rounded-circle bg-light border"
                                                    data-rowid="{{ $item->rowId }}">
                                                    <i class="fa fa-minus"></i>
                                                </button>
                                            </div>
                                            <input type="text"
                                                class="qty form-control form-control-sm text-center border-0"
                                                value="{{ $item->qty }}">
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm add_qty btn-plus rounded-circle bg-light border"
                                                    data-rowid="{{ $item->rowId }}">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="mb-0 mt-4">&#2547;<span
                                                class="totalCost">{{ $item->price * $item->qty }}</span>
                                        </p>
                                    </td>
                                    <td>
                                        <a href="{{ route('cart.remove_from_cart', $item->rowId) }}"
                                            class="btn btn-md rounded-circle bg-light border mt-4">
                                            <i class="fa fa-times text-danger"></i>
                                        </a>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-center h5">No items in your cart. <a href="#">Go back to shop</a></p>
                @endif
            </div>
            @if ($cart->count() > 0)
                <div class="row g-4 justify-content-end">
                    <div class="col-8"></div>
                    <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                        <div class="bg-light rounded">
                            <div class="p-4">
                                <h1 class="display-6 mb-4">Cart <span class="fw-normal">Total</span></h1>
                                <div class="d-flex justify-content-between mb-4">
                                    <h5 class="mb-0 me-4">Subtotal:</h5>
                                    <p class="mb-0">&#2547;<span class="subTotal">{{ Cart::subtotal() }}</span></p>
                                </div>
                            </div>
                            <a href="{{ route('cart.checkout') }}"
                                class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4"
                                type="button">Proceed Checkout</a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <!-- Cart Page End -->

@endsection

@section('customScript')
    @csrf
    <script>
        $(document).ready(function() {

            let csrf = $('input[name=_token]').val();

            $('.add_qty').click(function() {
                const button = $(this); // clicked + button

                const formData = {
                    _token: csrf,
                    rowId: button.data('rowid'),
                };

                $.ajax({
                    url: "{{ route('cart.add_qty') }}",
                    type: 'POST',
                    data: JSON.stringify(formData),
                    contentType: 'application/json; charset=utf-8',
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': csrf
                    },
                    success: function(response) {
                        const row = button.closest('tr');
                        row.find('.totalCost').text(response.totalCost);
                        row.find('input.qty').val(response
                            .qty);
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr, status, error);
                    }
                });
            });

            $('.sub_qty').click(function() {
                const button = $(this); // clicked - button

                const formData = {
                    _token: csrf,
                    rowId: button.data('rowid'),
                };

                $.ajax({
                    url: "{{ route('cart.sub_qty') }}",
                    type: 'POST',
                    data: JSON.stringify(formData),
                    contentType: 'application/json; charset=utf-8',
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': csrf
                    },
                    success: function(response) {
                        const row = button.closest('tr');
                        row.find('.totalCost').text(response.totalCost);
                        row.find('input.qty').val(response
                            .qty);
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr, status, error);
                    }
                });
            });
        });
    </script>

@endsection
