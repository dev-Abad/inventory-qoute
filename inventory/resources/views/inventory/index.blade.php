@extends('layouts.app')

@section('content')
    <h1>Inventory</h1>
    <a href="{{ route('inventory.create') }}" class="btn btn-primary mb-3">Add Product</a>

    <!-- Search Bar aligned to the top-right of the table -->
    <div class="mb-3" style="display: flex; justify-content: flex-end;">
        <form method="GET" action="{{ route('inventory.index') }}" class="d-flex w-auto">
            <input type="text" name="search" class="form-control" placeholder="Search by name or type" value="{{ request('search') }}">
            <button class="btn btn-primary" type="submit">Search</button>
        </form>
    </div>

    <!-- Product Table -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Type</th> <!-- Added Type column -->
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->type }}</td> <!-- Display the type -->
                    <td>{{ $product->price }}</td>
                    <td>
                        <a href="{{ route('inventory.edit', $product) }}" class="btn btn-warning btn-sm">Edit</a>

                        <!-- Form for deleting the product -->
                        <form action="{{ route('inventory.destroy', $product) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE') <!-- This line tells Laravel to treat the form as a DELETE request -->
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
