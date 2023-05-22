<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $user = Auth::user(); // Giriş yapan kullanıcı
            $categories = $user->seller_categories()
                ->orderBy('id','desc');

            return DataTables::of($categories)
                ->addColumn('edit', function ($category) {
                    $btn = '<button type="button" class="btn btn-primary btn-sm edit" data-id="'.$category->id.'">Düzenle</button>';
                    return $btn;
                })
                ->addColumn('delete', function ($category) {
                    $btn = '<button type="button" class="btn btn-danger btn-sm delete" data-id="'.$category->id.'">Sil</button>';
                    return $btn;
                })
                ->rawColumns(['edit', 'delete'])
                ->make(true);
        }

        return view('dashboard.seller-panel.category-list');

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
        $user = Auth::id(); // Giriş yapan kullanıcının id değeri
        Categories::create([
            'category_name' => $request->input('category_name'),
            'category_type' => $request->input('category_type'),
            'seller_id' => $user,
        ]);

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
        $categories = Categories::find($id);
        return response()->json($categories);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $category = Categories::find($id);
        $category->category_name = $request->input('category_name');
        $category->category_type = $request->input('category_type');
        $category->save();

        return response()->json(['success' => 'Kategori başarıyla güncellendi.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Categories::find($id)->delete();
        return response()->json(['success'=>'Kategori başarıyla silindi.']);
    }
}
