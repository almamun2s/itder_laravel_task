@extends('front.layout.main')

@section('title', 'Thank you - ')


@section('content')
    @include('front.layout.page_header', ['title' => 'Thank you for Ordering.'])


    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-5">Invoice</div>
                        <div class="col-md-7">{{ $order->order_number }}</div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-5">Total Amount</div>
                        <div class="col-md-7">{{ $order->total_amount }}&#2547;</div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-5">Order Time</div>
                        <div class="col-md-7">{{ $order->created_at->format('d-M-Y h:i:sa') }}</div>
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="row mt-3">
                        <div class="col-md-5">Name</div>
                        <div class="col-md-7">{{ $order->name }}</div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-5">Mobile</div>
                        <div class="col-md-7">{{ $order->mobile }}</div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-5">Address</div>
                        <div class="col-md-7">{{ $order->address }}</div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-5">Order Status</div>
                        <div class="col-md-7">
                            {{ $order->status }}
                        </div>
                    </div>

                    @if ($order->tracking_code != null)
                        <div class="row mt-3">
                            <div class="col-md-5">Track Your Order</div>
                            <div class="col-md-7"><a href="https://steadfast.com.bd/t/{{ $order->tracking_code }}"
                                    target="_blank">{{ $order->tracking_code }}</a></div>
                        </div>
                    @endif

                </div>
            </div>


            <div class="table-responsive mt-5">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Products</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (json_decode($order->products) as $item)
                            <tr>
                                <td><img src="{{ $item->options->image }}" alt="product" width="100px"></td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->price }}&#2547;</td>
                                <td>{{ $item->qty }}</td>
                                <td>{{ $item->subtotal }}&#2547;</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
