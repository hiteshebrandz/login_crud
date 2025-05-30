<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    /**
     * Display all products on the dashboard.
     */
    public function index()
    {
        if (auth()->user()->role === 'admin') {
            $products = Product::with('user')->get();
        } else {
            $products = Product::where('user_id', auth()->id())->get();
        }

        return view('dashboard', compact('products'));
    }

    public function create()
    {
        return view('create');
    }

    /**
     * Store a new product in the database.
     */
   public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'price' => 'required|numeric',
        'quantity' => 'required|integer',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        'video' => 'nullable|mimetypes:video/mp4,video/x-msvideo,video/quicktime',
        'pdf' => 'nullable|mimes:pdf',
    ]);

    $data = $request->only(['name', 'price', 'quantity']);
    $data['user_id'] = auth()->id();

    if ($request->hasFile('image')) {
        $data['image_path'] = $request->file('image')->store('images', 'public');
    }

    if ($request->hasFile('video')) {
        $data['video_path'] = $request->file('video')->store('videos', 'public');
    }

    if ($request->hasFile('pdf')) {
        $data['pdf_path'] = $request->file('pdf')->store('pdfs', 'public');
    }

    try {
        Product::create($data);
    } catch (\Exception $e) {
        dd('Database Insert Error: ' . $e->getMessage());
    }

    return redirect()->route('dashboard')->with('success', 'Product added successfully!');
}



    /**
     * Update an existing product.
     */
    private function authorizeUser(Product $product)
    {
        if (auth()->user()->role !== 'admin' && $product->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }
    }

    public function edit(Product $product)
    {
        $this->authorizeUser($product);
        return view('edit', compact('product'));
    }



public function update(Request $request, Product $product)
{
    $this->authorizeUser($product);

    $request->validate([
        'name' => 'required',
        'price' => 'required|numeric',
        'quantity' => 'required|integer',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        'video' => 'nullable|mimetypes:video/mp4,video/x-msvideo,video/quicktime',
        'pdf'   => 'nullable|mimes:pdf',
    ]);

    $data = $request->only(['name', 'price', 'quantity']);

    // Handle image upload
    if ($request->hasFile('image')) {
        $data['image_path'] = $request->file('image')->store('images', 'public');
    }

    // Handle video upload
    if ($request->hasFile('video')) {
        $data['video_path'] = $request->file('video')->store('videos', 'public');
    }

    // Handle pdf upload
    if ($request->hasFile('pdf')) {
        $data['pdf_path'] = $request->file('pdf')->store('pdfs', 'public');
    }

    $product->update($data);

    return redirect()->route('dashboard')->with('success', 'Product updated successfully!');
}

    public function destroy(Product $product)
    {
        $this->authorizeUser($product);

        $product->delete();

        return redirect()->route('dashboard')->with('success', 'Product deleted successfully!');
    }



    /**
     * Delete a product.
     */
}
