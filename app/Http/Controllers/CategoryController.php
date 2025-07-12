<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MainCategory;
use App\Models\Brand;
use App\Models\Type;
use App\Models\Size;


class CategoryController extends Controller
{



    // Show all forms for category hierarchy
    public function index()
    {
        $mainCategories = MainCategory::all();
        $brands = Brand::all();
        $types = Type::all();

        return view('categories.index', compact('mainCategories', 'brands', 'types'));
    }

    // Store Main Category
    public function storeMain(Request $request)
    {
        $request->validate([
            'main_category' => 'required|string|max:255',
        ]);

        MainCategory::create([
            'name' => $request->main_category
        ]);

        return redirect()->back()->with('success', 'Main category added successfully!');
    }

    // Store Brand under Main Category
    public function storeBrand(Request $request)
    {
        $request->validate([
            'main_category_id' => 'required|exists:main_categories,id',
            'brand' => 'required|string|max:255',
        ]);

        Brand::create([
            'main_category_id' => $request->main_category_id,
            'name' => $request->brand,
        ]);

        return redirect()->back()->with('success', 'Brand added successfully!');
    }

    // Store Type under Brand
    public function storeType(Request $request)
    {
        $request->validate([
            'brand_id' => 'required|exists:brands,id',
            'type' => 'required|string|max:255',
        ]);

        Type::create([
            'brand_id' => $request->brand_id,
            'name' => $request->type,
        ]);

        return redirect()->back()->with('success', 'Type added successfully!');
    }

    // Store Size under Type
    public function storeSize(Request $request)
    {
        $request->validate([
            'type_id' => 'required|exists:types,id',
            'size' => 'required|string|max:255',
        ]);

        Size::create([
            'type_id' => $request->type_id,
            'name' => $request->size,
        ]);

        return redirect()->back()->with('success', 'Size added successfully!');
    }
}
