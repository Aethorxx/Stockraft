@extends('layouts.app')

@section('title', 'Edit Product')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="h3 mb-4">Edit Product</h1>

            <form action="{{ route('products.update', $product) }}" method="POST">
                @csrf
                @method('PUT')
                @include('products._form')
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Update Product</button>
                    <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection
