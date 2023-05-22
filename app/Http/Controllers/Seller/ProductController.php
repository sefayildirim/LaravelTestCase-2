<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
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
        if ($request->ajax()) {
            $user = Auth::user(); // Giriş yapan kullanıcı
            $products = $user->seller_product()->with('category')->get();

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

        return view('dashboard.seller-panel.product-list');
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
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
