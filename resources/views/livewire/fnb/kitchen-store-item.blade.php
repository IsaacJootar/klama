<div>
    <x-input-error-messages />

    <div class="container-xxl flex-grow-1 container-p-y">
        <div>
            <x-home-page-label>Manage Kitchen Store Items</x-home-page-label>
        </div>
        <div>
            <x-modal-home-create-button data-bs-target="#createItem">Create Item</x-modal-home-create-button>
        </div>
        <hr class="my-2">
        <div class="card">
            <div class="table-responsive text-nowrap">
                <table id="myTable" class="table">
                    <thead class="table-light">
                        <tr>
                            <th>SN</th>
                            <th>Item</th>
                            <th>Measurement Tag</th>
                            <th>Category</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($items as $item)
                            <tr wire:key='{{ $item->id }}'>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $item->item }}</td>
                                <td>{{ $item->measurement_tag ?? 'N/A' }}</td>
                                <td>{{ $item->category->category ?? 'N/A' }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                            <i class="ti ti-dots-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a wire:click="edit({{ $item->id }})" data-bs-toggle="modal" data-bs-target="#createItem" class="dropdown-item" href="javascript:void(0);">
                                                <i class="ti ti-edit me-1"></i> Edit
                                            </a>
                                            <a wire:click="destroy({{ $item->id }})" wire:confirm="Are you sure you want to delete this item?" class="dropdown-item" href="javascript:void(0);">
                                                <i class="ti ti-trash me-1"></i> Delete
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" id="createItem" tabindex="-1" aria-hidden="true">
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
                            <label for="itemName" class="form-label">Item Name</label>
                            <input wire:model="item" type="text" class="form-control" id="itemName" placeholder="Enter item name">
                        </div>
                        <div class="mb-3">
                            <label for="measurementTag" class="form-label">Measurement Tag</label>
                            <input wire:model="measurement_tag" type="text" class="form-control" id="measurementTag" placeholder="Enter measurement tag (e.g., bottles, kg)">
                        </div>
                        <div class="mb-3">
                            <label for="categorySelect" class="form-label">Category</label>
                            <select wire:model="category_id" class="form-select" id="categorySelect">
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->category }}</option>
                                @endforeach
                            </select>
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