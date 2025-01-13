<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index(Request $request)
    {
        // Initialize the query
        $query = Product::query();

        // Check if there is a 'search' query parameter and filter accordingly
        if ($request->has('search') && $request->get('search') !== '') {
            $search = $request->get('search');
            // Filter by name or type
            $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('type', 'like', '%' . $search . '%');
        }

        // Get the products (either filtered or all)
        $products = $query->get();

        return view('inventory.index', compact('products'));
    }
    
    public function create()
    {
        return view('inventory.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'type' => 'required|string|max:255',
        ]);

        Product::create($request->all());

        return redirect()->route('inventory.index');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);  // Get the product to be edited
        return view('inventory.edit', compact('product'));  // Return to the edit view
    }

    // Handle the form submission for updating the product
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'type' => 'required|string|max:255', // Add validation for 'type'
        ]);

        $product->update($validated);

        return redirect()->route('inventory.index')->with('success', 'Product updated successfully!');
    }


    public function destroy(Product $product)
    {
        // Delete the product from the database
        $product->delete();
    
        // Redirect to the inventory index after deletion
        return redirect()->route('inventory.index')->with('success', 'Product deleted successfully!');
    }
}

