<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductsRequest;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Season;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('seasons')->paginate(6);
        return view('products.index', compact('products'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }

    public function create()
    {
        $seasons = Season::all();
        return view('products.create', compact('seasons'));
    }

    public function store(ProductsRequest $request)
    {
        $validated = $request->validated();

        $product = new Product();
        $product->name = $validated['name'];
        $product->price = $validated['price'];
        $product->season_id = $validated['season'];
        $product->description = $validated['description'];

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $product->image = basename($imagePath);
        }

        $product->save();

        return redirect()->route('products.index')->with('success', '商品が追加されました');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $sort = $request->input('sort');

        $products = Product::query();

        if ($query) {
            $products->where('name', 'like', '%' . $query . '%');
        }

        if ($sort) {
            $products->orderBy('price', $sort === 'high' ? 'desc' : 'asc');
        }

        $products = $products->paginate(6);

        return view('products.index', compact('products'));
    }

    public function update(ProductsRequest $request, $productId)
{
    $product = Product::findOrFail($productId);

    // バリデーションは ProductsRequest に移動しているため、ここで再度 validate() を呼ぶ必要はありません。
    $validated = $request->validated(); // ProductsRequest に定義されたバリデーションを適用

    $product->name = $validated['name'];
    $product->price = $validated['price'];
    $product->season_id = $validated['season']; // 複数の季節がある場合は、配列処理が必要
    $product->description = $validated['description'];

    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('images', 'public');
        $product->image = basename($imagePath);
    }

    $product->save();

    if (isset($validated['seasons'])) {
        $product->seasons()->sync($validated['seasons']); // seasons は配列
    }

    return redirect()->route('products.show', $product->id)->with('success', '商品情報が更新されました');
}


    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('products.index')->with('success', '商品が削除されました');
    }
}
