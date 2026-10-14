<div class="form-field">
    <label for="name">Name <span class="required-indicator">(required)</span></label>
    <input id="name" name="name" type="text" value="{{ old('name', $item->name ?? '') }}" maxlength="255" required>
</div>

<div class="form-field">
    <label for="description">Description <span class="optional-indicator">(optional)</span></label>
    <textarea id="description" name="description" rows="4">{{ old('description', $item->description ?? '') }}</textarea>
</div>

<div class="form-grid">
    <div class="form-field">
        <label for="quantity">Quantity</label>
        <input id="quantity" name="quantity" type="number" min="0" step="1" value="{{ old('quantity', $item->quantity ?? 0) }}" required>
    </div>

    <div class="form-field">
        <label for="price">Price</label>
        <input id="price" name="price" type="number" min="0" max="99999999.99" step="0.01" value="{{ old('price', $item->price ?? '0.00') }}" required>
    </div>
</div>

<div class="form-actions">
    <button class="button button-primary" type="submit">{{ $submitLabel }}</button>
    <a class="button button-secondary" href="{{ route('items.index') }}">Cancel</a>
</div>
