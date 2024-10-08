@extends('layouts.admin')

@section('title', 'Edit Users')
@section('content')
    <div class="row">
        <div class="col-md-12">
            @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h3>Edit User</h3>
                    <a href="{{ url('admin/users') }}" class="btn btn-danger btn-sm float-end">
                        Back</a>
                </div>

                <div class="card-body">

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}
                            </div>
                        @endforeach
                    </div>
                @endif
                    <form action="{{ url('admin/users/update/'. $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Name</label>
                                <input type="text" name="name" value="{{$user->name}}" class="form-control" />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Email</label>
                                <input type="text" name="email" readonly value="{{$user->email}}" class="form-control" />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Password</label>
                                <input type="text" name="password" value="{{$user->password}}" class="form-control" />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Select Role</label>
                                <select name="role_as" class="form-control">
                                    <option value="0" {{ $user->role_as == '0' ? 'selected' :'' }}>User</option>
                                    <option value="1" {{ $user->role_as == '1' ? 'selected' :'' }}>Admin</option>
                                </select>
                            </div>
                            <div class="col-md-12 text-end">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
