<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportProduct;
use App\Exports\ExportProduct;

class ProductController extends Controller
{
    public function display()
    {
        $products = Product::all();
        return view('products.listProduct')->with('product', $products);
    }

    public function importView(Request $request)
    {
        return view('importFile');
    }

    public function import(Request $request)
    {
        Excel::import(new ImportProduct, $request->file('file')->store('files'));
        return redirect()->back();
    }

    public function exportProducts(Request $request)
    {
        return Excel::download(new ExportProduct, 'products.csv');
    }
}
