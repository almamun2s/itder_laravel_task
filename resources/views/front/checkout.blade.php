@extends('front.layout.main')

@section('title', 'Checkout - ')


@section('content')

    @include('front.layout.page_header', ['title' => 'Checkout'])

    <!-- Checkout Page Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <h1 class="mb-4">Billing details</h1>
            <form action="{{ route('create_order') }}" method="post">
                @csrf
                <div class="row g-5">
                    <div class="col-md-12 col-lg-6 col-xl-7">
                        <div class="form-item">
                            <label class="form-label my-3">Name (পুরো নাম) <sup>*</sup></label>
                            <input type="text" name="name" class="form-control"
                                placeholder="Type your Name (আপনার পুরো নাম লিখুন)"
                                value="@if (old('name')) {{ old('name') }}@elseif(auth()->user()){{ auth()->user()->name }} @endif">
                            @error('name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Mobile (মোবাইল নাম্বার) <sup>*</sup></label>
                            <input type="tel" name="mobile" class="form-control"
                                placeholder="Type your Mobile (মোবাইল নাম্বার লিখুন)"
                                value="@if (old('mobile')) {{ old('mobile') }}@elseif(auth()->user()){{ auth()->user()->mobile }} @endif">
                            @error('mobile')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Address (ঠিকানা) <sup>*</sup></label>
                            <input type="text" name="address" class="form-control"
                                placeholder="Type your Address (আপনার ঠিকানা লিখুন)"
                                value="@if (old('address')) {{ old('address') }}@elseif(auth()->user()){{ auth()->user()->address }} @endif">
                            @error('address')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12 col-lg-6 col-xl-5">
                        <div class="table-responsive">
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

                                    @foreach ($cart as $item)
                                        <tr>
                                            <th scope="row">
                                                <div class="d-flex align-items-center mt-2">
                                                    <img src="{{ $item->options->image }}" class="img-fluid rounded-circle"
                                                        style="width: 90px; height: 90px;" alt="">
                                                </div>
                                            </th>
                                            <td class="py-5">
                                                {{ $item->name }}{{ $item->options->variation ? '[' . $item->options->variation . ']' : '' }}
                                            </td>
                                            <td class="py-5">&#2547;{{ $item->price }}</td>
                                            <td class="py-5">{{ $item->qty }}</td>
                                            <td class="py-5">&#2547;{{ $item->price * $item->qty }}</td>
                                        </tr>
                                    @endforeach




                                </tbody>
                            </table>
                        </div>


                        <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-3">
                            <div class="col-12">
                                <div class="form-check text-start my-3">
                                    <h5>Sub Total: &#2547; <span>{{ Cart::subtotal() }}</span></h5>
                                    <h5>Delivery Charge: &#2547;<span>100</span></h5>
                                </div>
                            </div>
                        </div>

                        <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-3">
                            <div class="col-12">
                                <div class="form-check text-start my-3">
                                    <h4>Total: &#2547;<span>{{ $totalAmount }}</span></h4>
                                </div>
                            </div>
                        </div>


                        <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-3">
                            <div class="col-12">
                                <div class="form-check text-start my-3">
                                    <input type="radio" class="form-check-input bg-primary border-0" checked
                                        id="cod" name="payment_method" value="">
                                    <label class="form-check-label" style="cursor: pointer;" for="cod">Cash On
                                        Delivery</label>
                                </div>
                                {{-- Another Payment method will be included here --}}
                                {{-- <div class="form-check text-start my-3">
                                    <input type="radio" class="form-check-input bg-primary border-0" id="bkash"
                                        name="payment_method" value="{{ App\Enum\PaymentMethod::BKASH }}">
                                    <label class="form-check-label" style="cursor: pointer;" for="bkash">Pay with
                                        Bkash</label>
                                </div> --}}
                            </div>
                        </div>

                        <div class="row g-4 text-center align-items-center justify-content-center pt-4">
                            <input type="submit" class="btn border-secondary py-3 px-4 text-uppercase w-100 text-primary"
                                value="Place Order">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Checkout Page End -->
@endsection
