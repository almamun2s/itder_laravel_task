<!-- Fruits Shop Start-->
<div class="container-fluid fruite py-5">
    <div class="container py-5">
        <div class="tab-class text-center">
            <div class="row g-4 mt-5">
                <div class="col-lg-4 text-start">
                    <h1>Our Organic Products</h1>
                </div>
                <div class="col-lg-8 text-end">
                    <ul class="nav nav-pills d-inline-flex text-center mb-5">
                        <li class="nav-item">
                            <a class="d-flex m-2 py-2 bg-light rounded-pill active" data-bs-toggle="pill"
                                href="#all-products">
                                <span class="text-dark" style="width: 130px;">All Products</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="tab-content">

                <div id="all-products" class="tab-pane fade show p-0 active">
                    <div class="row g-4">
                        <div class="col-lg-12">
                            <div class="row g-4">
                                @php
                                    $products = App\Models\Product::latest()->limit(8)->get();
                                @endphp
                                @foreach ($products as $product)
                                    <div class="col-md-6 col-lg-4 col-xl-3">
                                        <div class="rounded position-relative fruite-item">
                                            <a href="#" style="display: inline-block;">
                                                <div class="fruite-img">
                                                    {{-- <img src="{{ $product->getImg() }}"
                                                        class="img-fluid w-100 rounded-top" alt=""> --}}
                                                </div>
                                                <div class="text-white bg-secondary px-3 py-1 rounded position-absolute"
                                                    style="top: 10px; left: 10px;">
                                                    <a href="#" style="color: #ffffff">
                                                        {{ $product->category->name }}
                                                    </a>
                                                </div>
                                                <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                    <h4>{{ $product->name }}</h4>
                                                    <div class="d-flex justify-content-between flex-lg-wrap">
                                                        <p class="text-dark fs-5 fw-bold mb-0">
                                                            {{ $product->discount_price ? $product->discount_price : $product->price }}&#2547;
                                                        </p>
                                                        <a href="#"
                                                            class="btn border border-secondary rounded-pill px-3 text-primary"><i
                                                                class="fa fa-shopping-bag me-2 text-primary"></i>
                                                            Add to
                                                            cart</a>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                @foreach ($categories as $category)
                    <div id="{{ $category->slug }}" class="tab-pane fade show p-0">
                        <div class="row g-4">
                            <div class="col-lg-12">
                                <div class="row g-4">

                                    @foreach ($category->products as $key => $product)
                                        @if ($key < 8)
                                            <div class="col-md-6 col-lg-4 col-xl-3">
                                                <div class="rounded position-relative fruite-item">
                                                    <a href="#" style="display: inline-block;">
                                                        <div class="fruite-img">
                                                            {{-- <img src="{{ $product->getImg() }}"
                                                                class="img-fluid w-100 rounded-top" alt=""> --}}
                                                        </div>
                                                        <div class="text-white bg-secondary px-3 py-1 rounded position-absolute"
                                                            style="top: 10px; left: 10px;"> <a href="#"
                                                                style="color: #ffffff">
                                                                {{ $product->category->name }}
                                                            </a>
                                                        </div>
                                                        <div
                                                            class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                            <h4>{{ $product->name }}</h4>
                                                            <div class="d-flex justify-content-between flex-lg-wrap">
                                                                <p class="text-dark fs-5 fw-bold mb-0">
                                                                    &#2547;{{ $product->discount_price ? $product->discount_price : $product->price }}
                                                                </p>

                                                                <a href="#"
                                                                    class="btn border border-secondary rounded-pill px-3 text-primary"><i
                                                                        class="fa fa-shopping-bag me-2 text-primary"></i>
                                                                    Add to
                                                                    cart</a>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<!-- Fruits Shop End-->
