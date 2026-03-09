@php
use App\Http\Helpers\Helper;
@endphp
<div>
    <x-input-error-messages />

    <div class="container-xxl flex-grow-1 container-p-y">
        <!--/ page-label component -->
        <div>
            <x-home-page-label>Record, Update and Delete Income Here </x-home-page-label>
        </div>
        <!--/ action button component -->
        <div>
            <x-modal-home-create-button data-bs-target="#makeincome">Record income </x-modal-home-create-button>
        </div>
        <hr class="my-2">
        <div class="card">
            <div class="table-responsive text-nowrap">

                <table id="myTable" class="table">
                    <thead class="table-light">

                        <tr>
                            <th>SN</th>
                            <th>Income Title </th>
                            <th>Income Code </th>
                            <th>Category</th>
                            <th>Item</th>
                            <th>Amount</th>
                            <th>income Date</th>
                            <th>Note</th>

                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($incomes as $income )
                        <tr wire:key='{{$income->id}}'>
                            <td>{{$loop->index + 1}}</td>
                            <td>
                                {{$income->income_title}}
                            </td>
                            <td>
                                {{$income->income_code}}
                            </td>


                            <td>

                                {{(\App\Models\ReservationsIncCategory::where('id',
                                $income->category_id)->get()->value('category'))}}

                            </td>
                            <td>
                                {{(\App\Models\ReservationsIncItem::where('id', $income->item_id)->get()->value('item'))}}

                            </td>
                            <td>
                                {{Helper::format_currency($income->amount)}}
                            </td>
                            <td>
                                {{$income->income_date}}
                            </td>

                           
                            <td>
                                {{$income->note}}
                            </td>


                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown"><i class="ti ti-dots-vertical"></i></button>
                                    <div class="dropdown-menu">

                                        


                                        <a wire:click='destroy({{ $income->id }})'
                                            wire:confirm="Are you sure you want to proceed and delete this Income?"
                                            class="dropdown-item" href="javascript:void(0);"><i
                                                class="ti ti-trash me-1"></i> Delete</a>
                                    </div>
                                </div>
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!--/ income -->

    </div>




    <!-- Add New income Modal -->
    <div wire:ignore.self class="modal fade" id="makeincome" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-simple modal-add-new-cc">
            <div class="modal-content">
                <div class="modal-body">
                    <button wire:click='exit' type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>

                    <div class="text-center mb-6">
                        <h4 class="mb-2"><x-home-page-label>{{ $modal_title }}</x-home-page-label></h4>
                    </div>

                    <form onsubmit="return false">
                        @csrf


                        <div class="col-12">

                            <label class="form-label w-100" for="modalAddValue">income Title</label>
                            <div class="input-group input-group-merge">
                                <input wire:model='income_title' class="form-control form-control-lg" type="text"
                                    aria-describedby="modalincome" />
                                <span class="input-group-text cursor-pointer p-1" id="modalAddCard2"><span
                                        class="card-type"></span></span>
                            </div><br>
                            <label for="selectcat" class="form-label">Select income Category</label>
                            <select wire:model="category_id" class="form-select form-select-lg" data-allow-clear="true">
                                <option value="">--Select Category--</option>
                                @foreach ($categories as $category)
                                <option value="{{$category->id}}">{{$category->category}}</option>
                                @endforeach
                            </select><br>

                            <label for="selectCat" class="form-label">Select income Item</label>
                            <select wire:model="item_id" class="form-select form-select-lg" data-allow-clear="true">
                                <option value="">--Select Item--</option>
                                @foreach ($items as $item)
                                <option value="{{$item->id}}">{{$item->item}}</option>
                                @endforeach
                            </select><br>

                            <label class="form-label w-100" for="modalAddValue">Assign Value Amount</label>
                            <div class="input-group input-group-merge">
                                <input wire:model='amount' class="form-control form-control-lg" type="text"
                                    aria-describedby="modalincome" />
                                <span class="input-group-text cursor-pointer p-1" id="modalAddCard2"><span
                                        class="card-type"></span></span>
                            </div><br>
                            <label for="flatpickr-date2" class="form-label fw-bold">Choose income Date</label>
                            <input wire:model="income_date" class="form-control form-control-lg"
                                placeholder="Select income Date" type="text" id="flatpickr-date2" required>
                        </div><br>


                        <label class="form-label w-100" for="modalAddValue">income Note(Optional)</label>
                        <div class="input-group input-group-merge">
                            <input wire:model='note' placeholder="Example: Any additional details on this record"
                                class="form-control form-control-lg" type="text" aria-describedby="modalAllocate" />
                            <span class="input-group-text cursor-pointer p-1" id="modalAddCard2"><span
                                    class="card-type"></span></span>
                        </div><br>

                        <div class="col-12 text-center">
                            <button wire:click='save' type="button" class="btn btn-primary">
                                {{ 'Submit' }}
                            </button>
                            <button wire:click='exit' type="button" class="btn btn-label-secondary btn-reset"
                                data-bs-dismiss="modal">
                                Cancel
                            </button>


                            <x-app-loader></x-app-loader>
                        </div>
                </div>
                </form>

            </div>
        </div>
    </div>
</div>


</div>