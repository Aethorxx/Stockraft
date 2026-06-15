@extends('layouts.app')

@section('title', 'Categories')

@section('content')
    <h1 class="h3 mb-4">Categories</h1>

    <table class="table table-bordered table-hover align-middle">
        <thead class="table-dark">
            <tr>
                <th>Name</th>
                <th>Slug</th>
                <th class="text-end">Products</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($categories as $category)
                <tr>
                    <td>{{ $category->name }}</td>
                    <td><code>{{ $category->slug }}</code></td>
                    <td class="text-end">{{ $category->products_count }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center text-muted">No categories found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
