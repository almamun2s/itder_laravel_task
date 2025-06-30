@extends('admin.layout.main')

@section('title', 'Create Product')

@section('main_content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-5">Create Product</h4>

                    <form action="{{ route('admin.product.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-2">
                                <label>Product Name</label>
                            </div>
                            <div class="col-md-4">
                                <input type="text" name="name" class="form-control" autocomplete="off"
                                    value="{{ old('name') }}">
                                @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-2">
                                <label>Category</label>
                            </div>
                            <div class="col-md-4">
                                <select name="category" class="form-control">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-2">
                                <label>Regular Price</label>
                            </div>
                            <div class="col-md-4">
                                <input type="number" step="0.01" min="0" name="price" class="form-control">
                                @error('price')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-2">
                                <label>Discount Price</label>
                            </div>
                            <div class="col-md-4">
                                <input type="number" step="0.01" min="0" name="disc_price" class="form-control">
                                @error('disc_price')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-2">
                                <label>Description</label>
                            </div>
                            <div class="col-md-4">
                                <textarea name="description" class="form-control"></textarea>
                                @error('description')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-2"></div>
                            <div class="col-md-4">
                                <input type="submit" value="Create Product" class="btn btn-primary">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
