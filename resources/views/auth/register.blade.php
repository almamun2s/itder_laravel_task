@extends('front.layout.main')

@section('title', 'Register - ')


@section('content')

    @include('front.layout.page_header', ['title' => 'Register'])

    <!-- Register Start -->
    <div class="container-fluid contact py-5">
        <div class="container py-5">
            <div class="p-5 bg-light rounded">
                <div class="row g-4">
                    <div class="col-lg-3"></div>
                    <div class="col-lg-6">
                        <form action="{{ route('register') }}" class="" method="post">
                            @csrf
                            <input type="text" name="name" class="w-100 form-control border-0 py-3 mb-4"
                                placeholder="Enter your name" autocomplete="off" value="{{ old('name') }}">
                            @error('name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror

                            <input type="email" name="email" class="w-100 form-control border-0 py-3 mb-4"
                                placeholder="Enter Your Email" value="{{ old('email') }}">
                            @error('email')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror

                            <input type="password" name="password" class="w-100 form-control border-0 py-3 mb-4"
                                placeholder="Type your password">
                            @error('password')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror

                            <input type="password" name="password_confirmation"
                                class="w-100 form-control border-0 py-3 mb-4" placeholder="Retype your password">

                            <input type="submit" value="Register"
                                class="w-100 btn form-control border-secondary py-3 bg-white text-primary mb-4">
                        </form>
                        <p>Already have an account? <a href="{{ route('login') }}">Login</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Register End -->
@endsection
