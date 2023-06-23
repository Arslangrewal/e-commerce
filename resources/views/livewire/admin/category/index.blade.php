<div>
    <div class="row">
        <div class="col-md-12">
            @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h3>Category</h3>
                    <a href="{{ url('admin/add/category') }}" class="btn btn-primary btn-sm float-end">Add Category</a>
                </div>

                <div class="card-body">
                    <table class="table table-bordered table-stripted">
                        <thead>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Meta Title</th>
                            <th>Meta Keyword</th>
                            <th>Meta Discription</th>
                            <th>Status</th>
                            <th style="width: 20%"> Action</th>
                        </thead>

                        <tbody>
                            
                            @forelse ($categories as $cat)
                                <tr>
                                    <td>{{ $cat->id }}</td>
                                    <td>{{ $cat->name }}</td>
                                    <td>{{ $cat->slug }}</td>
                                    <td>{{ $cat->description }}</td>

                                    <td><img src="{{ asset($cat->image) }}"></td>

                                    <td>{{ $cat->meta_title }}</td>
                                    <td>{{ $cat->meta_keyword }}</td>
                                    <td>{{ $cat->meta_description }}</td>
                                    <td>{{ $cat->status == '1' ? 'hidden' : 'visible' }}</td>
                                    <td>
                                        <a href="{{ url('admin/edit/category/' . $cat->id) }}"
                                            class="btn btn-primary btn-sm">Edit</a>

                                        <a href="{{ url('admin/category/delete/' . $cat->id) }}"
                                            onclick="return confirm('Are you sure, you want to delete this data?')"
                                            class="btn btn-danger btn-sm">Delete</a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5">No Category Found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
