<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user(); // Giriş yapan kullanıcı
        $categories = $user->seller_categories()
            ->get();

        if ($request->ajax()) {
            $user = Auth::user(); // Giriş yapan kullanıcı
            $products = $user->seller_product()->with('category')->orderBy('id','desc');
            return DataTables::of($products)
                ->addColumn('edit', function ($product) {
                    $btn = '<button type="button" class="btn btn-primary btn-sm edit" data-id="'.$product->id.'">Düzenle</button>';
                    return $btn;
                })
                ->addColumn('delete', function ($product) {
                    $btn = '<button type="button" class="btn btn-danger btn-sm delete" data-id="'.$product->id.'">Sil</button>';
                    return $btn;
                })
                ->rawColumns(['edit', 'delete'])
                ->make(true);
        }


        return view('dashboard.seller-panel.product-list', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $categoryName = $request->input('category_name');
        $category = Categories::where('category_name', $categoryName)->first();
        $user = Auth::id(); // Giriş yapan kullanıcının id değeri

        if (!$category) {
            abort(403,'Böyle bir Kategori bulunamadı');
        }else{
            Products::create([
                'product_name' => $request->input('product_name'),
                'category_id' => $category->id,
                'seller_id' => $user,
            ]);
        }



        return response()->json(['success'=>'Kategori başarıyla eklendi.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $products = Products::find($id);
        $categoryName = $products->category->category_name;
        $products->category_name = $categoryName;
        return response()->json($products);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Products::find($id);
        if (!$product) {
            abort(404, 'Güncellenecek ürün bulunamadı');
        }

        $product->product_name = $request->input('product_name');
        $categoryName = $request->input('category_name');
        $category = Categories::where('category_name', $categoryName)->first();
        $user = Auth::id(); // Giriş yapan kullanıcının id değeri

        if (!$category) {
            abort(403, 'Böyle bir Kategori bulunamadı');
        } else {
            $product->category_id = $category->id;
            $product->seller_id = $user;
            $product->save();
        }

        return response()->json(['success' => 'Ürün başarıyla güncellendi.']);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Products::find($id)->delete();
        return response()->json(['success'=>'Ürün başarıyla silindi.']);
    }
}
