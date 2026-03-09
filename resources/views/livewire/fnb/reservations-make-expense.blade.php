@php
use App\Http\Helpers\Helper;
@endphp
<div>
    <x-input-error-messages />

    <div class="container-xxl flex-grow-1 container-p-y">
        <!--/ page-label component -->
        <div>
            <x-home-page-label>Make, Update and Delete Expenses Here </x-home-page-label>
        </div>
        <!--/ action button component -->
        <div>
            <x-modal-home-create-button data-bs-target="#makeExpense">Make Expense </x-modal-home-create-button>
        </div>
        <hr class="my-2">
        <div class="card">
            <div class="table-responsive text-nowrap">

                <table id="myTable" class="table">
                    <thead class="table-light">

                        <tr>
                            <th>SN</th>
                            <th>Expense Title </th>
                            <th>Expense Code </th>
                            <th>Category</th>
                            <th>Item</th>
                            <th>Amount</th>
                            <th>Expense Date</th>
                            <th>Expense State</th>
                            <th>Note</th>

                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($expenses as $expense )
                        <tr wire:key='{{$expense->id}}'>
                            <td>{{$loop->index + 1}}</td>
                            <td>
                                {{$expense->expense_title}}
                            </td>
                            <td>
                                {{$expense->expense_code}}
                            </td>


                            <td>

                                {{(\App\Models\FnbExpCategory::where('id',
                                $expense->category_id)->get()->value('category'))}}

                            </td>
                            <td>
                                {{(\App\Models\FnbExpItem::where('id', $expense->item_id)->get()->value('item'))}}

                            </td>
                            <td>
                                {{Helper::format_currency($expense->amount)}}
                            </td>
                            <td>
                                {{$expense->expense_date}}
                            </td>

                           <td>
  <small class="text-muted">
    <i class="badge bg-label-{{ $expense->list_flag == 1 ? 'success' : 'warning' }} ms-1">
      {{ $expense->list_flag == 1 ? 'Closed' : 'Open' }}
    </i>
  </small>
</td>
                            <td>
                                {{$expense->note}}
                            </td>


                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown"><i class="ti ti-dots-vertical"></i></button>
                                    <div class="dropdown-menu">

                                        <a wire:click="expenseList({{ $expense->id }})" data-bs-toggle="modal"
                                            data-bs-target="#listExpense" class="dropdown-item"
                                            href="javascript:void(0);">
                                            <i class="ti ti-list me-1"></i> View Details
                                        </a>



                                        <a wire:click='destroy({{ $expense->id }})'
                                            wire:confirm="Are you sure you want to proceed and delete this expense?"
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
        <!--/ expense -->

    </div>

    <!--/ expense List Modal -->
<div wire:ignore.self class="modal fade" id="listExpense" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-simple modal-add-new-cc modal-xl">
    <div class="modal-content">
      <div class="modal-body">
        <button wire:click='exit' type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>

        <div class="text-center mb-4">
          <h4 class="mb-2">
            <x-home-page-label>Expense View</x-home-page-label>
          </h4>
        </div>

        {{-- Only show header if $list is set --}}
        @if($list)
          <div class="mb-2">
            <strong>Expense Title:</strong> {{ $list?->expense_title }}
            <strong>Expense Code:</strong>  {{ $list?->expense_code }}
          </div>
          
           {{-- display total --}}
  <div class="mb-3">
    <strong>Total Amount in List:</strong>
    {{ Helper::format_currency($totalAmount) }}
  </div>
        @endif

        @if($lists && $lists->count())
          <div class="table-responsive">
            <table class="table table-striped table-bordered">
              <thead class="table-light">
                <tr>
                  <th>Expense Title</th>
                  <th>Expense Code</th>
                  <th>Category</th>
                  <th>Item</th>
                  <th>Amount</th>
                  <th>Date</th>
                  <th>Expense Note</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($lists as $entry)
                  <tr>
                    <td>{{ $entry->expense_title }}</td>
                    <td>{{ $entry->expense_code }}</td>
                    <td>{{ \App\Models\FnbExpCategory::find($entry->category_id)?->category }}</td>
                    <td>{{ \App\Models\FnbExpItem::find($entry->item_id)?->item }}</td>
                    <td>{{ Helper::format_currency($entry->amount) }}</td>
                    <td>{{ \Carbon\Carbon::parse($entry->expense_date)->format('d M, Y') }}</td>
                    <td>{{ $entry->note }}</td>
                    <td>
                      <button wire:click="removeExpense({{ $entry->id }})" class="btn btn-sm btn-danger">
                        Remove
                      </button>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        @else
          <div class="alert alert-info text-center mb-0">Expense not found</div>
        @endif
        
        

        <div class="text-center mt-3">
          <button wire:click="exit" type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
            Close
          </button>

          {{-- Only render Close-Expense if $list exists --}}
          @if($list)
            <button
              wire:click="closeExpense('{{ $list->expense_code }}')"
              type="button"
              class="btn btn-label-primary btn-reset"
              data-bs-dismiss="modal">
              Close Expense
            </button>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>



    <!-- Add New expense Modal -->
    <div wire:ignore.self class="modal fade" id="makeExpense" tabindex="-1" aria-hidden="true">
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

                            <label class="form-label w-100" for="modalAddValue">Expense Title</label>
                            <div class="input-group input-group-merge">
                                <input wire:model='expense_title' class="form-control form-control-lg" type="text"
                                    aria-describedby="modalexpense" />
                                <span class="input-group-text cursor-pointer p-1" id="modalAddCard2"><span
                                        class="card-type"></span></span>
                            </div><br>
                            <label for="selectcat" class="form-label">Select Expense Category</label>
                            <select wire:model="category_id" class="form-select form-select-lg" data-allow-clear="true">
                                <option value="">--Select Category--</option>
                                @foreach ($categories as $category)
                                <option value="{{$category->id}}">{{$category->category}}</option>
                                @endforeach
                            </select><br>

                            <label for="selectCat" class="form-label">Select Expense Item</label>
                            <select wire:model="item_id" class="form-select form-select-lg" data-allow-clear="true">
                                <option value="">--Select Item--</option>
                                @foreach ($items as $item)
                                <option value="{{$item->id}}">{{$item->item}}</option>
                                @endforeach
                            </select><br>

                            <label class="form-label w-100" for="modalAddValue">Assign Value Amount</label>
                            <div class="input-group input-group-merge">
                                <input wire:model='amount' class="form-control form-control-lg" type="text"
                                    aria-describedby="modalexpense" />
                                <span class="input-group-text cursor-pointer p-1" id="modalAddCard2"><span
                                        class="card-type"></span></span>
                            </div><br>
                            <label for="flatpickr-date2" class="form-label fw-bold">Choose Expense Date</label>
                            <input wire:model="expense_date" class="form-control form-control-lg"
                                placeholder="Select Expense Date" type="text" id="flatpickr-date2" required>
                        </div><br>


                        <label class="form-label w-100" for="modalAddValue">Expense Note(Optional)</label>
                        <div class="input-group input-group-merge">
                            <input wire:model='note' placeholder="Example: Money was released to John Doe"
                                class="form-control form-control-lg" type="text" aria-describedby="modalAllocate" />
                            <span class="input-group-text cursor-pointer p-1" id="modalAddCard2"><span
                                    class="card-type"></span></span>
                        </div><br>

                        <div class="col-12 text-center">
                            <button wire:click='save' type="button" class="btn btn-primary">
                                {{ 'Create' }}
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