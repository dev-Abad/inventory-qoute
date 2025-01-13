@extends('layouts.app')

@section('content')
    <h1>Edit Product</h1>

    <!-- Form to edit the product details -->
    <form action="{{ route('inventory.update', $product->id) }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Product Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $product->name) }}" required>
        </div>

        <div class="mb-3">
            <label for="type" class="form-label">Type</label>
            <select name="type" id="type" class="form-select">
                <option value="">Select Type</option>
                <option value="Processor" {{ $product->type == 'Processor' ? 'selected' : '' }}>Processor</option>
                <option value="Motherboard" {{ $product->type == 'Motherboard' ? 'selected' : '' }}>Motherboard</option>
                <option value="RAM" {{ $product->type == 'RAM' ? 'selected' : '' }}>RAM</option>
                <option value="SSD" {{ $product->type == 'SSD' ? 'selected' : '' }}>SSD</option>
                <option value="HDD" {{ $product->type == 'HDD' ? 'selected' : '' }}>HDD</option>
                <option value="GPU" {{ $product->type == 'GPU' ? 'selected' : '' }}>GPU</option>
                <option value="AIO" {{ $product->type == 'AIO' ? 'selected' : '' }}>AIO</option>
                <option value="FAN" {{ $product->type == 'FAN' ? 'selected' : '' }}>FAN</option>
                <option value="CASING" {{ $product->type == 'CASING' ? 'selected' : '' }}>CASING</option>
                <option value="MONITOR" {{ $product->type == 'MONITOR' ? 'selected' : '' }}>MONITOR</option>
                <option value="KB/Mouse" {{ $product->type == 'KB/Mouse' ? 'selected' : '' }}>KB/Mouse</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Product Price (PHP)</label>
            <input type="number" class="form-control" id="price" name="price" value="{{ old('price', $product->price) }}" required step="0.01">
        </div>

        <button type="submit" class="btn btn-primary">Update Product</button>
    </form>

    <a href="{{ route('inventory.index') }}" class="btn btn-secondary">Back to Inventory</a>
@endsection
