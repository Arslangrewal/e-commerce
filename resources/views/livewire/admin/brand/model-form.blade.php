  <!-- Modal -->
  <div wire:ignore.self class="modal fade" id="addBrandModel" tabindex="-1" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Add Brands</h5>
                  <button type="button" wire:click="closeModal" class="btn-close" data-bs-dismiss="modal"
                      aria-label="Close"></button>
              </div>
              <form wire:submit.prevent="storeBrand">
                  <div class="modal-body">
                    <div class="mb-3">
                        <label>Select Category</label>
                        <select wire:model.defer="category_id" required class="form-control">
                            <option value="">
                                @foreach ($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </option>

                        </select>
                    </div>
                      <div class="mb-3">
                          <label>Brand Name</label>
                          <input type="text" wire:model.defer="name" class="form-control">
                          @error('name')
                              <small class="text-danger">{{ $message }}</small>
                          @enderror
                      </div>
                      <div class="mb-3">
                          <label>Brand Slug</label>
                          <input type="text" wire:model.defer="slug" class="form-control">
                          @error('slug')
                              <small class="text-danger">{{ $message }}</small>
                          @enderror
                      </div>
                      <div class="mb-3">
                          <label>Status</label>
                          <input type="checkbox" wire:model.defer="status">
                          @error('status')
                              <small class="text-danger">{{ $message }}</small>
                          @enderror
                      </div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" wire:click="closeModal" class="btn btn-secondary"
                          data-bs-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Save</button>
                  </div>
              </form>
          </div>
      </div>
  </div>

  <!-- Brand Update Modal -->
  <div wire:ignore.self class="modal fade" id="updateBrandModel" tabindex="-1" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Update Brands</h5>
                  <button type="button" class="btn-close" wire:click="closeModal" data-bs-dismiss="modal"
                      aria-label="Close"></button>
              </div>
              <div wire:loading class="p-2">
                  <div class="spinner-border text-primary" role="status">
                      <span class="visually-hidden">Loading...</span>
                  </div>Loading...
              </div>
              <div wire:loading.remove>

                  <form wire:submit.prevent="updateBrand">

                      <div class="modal-body">
                        <div class="mb-3">
                            <label>Select Category</label>
                            <select wire:model.defer="category_id" required class="form-control">
                                <option value="">
                                    @foreach ($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </option>
                            </select>
                        </div>
                            <h4>Are you sure you want to delete this data?</h4>
                          <div class="mb-3">
                              <label>Brand Name</label>
                              <input type="text" wire:model.defer="name" class="form-control">
                              @error('name')
                                  <small class="text-danger">{{ $message }}</small>
                              @enderror
                          </div>
                          <div class="mb-3">
                              <label>Brand Slug</label>
                              <input type="text" wire:model.defer="slug" class="form-control">
                              @error('slug')
                                  <small class="text-danger">{{ $message }}</small>
                              @enderror
                          </div>
                          <div class="mb-3">
                              <label>Status</label>
                              <input type="checkbox" wire:model.defer="status">
                              @error('status')
                                  <small class="text-danger">{{ $message }}</small>
                              @enderror
                          </div>
                      </div>

                      <div class="modal-footer">
                          <button type="button" wire:click="closeModal" class="btn btn-secondary"
                              data-bs-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary">Update</button>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>

  <!-----Brand delete Modal----->

  <div wire:ignore.self class="modal fade" id="deleteBrandModel" tabindex="-1" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Delete Brands</h5>
                  <button type="button" class="btn-close" wire:click="closeModal" data-bs-dismiss="modal"
                      aria-label="Close"></button>
              </div>
              <div wire:loading class="p-2">
                  <div class="spinner-border text-primary" role="status">
                      <span class="visually-hidden">Loading...</span>
                  </div>Loading...
              </div>
              <div wire:loading.remove>

                  <form wire:submit.prevent="destroyBrand">

                      <div class="modal-body">
                            <h4>Are you sure you want to delete this data?</h4>
                          
                      </div>

                      <div class="modal-footer">
                          <button type="button" wire:click="closeModal" class="btn btn-secondary"
                              data-bs-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary">Yes, Delete</button>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>
