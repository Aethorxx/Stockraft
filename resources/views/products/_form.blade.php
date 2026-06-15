<div class="form-group">
    <label for="name">{{ __('Name') }}</label>
    <input type="text" id="name" name="name"
           class="form-control @error('name') is-invalid @enderror"
           value="{{ old('name', $product->name ?? '') }}" required>
    @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="category_id">{{ __('Category') }}</label>
    <select id="category_id" name="category_id"
            class="form-control @error('category_id') is-invalid @enderror" required>
        <option value="">{{ __('Select category') }}</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}"
                {{ old('category_id', $product->category_id ?? '') == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
    @error('category_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="description">{{ __('Description') }}</label>
    <textarea id="description" name="description" rows="3"
              class="form-control @error('description') is-invalid @enderror">{{ old('description', $product->description ?? '') }}</textarea>
    @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="price">{{ __('Price (₽)') }}</label>
            <input type="number" id="price" name="price" step="0.01" min="0"
                   class="form-control @error('price') is-invalid @enderror"
                   value="{{ old('price', $product->price ?? '') }}" required>
            @error('price')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="stock">{{ __('Stock') }}</label>
            <input type="number" id="stock" name="stock" min="0"
                   class="form-control @error('stock') is-invalid @enderror"
                   value="{{ old('stock', $product->stock ?? 0) }}" required>
            @error('stock')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

<div class="form-group">
    <div class="custom-control custom-checkbox">
        <input type="hidden" name="is_active" value="0">
        <input type="checkbox" id="is_active" name="is_active" value="1"
               class="custom-control-input"
               {{ old('is_active', $product->is_active ?? true) ? 'checked' : '' }}>
        <label for="is_active" class="custom-control-label">{{ __('Active') }}</label>
    </div>
</div>
