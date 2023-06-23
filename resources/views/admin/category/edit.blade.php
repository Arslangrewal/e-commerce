@extends('layouts.admin')   
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3>Edit Category</h3>
                <a href="{{url('admin/category')}}" class="btn btn-primary btn-sm float-end">Back</a>
            </div>
 
            <div class="card-body">
                <form action="{{url('admin/update/category/'. $category->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        
                        <div class="col-md-6 mb-3">
                            <label>Name</label>
                            <input type="text" name="name" value="{{$category->name}}" class="form-control"/>
                            @error('name')<small class="text-danger">{{$message}}</small> @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Slug</label>
                            <input type="text" name="slug" value="{{$category->slug}}" class="form-control"/>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label>Description</label>
                            <input type="text" name="description" value="{{$category->description}}" class="form-control"/>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Image</label>
                            <input type="file" name="image"  class="form-control"/>
                            <img src="{{ asset('uplaods/category/'.$category->image)}}" alt="image"  style="height: 100px; width:80px;">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Status</label>
                            <input type="checkbox" {{$category->status == '1' ? 'checked' : ''}} name="status" />
                        </div>         
                        <div class="col-md-12">
                        <h4>SEO Tags</h4>    
                        </div>            
                        <div class="col-md-12 mb-3">
                            <label>Meta Title</label>
                            <input type="text" name="meta_title" value="{{$category->meta_title}}" class="form-control"/>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label>Meta Keyword</label>
                            <textarea name="meta_keyword"  class="form-control">{{$category->meta_keyword}}</textarea>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label>Meta Description</label>
                            <textarea name="meta_description" class="form-control">{{$category->meta_description}}</textarea>
                        </div>

                        <div class="col-md-12 mb-3">
                            <button type="submit" class="btn btn-primary float-end">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection