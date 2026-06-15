@extends('layouts.app')

@section('title', __('Categories'))

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ __('Category List') }}</h3>
        </div>
        <div class="card-body p-0">
            <table class="table table-bordered table-striped table-hover mb-0">
                <thead>
                    <tr>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Slug') }}</th>
                        <th class="text-right">{{ __('Product count') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $category)
                        <tr>
                            <td>{{ $category->name }}</td>
                            <td><code>{{ $category->slug }}</code></td>
                            <td class="text-right">{{ $category->products_count }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted">{{ __('No categories found.') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
