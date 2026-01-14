<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Season;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::simplePaginate(6);

        return view('products', compact('products'));
    }

    public function search(Request $request)
    {
        $products = Product::KeywordSearch($request->keyword);

        if ($request->sort === 'high')
            {
                $products->orderBy('price', 'desc');
            }elseif($request->sort === 'low'){
                $products->orderBy('price', 'asc');
            }
        $products = $products
        ->simplePaginate(6)
        ->withQueryString();

        return view('products', compact('products'));

    }

    public function show($productId)
    {
        $product = Product::findOrFail($productId);

        $product->load('seasons');

        $seasons = Season::all();

        return view('details', compact('product', 'seasons'));
    }

    public function registerIndex()
    {
        $seasons = Season::all();

        return view('registers', compact('seasons'));
    }

    public function store(ProductRequest $request)
    {
        $data = $request->only(['name', 'price', 'description']);

        if($request->hasFile('image'))
            {
                $path = $request->file('image')->store('fruits-img', 'public');
                $data['image'] = $path;
            }

        $product = Product::create($data);

        if($request->has('seasons'))
            {
                $product->seasons()->attach($request->seasons);
            }

        return redirect()->route('products.index');
    }

    public function update(ProductRequest $request, $productId)
    {
        $product = Product::findOrFail($productId);
        $data = $request->only(['name', 'price', 'description']);

        if($request->hasFile('image'))
            {
                $path = $request->file('image')->store('uploading', 'public');
                $data['image'] = $path;
            }

        $product->update($data);

        if($request->has('seasons'))
            {
                $product->seasons()->sync($request->seasons);
            }

        return redirect()->route('products.index');
    }

    public function destroy(Request $request, $productId)
    {
        $product = Product::FindOrFail($productId);
        $product->seasons()->detach();
        
        if($product->image)
            {
                Storage::disk('public')->delete($product->image);
            }

        $product->delete();

        return redirect()->route('products.index');
    }
}
