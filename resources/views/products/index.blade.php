@extends('layouts.app')

@section('title', __('Products'))

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ __('Product List') }}</h3>
            <div class="card-tools">
                <a href="{{ route('products.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus mr-1"></i> {{ __('Create Product') }}
                </a>
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table table-bordered table-striped table-hover mb-0">
                <thead>
                    <tr>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Category') }}</th>
                        <th class="text-right">{{ __('Price (₽)') }}</th>
                        <th class="text-right">{{ __('Stock') }}</th>
                        <th class="text-center">{{ __('Active') }}</th>
                        <th class="text-center" style="width: 80px;">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->category->name }}</td>
                            <td class="text-right">{{ number_format($product->price, 2) }} ₽</td>
                            <td class="text-right">{{ $product->stock }}</td>
                            <td class="text-center">
                                @if ($product->is_active)
                                    <i class="fas fa-check text-success"></i>
                                @else
                                    <i class="fas fa-times text-secondary"></i>
                                @endif
                            </td>
                            <td class="text-center text-nowrap">
                                <a href="{{ route('products.edit', $product) }}"
                                   class="btn btn-sm btn-warning mr-1"
                                   title="{{ __('Edit Product') }}">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('products.destroy', $product) }}" method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('{{ __('Delete this product?') }}')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="btn btn-sm btn-danger"
                                            title="{{ __('Delete this product?') }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">{{ __('No products found.') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($products->hasPages())
            <div class="card-footer">
                {{ $products->links() }}
            </div>
        @endif
    </div>
@endsection
