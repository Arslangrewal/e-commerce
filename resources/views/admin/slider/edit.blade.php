@extends('layouts.admin')
@section('content')
    <div class="row">
        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }} <li></li>
                    </div>
                @endforeach
            </div>
        @endif
        <div class="card">
            <div class="card-header">
                <h3> Edit Slider </h3>
                <a href="{{ url('admin/sliders') }}" class="btn btn-primary btn-sm float-end">
                    Back</a>
            </div>

            <div class="card-body">
                <form action="{{ url('admin/sliders/update/'.$slider->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label>Title</label>
                        <input type="text"name="title" value="{{$slider->title}}" class="form-control" />
                    </div>
                    <div class="mb-3">
                        <label>Description</label>
                        <textarea type="text" name="description"  class="form-control" rows="3">{{$slider->description}}</textarea>
                    </div>
                    <div class="mb-3">
                        <label>Image</label>
                        <input type="file" name="image"  class="form-control" />
                        <img src="{{asset($slider->image)}}" style="width: 70px; height: 100px" alt="slider">
                    </div>
                    <div class="mb-3">
                        <label>Status</label>
                        <input type="checkbox" {{$slider->status == '1' ? 'checked': ''}} name="status" />
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
@endsection
