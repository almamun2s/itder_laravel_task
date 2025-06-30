@extends('front.layout.main')

@section('title', 'Login - ')


@section('content')

    @include('front.layout.page_header', ['title' => 'Login'])

    <!-- Login Start -->
    <div class="container-fluid contact py-5">
        <div class="container py-5">
            <div class="p-5 bg-light rounded">
                <div class="row g-4">
                    <div class="col-lg-3"></div>
                    <div class="col-lg-6">
                        <form action="{{ route('login') }}" class="" method="post">
                            @csrf
                            <input type="email" name="email" class="w-100 form-control border-0 py-3 mb-4"
                                placeholder="Enter Your Email">
                            @error('email')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            <input type="password" name="password" class="w-100 form-control border-0 py-3 mb-4">
                            <input type="submit" value="Login"
                                class="w-100 btn form-control border-secondary py-3 bg-white text-primary mb-4">
                        </form>
                        <p><a href="#">Forgot password?</a> or Don't have an account? <a
                                href="{{ route('register') }}">Register</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Login End -->
@endsection