<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required', // Allow any for mock items if they don't exist in DB
            'name' => 'nullable|string',
            'price' => 'nullable|numeric',
            'quantity' => 'integer|min:1'
        ]);

        $productId = $validated['product_id'];
        $quantity = $request->input('quantity', 1);

        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            // Check if product exists in DB, otherwise use mock details
            $product = Product::find($productId);
            if ($product) {
                $cart[$productId] = [
                    'id' => $product->id,
                    'name' => $product->name,
                    'quantity' => $quantity,
                    'price' => $product->price,
                    'image_url' => $product->image_url,
                ];
            } else {
                // Mock product from frontend
                $cart[$productId] = [
                    'id' => $productId,
                    'name' => $request->input('name', 'Mock Product'),
                    'quantity' => $quantity,
                    'price' => $request->input('price', 0),
                    'image_url' => $request->input('image_url', ''),
                ];
            }
        }

        session()->put('cart', $cart);
        
        $totalItems = collect($cart)->sum('quantity');

        return response()->json([
            'success' => true,
            'message' => 'Product added to cart successfully!',
            'cart_count' => $totalItems
        ]);
    }
    
    public function getCount()
    {
        $cart = session()->get('cart', []);
        $totalItems = collect($cart)->sum('quantity');
        return response()->json([
            'cart_count' => $totalItems
        ]);
    }

    public function index()
    {
        $cart = session()->get('cart', []);
        
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        // For mock, calculate some dummy values if you'd like
        $shipping = count($cart) > 0 ? 500 : 0; 
        $discount = 0; 
        $total = $subtotal + $shipping - $discount;

        return view('cart', compact('cart', 'subtotal', 'shipping', 'discount', 'total'));
    }
}
