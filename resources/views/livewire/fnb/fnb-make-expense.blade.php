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
        <div class="d-flex justify-content-between mb-2">
            <x-modal-home-create-button data-bs-target="#makeExpense">Make Expense </x-modal-home-create-button>
            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#expenseRecord">
                <i class="ti ti-printer"></i> Expense Record
            </button>
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
                        @foreach ($expenses as $expense)
                        <tr wire:key='{{$expense->id}}'>
                            <td>{{$loop->index + 1}}</td>
                            <td>{{$expense->expense_title}}</td>
                            <td>{{$expense->expense_code}}</td>
                            <td>{{(\App\Models\FnbExpCategory::where('id', $expense->category_id)->get()->value('category'))}}</td>
                            <td>{{(\App\Models\FnbExpItem::where('id', $expense->item_id)->get()->value('item'))}}</td>
                            <td>{{Helper::format_currency($expense->amount)}}</td>
                            <td>{{$expense->expense_date}}</td>
                            <td>
                                <small class="text-muted">
                                    <i class="badge bg-label-{{ $expense->list_flag == 1 ? 'success' : 'warning' }} ms-1">
                                        {{ $expense->list_flag == 1 ? 'Closed' : 'Open' }}
                                    </i>
                                </small>
                            </td>
                            <td>{{$expense->note}}</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="ti ti-dots-vertical"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a wire:click="expenseList({{ $expense->id }})" data-bs-toggle="modal" data-bs-target="#listExpense" class="dropdown-item" href="javascript:void(0);">
                                            <i class="ti ti-list me-1"></i> View Details
                                        </a>
                                        <a wire:click='destroy({{ $expense->id }})' wire:confirm="Are you sure you want to proceed and delete this expense?" class="dropdown-item" href="javascript:void(0);">
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

    <!--/ expense List Modal -->
    <div wire:ignore.self class="modal fade" id="listExpense" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-simple modal-add-new-cc modal-xl">
            <div class="modal-content">
                <div class="modal-body">
                    <button wire:click='exit' type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center mb-4">
                        <h4 class="mb-2"><x-home-page-label>Expense View</x-home-page-label></h4>
                    </div>
                    @if($list)
                        <div class="card mb-4">
                            <div class="table-responsive text-nowrap">
                                <table class="table table-striped table-bordered">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="fw-bold">Expense Title</th>
                                            <th class="fw-bold">Expense Code</th>
                                            <th class="fw-bold">Total Amount</th>
                                            <th class="fw-bold">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="fw-semibold text-primary">{{ $list->expense_title }}</td>
                                            <td><span class="badge bg-label-info">{{ $list->expense_code }}</span></td>
                                            <td><span class="fw-bold text-success fs-5">{{ Helper::format_currency($totalAmount) }}</span></td>
                                            <td>
                                                <small>
                                                    <i class="badge bg-label-{{ $list->list_flag == 1 ? 'success' : 'warning' }} ms-1">
                                                        {{ $list->list_flag == 1 ? 'Closed' : 'Open' }}
                                                    </i>
                                                </small>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                    @if($lists && $lists->count())
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Expense Details</h5>
                                <small class="text-muted">{{ $lists->count() }} {{ Str::plural('item', $lists->count()) }}</small>
                            </div>
                            <div class="table-responsive text-nowrap">
                                <table class="table table-striped table-bordered">
                                    <thead class="table-light">
                                        <tr>
                                            <th>SN</th>
                                            <th>Category</th>
                                            <th>Item</th>
                                            <th>Amount</th>
                                            <th>Date</th>
                                            <th>Note</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        @foreach($lists as $entry)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td><span class="badge bg-label-primary">{{ \App\Models\FnbExpCategory::find($entry->category_id)?->category }}</span></td>
                                                <td class="fw-semibold">{{ \App\Models\FnbExpItem::find($entry->item_id)?->item }}</td>
                                                <td><span class="fw-bold text-success">{{ Helper::format_currency($entry->amount) }}</span></td>
                                                <td><small class="text-muted">{{ \Carbon\Carbon::parse($entry->expense_date)->format('d M, Y') }}</small></td>
                                                <td><small>{{ $entry->note ?: 'No note' }}</small></td>
                                                <td>
                                                    <button wire:click="removeExpense({{ $entry->id }})" class="btn btn-sm btn-outline-danger" wire:confirm="Are you sure you want to remove this expense item?">
                                                        <i class="ti ti-trash me-1"></i> Remove
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @else
                        <div class="alert alert-info text-center mb-0">
                            <i class="ti ti-info-circle me-2"></i>
                            No expense items found
                        </div>
                    @endif
                    <div class="text-center mt-4">
                        <button wire:click="exit" type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                            <i class="ti ti-x me-1"></i> Close
                        </button>
                        @if($list && $list->list_flag == 0)
                            <button wire:click="closeExpense('{{ $list->expense_code }}')" type="button" class="btn btn-primary btn-reset" data-bs-dismiss="modal" wire:confirm="Are you sure you want to close this expense? This action cannot be undone;">
                                <i class="ti ti-lock me-1"></i> Close Expense
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
                    <button wire:click='exit' type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center mb-6">
                        <h4 class="mb-2"><x-home-page-label>{{ $modal_title }}</x-home-page-label></h4>
                    </div>
                    <form onsubmit="return false">
                        @csrf
                        <div class="col-12">
                            <label class="form-label w-100" for="modalAddValue">Expense Title</label>
                            <div class="input-group input-group-merge">
                                <input wire:model='expense_title' class="form-control form-control-lg" type="text" aria-describedby="modalexpense" />
                                <span class="input-group-text cursor-pointer p-1" id="modalAddCard2"><span class="card-type"></span></span>
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
                                <input wire:model='amount' class="form-control form-control-lg" type="text" aria-describedby="modalexpense" />
                                <span class="input-group-text cursor-pointer p-1" id="modalAddCard2"><span class="card-type"></span></span>
                            </div><br>
                            <label for="flatpickr-date2" class="form-label fw-bold">Choose Expense Date</label>
                            <input wire:model="expense_date" class="form-control form-control-lg" placeholder="Select Expense Date" type="text" id="flatpickr-date2" required>
                        </div><br>
                        <label class="form-label w-100" for="modalAddValue">Expense Note(Optional)</label>
                        <div class="input-group input-group-merge">
                            <input wire:model='note' placeholder="Example: Money was released to John Doe" class="form-control form-control-lg" type="text" aria-describedby="modalAllocate" />
                            <span class="input-group-text cursor-pointer p-1" id="modalAddCard2"><span class="card-type"></span></span>
                        </div><br>
                        <div class="col-12 text-center">
                            <button wire:click='save' type="button" class="btn btn-primary">{{ 'Create' }}</button>
                            <button wire:click='exit' type="button" class="btn btn-label-secondary btn-reset" data-bs-dismiss="modal">Cancel</button>
                            @php
                                $openExpense = $expenses->firstWhere('list_flag', 0);
                            @endphp
                            @if ($openExpense)
                                <div class="col-12 text-center mt-3">
                                    <a wire:click="expenseList({{ $openExpense->id }})" data-bs-toggle="modal" data-bs-target="#listExpense" class="btn btn-outline-info">
                                        <i class="ti ti-list me-1"></i> View Expense List
                                    </a>
                                </div>
                            @endif
                            <x-app-loader></x-app-loader>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Expense Record Modal -->
    <div wire:ignore.self class="modal fade" id="expenseRecord" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header print-hide">
                    <h5 class="modal-title">
                        <i class="ti ti-file-text me-2"></i>Expense Record Report
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Filter Section -->
                    <div class="row mb-4 print-hide">
                        <div class="col-md-4">
                            <label class="form-label">From Date</label>
                            <input wire:model.live="expenseFromDate" type="date" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">To Date</label>
                            <input wire:model.live="expenseToDate" type="date" class="form-control">
                        </div>
                        <div class="col-md-4 d-flex align-items-end">
                            <button wire:click="refreshExpenseData" class="btn btn-primary">
                                <i class="ti ti-refresh me-1"></i>Refresh
                            </button>
                            <button type="button" class="btn btn-success ms-2" id="printExpenseReportBtn">
                                <i class="ti ti-printer me-1"></i>Print
                            </button>
                        </div>
                    </div>

                    <!-- Expense Report Content -->
                    <div id="printable-expense-content">
                        <div class="table-responsive text-nowrap">
                            <table class="table table-bordered mb-3" style="margin-bottom: 20px;">
                                <tbody>
                                    <tr>
                                        <td colspan="4" class="text-center" style="background-color: #f8f9fa; font-weight: bold; font-size: 18px; padding: 12px;">
                                            VINE INTERNATIONAL SUITES AND RESORTS
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="text-center" style="background-color: #f8f9fa; font-weight: bold; font-size: 16px; padding: 10px;">
                                            EXPENSE RECORD REPORT
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: bold; width: 25%; padding: 8px;">From Date:</td>
                                        <td style="width: 25%; padding: 8px;">{{ $expenseFromDate ?? 'All Time' }}</td>
                                        <td style="font-weight: bold; width: 25%; padding: 8px;">To Date:</td>
                                        <td style="width: 25%; padding: 8px;">{{ $expenseToDate ?? 'All Time' }}</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: bold; padding: 8px;">Generated On:</td>
                                        <td style="padding: 8px;">{{ \Carbon\Carbon::now()->format('Y-m-d H:i:s') }}</td>
                                        <td style="font-weight: bold; padding: 8px;">Total Records:</td>
                                        <td style="padding: 8px;">{{ !empty($expenseData) ? count($expenseData) : 0 }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        @if(!empty($expenseData))
                            <div class="table-responsive text-nowrap">
                                <table class="table table-bordered table-striped">
                                     <thead style="background-color: #343a40; color: white;">
                                        <tr>
                                            <th  style="padding: 10px; text-align: center;"><font color="white">SN</font></th>
                                            <th style="padding: 10px;"><font color="white">Expense Code</font></th>
                                            <th style="padding: 10px;"><font color="white">Expense Title</font></th>
                                            <th style="padding: 10px;"><font color="white">Category</font></th>
                                            <th style="padding: 10px;"><font color="white">Item</font></th>
                                            <th style="padding: 10px;"><font color="white">Date</font></th>
                                            <th style="padding: 10px; text-align: right;"><font color="white">Amount</font></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($expenseData as $index => $expense)
                                            <tr>
                                                <td style="padding: 8px; text-align: center;">{{ $index + 1 }}</td>
                                                <td style="padding: 8px;">{{ $expense->expense_code }}</td>
                                                <td style="padding: 8px;">{{ $expense->expense_title }}</td>
                                                <td style="padding: 8px;">{{ \App\Models\FnbExpCategory::find($expense->category_id)?->category }}</td>
                                                <td style="padding: 8px;">{{ \App\Models\FnbExpItem::find($expense->item_id)?->item }}</td>
                                                <td style="padding: 8px;">{{ \Carbon\Carbon::parse($expense->expense_date)->format('Y-m-d') }}</td>
                                                <td style="padding: 8px; text-align: right;">{{ Helper::format_currency($expense->amount) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="table-responsive text-nowrap">
                                <table class="table table-bordered mt-4" style="margin-top: 20px;">
                                    <tbody>
                                        <tr style="background-color: #f8f9fa;">
                                            <td style="font-weight: bold; padding: 10px; width: 25%;">Total Expenses:</td>
                                            <td style="padding: 10px; width: 25%;">{{ count($expenseData) }}</td>
                                            <td style="font-weight: bold; padding: 10px; width: 25%;">Grand Total:</td>
                                            <td style="padding: 10px; width: 25%;">{{ Helper::format_currency($expenseData->sum('amount')) }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="alert alert-info text-center" style="margin: 20px 0; padding: 20px;">
                                <i class="ti ti-info-circle me-2"></i>No expense records found for the selected period.
                            </div>
                        @endif
                    </div>
                </div>
                <div class="modal-footer print-hide">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" id="printExpenseReportBtn2">
                        <i class="ti ti-printer me-1"></i>Print Report
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Print Styles -->
    <style>
    @media screen {
        .print-only {
            display: none !important;
        }
    }
    @media print {
        * {
            margin: 0 !important;
            padding: 0 !important;
            box-sizing: border-box !important;
        }
        html, body {
            margin: 0 !important;
            padding: 0 !important;
            height: auto !important;
            width: 100% !important;
            background: white !important;
            font-family: Arial, sans-serif !important;
            font-size: 12px !important;
            line-height: 1.4 !important;
        }
        body * {
            visibility: hidden !important;
        }
        #printable-expense-content,
        #printable-expense-content * {
            visibility: visible !important;
        }
        .print-hide,
        .modal-header,
        .modal-footer,
        .btn,
        button,
        input,
        .form-control,
        .form-label,
        .row.mb-4,
        .modal-backdrop {
            display: none !important;
            visibility: hidden !important;
        }
        #printable-expense-content {
            position: absolute !important;
            top: 0 !important;
            left: 0 !important;
            right: 0 !important;
            width: 100% !important;
            margin: 0 !important;
            padding: 10px !important;
            background: white !important;
        }
        .modal,
        .modal-dialog,
        .modal-content,
        .modal-body {
            position: static !important;
            transform: none !important;
            margin: 0 !important;
            padding: 0 !important;
            width: 100% !important;
            height: auto !important;
            background: transparent !important;
            border: none !important;
            box-shadow: none !important;
        }
        table {
            width: 100% !important;
            border-collapse: collapse !important;
            margin: 5px 0 !important;
            font-size: 11px !important;
        }
        th, td {
            border: 1px solid #000 !important;
            text-align: left !important;
            vertical-align: top !important;
            font-size: 10px !important;
            line-height: 1.3 !important;
        }
        table:first-child td {
            padding: 6px 8px !important;
        }
        thead th {
            background-color: #000 !important;
            color: white !important;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
            font-weight: bold !important;
            padding: 6px 4px !important;
        }
        tbody td {
            padding: 4px 6px !important;
        }
        [style*="background-color: #f8f9fa"] {
            background-color: #f0f0f0 !important;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }
        @page {
            margin: 0.4in !important;
            size: A4 portrait !important;
        }
        table {
            page-break-inside: auto !important;
        }
        tr {
            page-break-inside: avoid !important;
            page-break-after: auto !important;
        }
        thead {
            display: table-header-group !important;
        }
        .alert {
            border: 2px solid #ccc !important;
            padding: 15px !important;
            margin: 10px 0 !important;
            background-color: #f0f8ff !important;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }
    }
    </style>

    <!-- Print Script -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        function printExpenseReport() {
            window.print();
        }
        const printExpenseBtn1 = document.getElementById('printExpenseReportBtn');
        const printExpenseBtn2 = document.getElementById('printExpenseReportBtn2');
        if (printExpenseBtn1) {
            printExpenseBtn1.addEventListener('click', function(e) {
                e.preventDefault();
                printExpenseReport();
            });
        }
        if (printExpenseBtn2) {
            printExpenseBtn2.addEventListener('click', function(e) {
                e.preventDefault();
                printExpenseReport();
            });
        }
    });
    </script>
</div>