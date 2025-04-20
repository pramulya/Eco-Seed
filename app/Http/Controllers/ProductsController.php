<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the eco-friendly products.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Fetch all products from the database
        $products = Product::all();

        // Return the marketplace view with the products
        return view('marketplace.index', compact('products'));
    }

    /**
     * Display the specified product details.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Fetch the product by its ID
        $product = Product::findOrFail($id);

        // Return the product details view
        return view('marketplace.show', compact('product'));
    }

    /**
     * Store a newly created product in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the incoming data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
        ]);

        // Create a new product record in the database
        Product::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'price' => $validated['price'],
        ]);

        // Redirect back with a success message
        return redirect()->route('marketplace.index')->with('success', 'Product added successfully!');
    }

    /**
     * Show the form for editing the specified product.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Fetch the product by its ID
        $product = Product::findOrFail($id);

        // Return the edit view with the product data
        return view('marketplace.edit', compact('product'));
    }

    /**
     * Update the specified product in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validate the incoming data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
        ]);

        // Find the existing product
        $product = Product::findOrFail($id);

        // Update product details
        $product->update([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'price' => $validated['price'],
        ]);

        // Redirect back with a success message
        return redirect()->route('marketplace.index')->with('success', 'Product updated successfully!');
    }

    /**
     * Remove the specified product from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Find the product by its ID
        $product = Product::findOrFail($id);

        // Delete the product from the database
        $product->delete();

        // Redirect back with a success message
        return redirect()->route('marketplace.index')->with('success', 'Product deleted successfully!');
    }
}
