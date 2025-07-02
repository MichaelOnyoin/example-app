<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // Ensure you import the Product model

class ProductController extends Controller
{
    //
    public function index()
    {
        // Fetch products from the database or any other source
        $products = \App\Models\Product::all();
        //code using to fetch products from the sqlite database
        

        // Return the products as a JSON response
        return response()->json($products);
    }
    public function show($id)
    {
        // Fetch a single product by ID
       // $product = \DB::table('products')->where('id', $id)->first();
        // Alternatively, you can use Eloquent like this:
         $product = \App\Models\Product::find($id);

        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        // Return the product as a JSON response
        return response()->json($product);
    }
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            // 'price' => 'required|decimal:2',
            'price' => 'required|numeric',
            'originalPrice' => 'nullable|numeric',
            'discount' => 'nullable|numeric',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'imageUrl' => 'required|string|max:255',
            'brand' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:255',
            'type' => 'nullable|string|max:255',
            'deals' => 'nullable|string|max:255',
            // Add other fields as necessary
        ]);

        // Create a new product
        $product = Product::create($validatedData);


        // Return the created product as a JSON response
        return response()->json($product, 201);
    }

     public function batch(Request $request)
     {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'products' => 'required|array',
            'products.*.price' => 'required|numeric',
            'products.*.originalPrice' => 'nullable|numeric',
            'products.*.discount' => 'nullable|numeric',
            'products.*.title' => 'required|string|max:255',
            'products.*.description' => 'required|string',
            'products.*.imageUrl' => 'required|string|max:255',
            'products.*.brand' => 'nullable|string|max:255',
            'products.*.category' => 'nullable|string|max:255',
            'products.*.type' => 'nullable|string|max:255',
            'products.*.deals' => 'nullable|string|max:255',
        ]);

        // Create products in batch
        $products = Product::insert($validatedData['products']);

        // Return the created products as a JSON response
        return response()->json($products, 201);
     }

    public function update(Request $request, $id)
    {
        // Find the product by ID
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        // Validate the incoming request data
        $validatedData = $request->validate([
            'price' => 'required|numeric',
            'originalPrice' => 'nullable|numeric',
            'discount' => 'nullable|numeric',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'imageUrl' => 'required|string|max:255',
            'brand' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:255',
            'type' => 'nullable|string|max:255',
            'deals' => 'nullable|string|max:255',
            // Add other fields as necessary
        ]);

        // Update the product
        $product->update($validatedData);

        // Return the updated product as a JSON response
        return response()->json($product);
    }
    public function destroy($id)
    {
        // Find the product by ID
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        // Delete the product
        $product->delete();

        // Return a success response
        return response()->json(['message' => 'Product deleted successfully']);
    }

    public function search(Request $request)
    {
        // Validate the search query
        $request->validate([
            'query' => 'required|string|max:255',
        ]);

        // Perform the search
        $query = $request->input('query');
        $products = Product::where('title', 'like', "%{$query}%")
            ->orWhere('description', 'like', "%{$query}%")
            ->get();

        // Return the search results as a JSON response
        return response()->json($products);
    }
}
