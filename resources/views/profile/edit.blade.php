@extends('front.layout.main')

@section('title', 'Profile - ')


@section('content')

    @include('front.layout.page_header', ['title' => 'Profile'])

    <!-- Profile Start -->
    <div class="container-fluid contact py-1">
        <div class="container py-5">
            <div class="p-5 bg-light rounded">
                <div class="row g-4 mb-4">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-2">Neme:</div>
                    <div class="col-lg-6">{{ auth()->user()->name }}</div>
                    <div class="col-lg-2"><a href="{{ route('orders') }}" class="btn btn-primary text-white">Your Orders</a>
                    </div>
                </div>
                <div class="row g-4 mb-4">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-2">Email:</div>
                    <div class="col-lg-6">{{ auth()->user()->email }}</div>
                </div>
                <div class="row g-4 mb-4">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-2">Mobile:</div>
                    <div class="col-lg-6">{{ auth()->user()->mobile }}</div>
                </div>
                <div class="row g-4 mb-4">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-2">Address:</div>
                    <div class="col-lg-6">{{ auth()->user()->address }}</div>
                </div>
                <div class="row g-4 mb-4">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-2">
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <input type="submit" value="Logout" class="btn btn-danger">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Profile End -->

@endsection
