<div>
    @include('livewire.admin.brand.model-form')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Brands List</h4>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#addBrandModel"
                        class="btn btn-primary btn-sm float-end">Add brands</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-stripted">
                        <thead>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Slug</th>
                            <th>Status</th>
                            <th style="width:20%">Action</th>
                        </thead>
                        <tbody>
                            @forelse ($brands as $brand)
                                <tr>
                                    <td>{{$brand->id}}</td>
                                    <td>{{$brand->name}}</td>
                                    <td>
                                        @if($brand->category)
                                        {{$brand->category->name}}
                                        @else
                                        No Category
                                        @endif
                                    </td>
                                    <td>{{$brand->slug}}</td>
                                    <td>{{$brand->status == '1' ? 'hidden': 'visible'}}</td>
                                    <td>
                                        <a href="#" wire:click="editBrand({{$brand->id}})" data-bs-toggle="modal" data-bs-target="#updateBrandModel" class="btn btn-primary">Edit</a>
                                        <a href="#" wire:click="deleteBrand({{$brand->id}})" data-bs-toggle="modal" data-bs-target="#deleteBrandModel" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">No Brands Found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {!! $brands->withQueryString()->links('pagination::bootstrap-5') !!}
                        
                    
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    window.addEventListener('close-model', event => {
        
        $('#addBrandModel').modal('hide');
        $('#updateBrandModel').modal('hide');
        $('#deleteBrandModel').modal('hide');
    });
</script> 
@endpush
