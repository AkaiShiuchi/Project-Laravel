<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportProduct;
use App\Exports\ExportProduct;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function display()
    {
        $products = Product::all();
        return view('products.listProduct')->with('product', $products);
    }

    public function AddProduct(Request $request)
    {
        $product = DB::table('product')->where('id', $request->id)->first();

        if (empty($product)) {
            $newProduct = new Product();

            if ($request->hasFile('file')) {
                $file = $request->file('file');

                // Lưu file vào thư mục 'public/uploads'
                $path = $file->store('public/uploads');

                $newProduct->fill([
                    'id' => $request->id,
                    'name' => $request->name,
                    'describe' => $request->describe,
                    'image' => basename($path)
                ])->save();
                toastr()->success('Add new product successful.');
                return redirect()->route('product');
            }
            toastr()->error('Add new product failed!');
            return redirect()->back();
        }
        toastr()->error('Account already exists');
        return redirect()->back();
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