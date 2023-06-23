@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-md-12">
            @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h3>Slider</h3>
                    <a href="{{ url('admin/sliders/create') }}" class="btn btn-primary btn-sm float-end">
                        Add Slider</a>
                </div>

                <div class="card-body">
                    <table class="table table-bordered table-stripted">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th style="width: 20%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                           @foreach ($sliders as $slider)
                               <tr>
                                <td>{{$slider->id}}</td>
                                <td>{{$slider->title}}</td>
                                <td>{{$slider->description}}</td>
                                <td><img src="{{asset($slider->image)}}" style="height: 70px; width:70px"</td>
                               
                                <td>{{$slider->status}}</td>
                                <td>
                                    <a href="{{url('admin/sliders/edit/'.$slider->id)}}" class="btn btn-primary">Edit</a>
                                    <a href="{{url('admin/sliders/destroy/'.$slider->id)}}"
                                        onclick="return confirm('Are you sure, you want to delete this data?')" 
                                        class="btn btn-danger">
                                        Delete
                                    </a>
                                </td>
                               </tr>
                           @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    


@endsection