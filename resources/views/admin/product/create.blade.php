@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Add Products</h3>
                    <a href="{{ url('admin/products') }}" class="btn btn-primary btn-sm float-end">
                        Back</a>
                </div>

                <div class="card-body">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }} <li></li>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <form action="{{ url('admin/save/products') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                    data-bs-target="#home-tab-pane" type="button" role="tab"
                                    aria-controls="home-tab-pane" aria-selected="true">
                                    Home
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="seotag-tab" data-bs-toggle="tab"
                                    data-bs-target="#seotag-tab-pane" type="button" role="tab"
                                    aria-controls="seotag-tab-pane" aria-selected="false">
                                    SEO Tags</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="details-tab" data-bs-toggle="tab"
                                    data-bs-target="#details-tab-pane" type="button" role="tab"
                                    aria-controls="details-tab-pane" aria-selected="false">
                                    Details</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="image-tab" data-bs-toggle="tab"
                                    data-bs-target="#image-tab-pane" type="button" role="tab"
                                    aria-controls="image-tab-pane" aria-selected="false">
                                    Product Image</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="color-tab" data-bs-toggle="tab"
                                    data-bs-target="#color-tab-pane" type="button" role="tab"
                                    aria-controls="color-tab-pane" aria-selected="false">
                                    Product Color</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">

                            <div class="tab-pane fade border p-3 show active"
                                id="home-tab-pane"role="tabpanel"aria-labelledby="home-tab" tabindex="0">
                                <div class="mb-3">
                                    <label>Category</label>
                                    <select name="category_id" class="form-control">
                                        {{-- @dd($categories) --}}
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label>Product Name</label>
                                    <input type="text" name="name" class="form-control" />
                                </div>
                                <div class="mb-3">
                                    <label>Product Slug</label>
                                    <input type="text" name="slug" class="form-control" />
                                </div>
                                <div class="mb-3">
                                    <label>Select Brand</label>
                                    <select name="brand_id" class="form-control">
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                            
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label>Description</label>
                                    <textarea name="description" class="form-control" rows="4"></textarea>
                                </div>
                            </div>
                            <div class="tab-pane fade border p-3" id="seotag-tab-pane" role="tabpanel"
                                aria-labelledby="seotag-tab" tabindex="0">
                                <div class="mb-3">
                                    <label>meta Title</label>
                                    <input type="text" name="meta_title" class="form-control" />
                                </div>
                                <div class="mb-3">
                                    <label>Meta Description</label>
                                    <textarea name="meta_description" class="form-control" rows="4"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label>Meta Keyword</label>
                                    <textarea name="meta_keyword" class="form-control" rows="4"></textarea>
                                </div>
                            </div>
                            <div class="tab-pane fade border p-3" id="details-tab-pane" role="tabpanel"
                                aria-labelledby="details-tab" tabindex="0">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label>Original Price</label>
                                            <input type="text" name="original_price" class="form-control" />
                                        </div>
                                        <div class="mb-3">
                                            <label>Selling Price</label>
                                            <input type="text" name="selling_price" class="form-control" />
                                        </div>
                                        <div class="mb-3">
                                            <label>Quantity</label>
                                            <input type="text" name="quantity" class="form-control" />
                                        </div>
                                        <div class="mb-3">
                                            <label>Trending</label>
                                            <input type="checkbox" name="trending"/>
                                        </div>
                                        <div class="mb-3">
                                            <label>Status</label>
                                            <input type="checkbox" name="status"/>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="tab-pane fade border p-3" id="image-tab-pane" role="tabpanel"
                                aria-labelledby="image-tab" tabindex="0">
                                <div class="mb-3">
                                    <label>Upload Product Image</label>
                                    <input type="file" name="image[]" class="form-control" multiple>
                                </div>
                            </div>
                            <div class="tab-pane fade border p-3" id="color-tab-pane" role="tabpanel"
                                aria-labelledby="color-tab" tabindex="0">
                                <div class="mb-3">
                                    <label>Select colors</label>
                                    <div class="row">

                                        @forelse ($colors as $color)
                                            <div class="col-md-3">
                                                <div class="p-2 border mb-3">
                                                    Color:<input type="checkbox" name="colors[{{($color->id)}}]"
                                                        value="{{ $color->id }}" />
                                                    {{ $color->name }}
                                                    <br />
                                                    Quantity: <input type="number" name="colorquantity[{{($color->id )}}]"
                                                        style="width:50px; border 1px solid">
                                                </div>

                                            </div>
                                        @empty
                                            <div class="col-md-12">
                                                <h4>No Colors found</h4>
                                            </div>
                                        @endforelse
                                    </div>

                                </div>
                                
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary float-end">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
