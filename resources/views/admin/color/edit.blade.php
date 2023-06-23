@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-md-12">
            @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h3> Edit Colors </h3>
                    <a href="{{ url('admin/colors') }}" class="btn btn-primary btn-sm float-end">
                        Back</a>
                </div>

                <div class="card-body">
                    <form action="{{url('admin/colors/update/'.$color->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label>Name</label>
                            <input type="text" name="name" value="{{$color->name}}" class="form-control"/>
                        </div>
                        <div class="mb-3">
                            <label>Code</label>
                            <input type="text" name="code" value="{{$color->code}}" class="form-control"/>
                        </div>
                        <div class="mb-3">
                            <label>Status</label>
                            <input type="checkbox" {{$color->status == '1' ? 'checked' : ''}} name="status"/>
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
