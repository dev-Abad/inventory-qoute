@extends('layouts.app')

@section('content')
    <h1>Add New Product</h1>

    <form action="{{ route('inventory.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Product Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <div class="mb-3">
            <label for="type" class="form-label">Type</label>
            <select name="type" id="type" class="form-select">
                <option value="">Select Type</option>
                <option value="Processor">Processor</option>
                <option value="Motherboard">Motherboard</option>
                <option value="RAM">RAM</option>
                <option value="SSD">SSD</option>
                <option value="HDD">HDD</option>
                <option value="GPU">GPU</option>
                <option value="AIO">AIO</option>
                <option value="FAN">FAN</option>
                <option value="CASING">CASING</option>
                <option value="MONITOR">MONITOR</option>
                <option value="KB/Mouse">KB/Mouse</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" step="0.01" class="form-control" id="price" name="price" required>
        </div>

        <button type="submit" class="btn btn-primary">Add Product</button>
        <a href="{{ route('inventory.index') }}" class="btn btn-secondary">Back to Inventory</a>
    </form>
@endsection
