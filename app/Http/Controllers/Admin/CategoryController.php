<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\CategoryFormRequest;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::all();
        return view('admin.category.index', compact('categories'));
    }

    public function create(){
       
        return view('admin.category.create');

    }

    public function store(CategoryFormRequest $request){

        $validateData = $request->validated();
        // dd($request->all());
        $category = new Category;
        $category->name = $validateData['name'];
        $category->slug = Str::slug($validateData['slug']);
        $category->description = $validateData['description']; 
       
        $uploadPath = 'uplaods/category/';
        if($request->hasFile('image')){
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'. $ext;
            $file->move(public_path('uplaods/category/'), $filename);

            $category->image = $uploadPath.$filename;
        }

        $category->meta_title = $validateData['meta_title'];
        $category->meta_keyword = $validateData['meta_keyword'];
        $category->meta_description = $validateData['meta_description'];
        $category->status = $request->status == true ? '1':'0';
        
        $category->save();
    
        return redirect('admin/category')->with('message', 'Category added successfully');
    } 

    public function edit($id){

        $category = Category::where('id', $id)->first();
        return view('admin.category.edit', compact('category'));
    }

    public function update(CategoryFormRequest $request, $id){

       $validateData = $request->validated();
       $category = Category::findOrFail($id); 

       $category->name = $validateData['name'];
       $category->slug = Str::slug($validateData['slug']);
       $category->description = $validateData['description']; 

       
       if($request->hasFile('image')){
        $path = 'uplaods/category/'. $category->image;
        if(File::exists($path)){
            File::delete($path);
        }

       }
       $uploadPath = 'uplaods/category/';
       if($request->hasFile('image')){
           $file = $request->file('image');
           $ext = $file->getClientOriginalExtension();
           $filename = time().'.'. $ext;
           $file->move(public_path('uplaods/category/'), $filename);

           $category->image = $uploadPath.$filename;
       }
       

       $category->meta_title = $validateData['meta_title'];
       $category->meta_keyword = $validateData['meta_keyword'];
       $category->meta_description = $validateData['meta_description'];
       $category->status = $request->status == true ? '1':'0';
       $category->update();

       return redirect('admin/category')->with('message', 'Category updated successfully');
    }

    public function destroy(int $cate_id){
        $category = Category::findOrFail($cate_id);

        $category->delete();

        return redirect('admin/category')->with('message', 'Category Deleted Successfully');
    }
    
}
