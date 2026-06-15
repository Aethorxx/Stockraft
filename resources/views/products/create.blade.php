@extends('layouts.app')

@section('title', 'Create Product')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="h3 mb-4">Create Product</h1>

            <form action="{{ route('products.store') }}" method="POST">
                @csrf
                @include('products._form')
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Save Product</button>
                    <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection
