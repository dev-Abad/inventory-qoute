<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class QuotationController extends Controller
{
    public function index()
    {
        // Fetch all products to display in the dropdown
        $products = Product::all();
        return view('quotation.index', compact('products'));
    }

    public function generateQuotation(Request $request)
    {
        $selectedParts = [];

        // Fetch products based on the selected IDs
        foreach ($request->products as $key => $productId) {
            $product = Product::find($productId);
            if ($product) {
                //QTY START AT 1
                $selectedParts[] = [
                    'id' => $product->id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'quantity' => 1, 
                    'total' => $product->price,  
                ];
            }
        }

        // Calculate total price
        $totalPrice = array_sum(array_column($selectedParts, 'total'));

        return view('quotation.generate', compact('selectedParts', 'totalPrice'));
    }

}
