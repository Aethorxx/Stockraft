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
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover mb-0">
                    <thead>
                        <tr>
                            <th><x-sort-header field="name">{{ __('Name') }}</x-sort-header></th>
                            <th style="width:140px"><x-sort-header field="category">{{ __('Category') }}</x-sort-header></th>
                            <th class="text-right text-nowrap" style="width:115px"><x-sort-header field="price">{{ __('Price (₽)') }}</x-sort-header></th>
                            <th class="text-right" style="width:85px"><x-sort-header field="stock">{{ __('Stock') }}</x-sort-header></th>
                            <th class="text-center" style="width:70px"><x-sort-header field="is_active">{{ __('Active') }}</x-sort-header></th>
                            <th class="text-center" style="width:90px">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            <tr>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->category->name }}</td>
                                <td class="text-right text-nowrap">{{ number_format($product->price, 2) }} ₽</td>
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
                                       class="btn btn-sm btn-outline-primary mr-1"
                                       title="{{ __('Edit Product') }}">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('products.destroy', $product) }}" method="POST"
                                          class="d-inline"
                                          onsubmit="return confirm('{{ __('Delete this product?') }}')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="btn btn-sm btn-outline-danger"
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
        </div>
        @if ($products->hasPages())
            <div class="card-footer">
                {{ $products->links() }}
            </div>
        @endif
    </div>
@endsection
