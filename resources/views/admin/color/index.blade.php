@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-md-12">
            @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h3>Colors List</h3>
                    <a href="{{ url('admin/colors/create') }}" class="btn btn-primary btn-sm float-end">
                        Add Color</a>
                </div>

                <div class="card-body">
                    <table class="table table-bordered table-stripted">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Color Name</th>
                                <th>Color Code</th>
                                <th>status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($colors as $color)
                                <tr>
                                    <td>{{$color->id}}</td>
                                    <td>{{$color->name}}</td>
                                    <td>{{$color->code}}</td>
                                    <td>{{$color->status ? 'Hidden':'Visible' }}</td>
                                    <td>
                                        <a href="{{url('admin/color/edit/'.$color->id)}}" class="btn btn-primary btn-sm">Edit</a>
                                        <a href="{{url('admin/colors/destroy/'.$color->id)}}" onclick="confirm('Are you sure, you want to delete this data?')"
                                            class="btn btn-danger btn-sm">Delete</a>
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