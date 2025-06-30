@extends('admin.layout.main')

@section('title', $order->name)

@section('main_content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title mb-5">Order of {{ $order->name }} is
                        @if ($order->status == App\Enum\OrderStatus::PENDING->value)
                            <span class="btn btn-warning btn-sm">Pending</span>
                        @elseif($order->status == App\Enum\OrderStatus::PROCESSING->value)
                            <span class="btn btn-info btn-sm">Processing</span>
                        @elseif($order->status == App\Enum\OrderStatus::COMPLETED->value)
                            <span class="btn btn-success btn-sm">Completed</span>
                        @elseif($order->status == App\Enum\OrderStatus::CANCELLED->value)
                            <span class="btn btn-danger btn-sm">Cancelled</span>
                        @endif

                    </h4>
                    <div class="row">
                        <div class="col-6">
                            <div class="row mb-2">
                                <div class="col-6">Name</div>
                                <div class="col-6">{{ $order->name }}</div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-6">Mobile</div>
                                <div class="col-6">{{ $order->mobile }}</div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-6">Address</div>
                                <div class="col-6">{{ $order->address }}</div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-6">Thana and Districk</div>
                                <div class="col-6">{{ $order->thana }}</div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-6">Order Time</div>
                                <div class="col-6">{{ $order->created_at->format('d-M-Y H:i:sa') }}</div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-6">Change Order Status</div>
                                <div class="col-6">
                                    <form action="{{ route('admin.order.status_update', $order) }}" method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="col-6">
                                                @php
                                                    $orderStatus = App\Enum\OrderStatus::cases();
                                                @endphp
                                                <select name="order_status" class="form-control">
                                                    @foreach ($orderStatus as $status)
                                                        <option value="{{ $status->value }}"
                                                            @if ($order->status == $status->value) selected @endif>
                                                            {{ ucfirst($status->value) }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-6">
                                                <input type="submit" value="Change" class="form-control btn btn-primary">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="row mb-2">
                                <div class="col-6">Order Number</div>
                                <div class="col-6">{{ $order->order_number }}</div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-6">Total Amount</div>
                                <div class="col-6">{{ $order->total_amount }}&#2547;</div>
                            </div>

                            @if ($order->is_paid)
                                <div class="row mb-2">
                                    <div class="col-6">Payment Status</div>
                                    <div class="col-6"><span class="btn btn-success btn-sm">Paid</span></div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-6">Payment Time</div>
                                    <div class="col-6">{{ Carbon\Carbon::now() }}</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-6">Transaction</div>
                                    <div class="col-6">{{ Str::random(10) }}</div>
                                </div>
                            @endif

                        </div>
                    </div>


                    <div class="row mt-5">
                        <div class="col-12">
                            <table class="table table-striped">
                                <thead>
                                    <tr>

                                        <th>SL</th>
                                        <th>Product</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Sub Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i = 0 @endphp
                                    @foreach (json_decode($order->products) as $product)
                                        <tr>
                                            <td>{{ $i += 1 }}</td>
                                            <td><img src="{{ $product->options->image }}" alt="product" width="100px">
                                            </td>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $product->price }}&#2547;</td>
                                            <td>{{ $product->qty }}</td>
                                            <td>{{ $product->subtotal }}&#2547;</td>
                                    @endforeach
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
@endsection
