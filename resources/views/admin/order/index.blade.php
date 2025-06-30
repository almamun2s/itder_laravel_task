@extends('admin.layout.main')

@section('title', 'Orders')

@section('main_content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title mb-5">All Orders</h4>
                    <table id="datatable" class="table table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th>Name</th>
                                <th>Mobile</th>
                                <th>Amount</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($orders as $key => $order)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $order->name }}</td>
                                    <td>{{ $order->mobile }}</td>
                                    <td>{{ $order->total_amount }}&#2547;</td>
                                    <td>{{ $order->created_at->diffForHumans() }}</td>
                                    <td>
                                        @if ($order->status == App\Enum\OrderStatus::PENDING->value)
                                            <span class="btn btn-warning">Pending</span>
                                        @elseif($order->status == App\Enum\OrderStatus::PROCESSING->value)
                                            <span class="btn btn-info">Processing</span>
                                        @elseif($order->status == App\Enum\OrderStatus::COMPLETED->value)
                                            <span class="btn btn-success">Completed</span>
                                        @elseif($order->status == App\Enum\OrderStatus::CANCELLED->value)
                                            <span class="btn btn-danger">Cancelled</span>
                                        @endif
                                    </td>
                                    <td><a href="{{ route('admin.order.show', $order->id) }}">View</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

@endsection
