@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-md-12">
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
                    <h3> Add Colors </h3>
                    <a href="{{ url('admin/colors') }}" class="btn btn-primary btn-sm float-end">
                        Back</a>
                </div>

                <div class="card-body">
                    <form action="{{url('admin/colors/store')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label>Name</label>
                            <input type="text"name="name"  class="form-control"/>
                        </div>
                        <div class="mb-3">
                            <label>Code</label>
                            <input type="text" name="code" class="form-control"/>
                        </div>
                        <div class="mb-3">
                            <label>Status</label>
                            <input type="checkbox" name="status"/>
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
