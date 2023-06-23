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
                <h3> Add Slider </h3>
                <a href="{{ url('admin/sliders') }}" class="btn btn-primary btn-sm float-end">
                    Back</a>
            </div>

            <div class="card-body">
                <form action="{{ url('admin/sliders/store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label>Title</label>
                        <input type="text"name="title" class="form-control" />
                    </div>
                    <div class="mb-3">
                        <label>Description</label>
                        <textarea type="text" name="description" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label>Image</label>
                        <input type="file" name="image" class="form-control" />
                    </div>
                    <div class="mb-3">
                        <label>Status</label>
                        <input type="checkbox" name="status" />
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
@endsection
