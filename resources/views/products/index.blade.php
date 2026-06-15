@extends('layouts.app')

@section('title', 'Products')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3">Products</h1>
        <a href="{{ route('products.create') }}" class="btn btn-primary">Create Product</a>
    </div>

    <table class="table table-bordered table-hover align-middle">
        <thead class="table-dark">
            <tr>
                <th>Name</th>
                <th>Category</th>
                <th class="text-end">Price</th>
                <th class="text-end">Stock</th>
                <th class="text-center">Active</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category->name }}</td>
                    <td class="text-end">${{ number_format($product->price, 2) }}</td>
                    <td class="text-end">{{ $product->stock }}</td>
                    <td class="text-center">
                        @if ($product->is_active)
                            <span class="badge bg-success">Yes</span>
                        @else
                            <span class="badge bg-secondary">No</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                        <form action="{{ route('products.destroy', $product) }}" method="POST"
                              class="d-inline"
                              onsubmit="return confirm('Delete this product?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">No products found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $products->links() }}
@endsection
