@extends('front.layout.main')

@section('title', 'Orders - ')


@section('content')

    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5"
        style="background:linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url({{ asset('uploads/img/page_header.jpg') }});">
        <h1 class="text-center text-white display-6">Your Orders</h1>
    </div>
    <!-- Single Page Header End -->


    <!-- Order Page Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="table-responsive">
                @if ($orders->count() > 0)
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Invoice</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>
                                        <a
                                            href="{{ route('order_details', $order->order_number) }}">{{ $order->order_number }}</a>
                                    </td>
                                    <td>
                                        <p class="mb-0 mt-4">{{ $order->total_amount }}&#2547;</span></p>
                                    </td>
                                    <td>
                                        @if ($order->status == App\Enum\OrderStatus::PENDING->value)
                                            <a href="{{ route('order_details', $order->order_number) }}"
                                                class="btn btn-warning">Pending</a>
                                        @elseif($order->status == App\Enum\OrderStatus::PROCESSING->value)
                                            <a href="{{ route('order_details', $order->order_number) }}"
                                                class="btn btn-info">Processing</a>
                                        @elseif($order->status == App\Enum\OrderStatus::COMPLETED->value)
                                            <a href="{{ route('order_details', $order->order_number) }}"
                                                class="btn btn-success">Completed</a>
                                        @elseif($order->status == App\Enum\OrderStatus::CANCELLED->value)
                                            <a href="{{ route('order_details', $order->order_number) }}"
                                                class="btn btn-danger">Cancelled</a>
                                        @endif
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-center h5">No items in your Order. <a href="#">Go back to shop</a></p>
                @endif
            </div>
        </div>
    </div>
    <!-- Order Page End -->

@endsection
