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

    public function upload(Request $request)
    {
        // Kiểm tra nếu có file được chọn
        if ($request->hasFile('file')) {
            $file = $request->file('file');

            // Lưu file vào thư mục 'public/uploads'
            $path = $file->store('public/uploads');

            $product = Product::where('id', $request->product_id)->first();
            $product->update([
                'image' => $product->image = $path
            ]);
            toastr()->success('Upload successful');
            return redirect()->back();
        }
        toastr()->error('No file selected.');
        return redirect()->back();
    }
}
