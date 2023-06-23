<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\ProductFormRequest;
use App\Models\Color;
use App\Models\ProductColor;

class ProductController extends Controller
{
    public function index()
    {

        $products = Product::all();

        return view('admin.product.index', compact('products'));
    }

    public function create()
    {

        $categories = Category::all();
        // dd($categories);
        $brands = Brand::all();
        $colors = Color::where('status', '0')->get();
        return view('admin.product.create', compact('categories', 'brands', 'colors'));
    }

    public function store(ProductFormRequest $request)
    {

        $validateData = $request->validated();
        // dd($validateData);
        $category = Category::findOrfail($validateData['category_id']);
        // dd($validateData);

        $product = $category->products()->create([
            'category_id' => $validateData['category_id'],
            'name' => $validateData['name'],
            'slug' => Str::slug($validateData['slug']),
            'brand_id' => $validateData['brand_id'],
            'description' => $validateData['description'],
            'original_price' => $validateData['original_price'],
            'selling_price' => $validateData['selling_price'],
            'quantity' => $validateData['quantity'],
            'trending' =>$request->trending == true ? '1' : '0',
            'status' =>  $request->status == true ? '1' : '0',
            'meta_title' => $validateData['meta_title'],
            'meta_keyword' => $validateData['meta_keyword'],
            'meta_description' => $validateData['meta_description'],

        ]);

            $i = 1;
        if ($request->hasFile('image')) {
            $uploadpath = 'uploads/products/';
            $file = $request->file('image');

            foreach ($file as $imageFile) {
                $extention = $imageFile->getClientOriginalExtension();
                $filename = time() . $i++ . '.' . $extention;
                $imageFile->move($uploadpath, $filename);
                $finalImagePathName = $uploadpath . '' . $filename;

                $product->productImages()->create([
                    'product_id' => $product->id,
                    'image' => $finalImagePathName,
                ]);
            }
        }

        if ($request->colors) {

            foreach ($request->colors as $key => $color) {
                $product->productColors()->create([
                    'product_id' => $product->id,
                    'color_id' => $color,
                    'quantity' => $request->colorquantity[$key] ?? 0
                ]);
            }
        }
        return redirect('admin/products')->with('message', 'Product added Successfully');
    }


    public function edit(int $product_id)
    {
        $categories = Category::all();
        $brands = Brand::all();
        $product = Product::findOrFail($product_id);
        $product_color = $product->productColors->pluck('color_id')->toArray();

        $colors = Color::whereNotIn('id', $product_color)->get();

        return view(
            'admin.product.edit',
            compact('product', 'categories', 'brands', 'colors')
        );
    }

    public function update(ProductFormRequest $request, int $product_id)
    {
        
        $validateData = $request->validated();
        // dd($validateData);
        $product = Product::findOrFail($product_id);

        if ($product) {
                //   dd($validateData);
            $product->update([
                'category_id' => $validateData['category_id'],
                'name' => $validateData['name'],
                'slug' => Str::slug($validateData['slug']),
                'brand_id' => $validateData['brand_id'],
                'description' => $validateData['description'],
                'original_price' => $validateData['original_price'],
                'selling_price' => $validateData['selling_price'],
                'quantity' => $validateData['quantity'],
                'trending' =>$request->trending == true ? '1' : '0',
                'status' =>  $request->status == true ? '1' : '0',
                'meta_title' => $validateData['meta_title'],
                'meta_keyword' => $validateData['meta_keyword'],
                'meta_description' => $validateData['meta_description'],
            ]);

            $i = 1;
            if ($request->hasFile('image')) {
                $uploadpath = 'uploads/products/';
                $file = $request->file('image');

                foreach ($file as $imageFile) {
                    $extention = $imageFile->getClientOriginalExtension();
                    $filename = time() . $i++ . '.' . $extention;
                    $imageFile->move($uploadpath, $filename);
                    $finalImagePathName = $uploadpath . '' . $filename;

                    $product->productImages()->create([
                        'product_id' => $product->id,
                        'image' => $finalImagePathName,
                    ]);
                }
            }

            if ($request->colors) {

                foreach ($request->colors as $key => $color) {
                    $product->productColors()->create([
                        'product_id' => $product->id,
                        'color_id' => $color,
                        'quantity' => $request->colorquantity[$key] ?? 0
                    ]);
                }
            }
            return redirect('admin/products')->with('message', 'Product Updated Successfully');
        } else {

            return redirect('admin/products')->with('message', 'No Such product Found');
        }
    }

    public function deleteImage(int $product_image_id)
    {

        $productImages = ProductImage::findOrFail($product_image_id);

        if (File::exists($productImages->image)) {
            File::delete($productImages->image);
        }
        $productImages->delete();
        return redirect()->back()->with('message', 'Product Image Deleted');
    }

    public function destroy(int $product_id)
    {
        $product = Product::findOrFail($product_id);
        if ($product->productImages) {
            foreach ($product->productImages as $image) {
                if (File::exists($image->image)) {
                    (File::delete($image->image));
                }
            }
        }

        $product->delete();

        return redirect()->back()->with('message', 'Product deleted with all its images');
    }

    public function updateProdColorQty(Request $request, $prod_color_id)
    {
        $productColorData = Product::findOrFail($request->product_id)
            ->productColors()->where('id', $prod_color_id)->first();
      
        $productColorData->update([
            'quantity' => $request->qty
        ]);
        
        return response()->json(['message' => 'Product Color Quantity Updated']);
    }

    public function deleteProductColor($prod_color_id){
    // dd($prod_color_id);
        $prodColor = ProductColor::findOrFail($prod_color_id);
        $prodColor->delete();
        
        return response()->json(['message' => 'Product color Deleted']);

    }
}
