@props(['field'])

@php
    $currentSort = request('sort', 'name');
    $currentDir  = request('direction', 'asc');
    $isActive    = $currentSort === $field;
    $nextDir     = ($isActive && $currentDir === 'asc') ? 'desc' : 'asc';
    $url         = route('products.index', ['sort' => $field, 'direction' => $nextDir]);
@endphp

<a href="{{ $url }}" class="d-flex align-items-center text-reset text-decoration-none">
    <span>{{ $slot }}</span>
    <i class="fas ml-1
        @if ($isActive)
            {{ $currentDir === 'asc' ? 'fa-sort-up' : 'fa-sort-down' }}
        @else
            fa-sort
        @endif"
        style="{{ $isActive ? '' : 'opacity:.35' }}"></i>
</a>
