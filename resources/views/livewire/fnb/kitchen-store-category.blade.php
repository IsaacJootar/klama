<div>
    <x-input-error-messages />
    <div class="container-xxl flex-grow-1 container-p-y">
        <div>
            <x-home-page-label>Manage Kitchen Store Categories</x-home-page-label>
        </div>
        <div>
            <x-modal-home-create-button data-bs-target="#createCategory">Create Category</x-modal-home-create-button>
        </div>
        <hr class="my-2">
        <div class="card">
            <div class="table-responsive text-nowrap">
                <table id="myTable" class="table">
                    <thead class="table-light">
                        <tr>
                            <th>SN</th>
                            <th>Category</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($categories as $category)
                            @if($category && $category->id)
                                <tr wire:key='{{ $category->id }}'>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $category->category }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a wire:click="edit({{ $category->id }})" data-bs-toggle="modal" data-bs-target="#createCategory" class="dropdown-item" href="javascript:void(0);">
                                                    <i class="ti ti-edit me-1"></i> Edit
                                                </a>
                                                <a wire:click="destroy({{ $category->id }})" wire:confirm="Are you sure you want to delete this category?" class="dropdown-item" href="javascript:void(0);">
                                                    <i class="ti ti-trash me-1"></i> Delete
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div wire:ignore.self class="modal fade" id="createCategory" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-simple modal-add-new-cc">
            <div class="modal-content">
                <div class="modal-body">
                    <button wire:click="exit" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center mb-6">
                    <h4 class="mb-2"><x-home-page-label>{{ $modal_title }}</x-home-page-label></h4>
                </div>
                    <form onsubmit="return false">
                        @csrf
                        <div class="mb-3">
                            <label for="categoryName" class="form-label">Category Name</label>
                            <input wire:model="category" type="text" class="form-control" id="categoryName" placeholder="Enter category name">
                        </div>
                        <div class="text-center">
                            <button wire:click="save" type="button" class="btn btn-primary">{{ $modal_flag ? 'Update' : 'Save' }}</button>
                            <button wire:click="exit" type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>