<?php

namespace App\Http\Controllers;

use Yajra\DataTables\DataTables;
use App\Models\Product;
use Illuminate\Container\Attributes\Log;
use Illuminate\Http\Request;

use function Illuminate\Log\log;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Product::select('*');
    
            return DataTables::of($data)
                ->addColumn('actions', function ($product) {
                    return '<a href="'.route('products.show', encrypt($product->id)).'" class="btn btn-sm btn-info">View</a>
                            <a href="'.route('products.edit', encrypt($product->id)).'" class="btn btn-sm btn-primary">Edit</a>
                            <form action="'.route('products.destroy', encrypt($product->id)).'" method="POST" style="display:inline;">
                                ' . csrf_field() . '
                                ' . method_field('DELETE') . '
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm(\'Are you sure you want to delete this product?\')">Delete</button>
                            </form>';
                })
                ->rawColumns(['actions']) // Render HTML in the 'actions' column
                ->make(true);
        }
        return view('products.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'price' => 'required|numeric',
            'short_description' => 'required|string',
            'long_description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'stock' => 'required|integer',
            'status' => 'required|in:active,inactive',
            'seo_tags' => 'nullable|string',
        ]);
    
        $imagePath = $request->file('image') ? $request->file('image')->store('products', 'public') : null;
    
        $product = new Product();
        $product->fill([
            'name' => $request->name,
            'category' => $request->category,
            'price' => $request->price,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,
            'image' => $imagePath,
            'stock' => $request->stock,
            'status' => $request->status,
            'seo_tags' => $request->seo_tags,
        ]);
        $product->save();
    
        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::findOrFail(decrypt($id));

        // Pass the product to the view
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail(decrypt($id));
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        // dd($request->all());
        
        
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'category' => 'required|string|max:255',
                'price' => 'required|numeric',
                'short_description' => 'required|string',
                'long_description' => 'required|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'stock' => 'required|integer',
                'status' => 'required|in:active,inactive',
                'seo_tags' => 'nullable|string',
            ]);
    
            // Handle image upload
            $imagePath = $product->image;
            if ($request->hasFile('image')) {
                // Delete old image
                if ($product->image && file_exists(storage_path('app/public/' . $product->image))) {
                    unlink(storage_path('app/public/' . $product->image));
                }
                // Store new image
                $imagePath = $request->file('image')->store('products', 'public');
            }
    
            // Update product
            $product->update([
                'name' => $request->name,
                'category' => $request->category,
                'price' => $request->price,
                'short_description' => $request->short_description,
                'long_description' => $request->long_description,
                'image' => $imagePath,
                'stock' => $request->stock,
                'status' => $request->status,
                'seo_tags' => $request->seo_tags,
            ]);
    
            return redirect()->route('products.index')->with('success', 'Product updated successfully.');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail(decrypt($id));
        // Delete the associated image file if it exists
        if ($product->image && file_exists(storage_path('app/public/' . $product->image))) {
            unlink(storage_path('app/public/' . $product->image));
        }
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
