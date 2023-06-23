<?php

namespace App\Http\Livewire\Admin\Category;

use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;
use Illuminate\Support\Facades\File;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $cat_id;

    public function deleteCategory($cat_id){
        // dd($cat_id);
        $this->cat_id = $cat_id;
    }


    public function destroyCategory(){

        $category =  Category::find($this->category_id);
        $path = 'uploads/category/'.$category->image;
        if(File::exists($path)){
            File::delete($path);
        }
        $category->delete();
        session()->flash('message','Category deleted Successfully');
        
    }

    public function render()
    {
        $categories = Category::orderBy('id','ASC')->paginate(10);
     
        return view('livewire.admin.category.index',compact('categories'));
    }



}
