<div>
    <x-input-error-messages />

    <div class="container-xxl flex-grow-1 container-p-y">
        <div>
            <x-home-page-label>Manage Kitchen Store</x-home-page-label>
        </div>
        <div class="d-flex justify-content-between mb-2">
            <x-modal-home-create-button data-bs-target="#addItem">Add Item</x-modal-home-create-button>
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deductItem">
                <i class="ti ti-minus"></i> Deduct Item
            </button>
            
            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#storeLog">
                <i class="ti ti-clipboard-list"></i> Store Log
            </button>
            
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#storeReport">
                <i class="ti ti-report"></i> Store Report
            </button>
        </div>
        <hr class="my-2">
        <div class="card">
            <div class="table-responsive text-nowrap">
                <table id="myTable" class="table table-responsive">
                    <thead class="table-light">
                        <tr>
                            <th class="text-nowrap">SN</th>
                            <th class="text-nowrap">Item</th>
                            <th class="text-nowrap">Quantity</th>
                            <th class="text-nowrap">Last Updated</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($inventory as $inv)
                            <tr wire:key='{{ $inv->id }}'>
                             <td class="text-nowrap">{{ $inv->item->item }}</td>
                                <td class="text-nowrap">{{ $inv->item->item }}</td>
                                <td class="text-nowrap">{{ $inv->quantity }} {{ $inv->item->measurement_tag ?? '' }} of {{ $inv->item->item }}</td>
                                <td class="text-nowrap">{{ $inv->last_updated }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add Item Modal -->
    <div wire:ignore.self class="modal fade" id="addItem" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-simple modal-add-new-cc">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center mb-4">
                         <h4 class="mb-2"><x-home-page-label>Add Item to Store</x-home-page-label></h4>
                      
                    </div>
                    <form onsubmit="return false">
                        @csrf
                        <div class="mb-3">
                            <label for="itemSelect" class="form-label">Select Item</label>
                            <select wire:model="selectedItem" class="form-select" id="itemSelect">
                                <option value="">Select Item</option>
                                @foreach ($items as $item)
                                    <option value="{{ $item->id }}">{{ $item->item }} ({{ $item->measurement_tag ?? 'N/A' }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="quantity" class="form-label">Quantity</label>
                            <input wire:model="quantity" type="number" class="form-control" id="quantity" placeholder="Enter quantity">
                        </div>
                        <div class="text-center">
                            <button wire:click="addToStore" type="button" class="btn btn-primary">Add</button>
                            <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Deduct Item Modal -->
    <div wire:ignore.self class="modal fade" id="deductItem" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-simple modal-add-new-cc">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center mb-4">
                       <h4 class="mb-2"><x-home-page-label>Deduct Item from Store</x-home-page-label></h4>
                    </div>
                    <form onsubmit="return false">
                        @csrf
                        <div class="mb-3">
                            <label for="itemSelectDeduct" class="form-label">Select Item</label>
                            <select wire:model="selectedItemDeduct" class="form-select" id="itemSelectDeduct">
                                <option value="">Select Item</option>
                                @foreach ($items as $item)
                                    <option value="{{ $item->id }}">{{ $item->item }} ({{ $item->measurement_tag ?? 'N/A' }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="quantityDeduct" class="form-label">Quantity</label>
                            <input wire:model="quantityDeduct" type="number" class="form-control" id="quantityDeduct" placeholder="Enter quantity">
                        </div>
                        <div class="text-center">
                            <button wire:click="deductFromStore" type="button" class="btn btn-primary">Deduct</button>
                            <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Store Log Modal -->
    <div wire:ignore.self class="modal fade" id="storeLog" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header print-hide">
                    <h5 class="modal-title">
                        <i class="ti ti-file-text me-2"></i>Store Activity Log
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Filter Section -->
                    <div class="row mb-4 print-hide">
                        <div class="col-md-4">
                            <label class="form-label">From Date</label>
                            <input wire:model="logFromDate" type="date" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">To Date</label>
                            <input wire:model="logToDate" type="date" class="form-control">
                        </div>
                        <div class="col-md-4 d-flex align-items-end">
                            <button wire:click="filterLogs" class="btn btn-primary">
                                <i class="ti ti-refresh me-1"></i>Filter
                            </button>
                            <button type="button" class="btn btn-success ms-2" id="printLogBtn">
                                <i class="ti ti-printer me-1"></i>Print
                            </button>
                        </div>
                    </div>

                    <!-- Log Content -->
                    <div id="printable-log-content">
                        <table class="table table-bordered mb-3" style="margin-bottom: 20px;">
                            <tbody>
                                <tr>
                                    <td colspan="8" class="text-center" style="background-color: #f8f9fa; font-weight: bold; font-size: 18px; padding: 12px;">
                                        VINE INTERNATIONAL SUITES AND RESORTS
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="8" class="text-center" style="background-color: #f8f9fa; font-weight: bold; font-size: 16px; padding: 10px;">
                                        STORE ACTIVITY LOG
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold; width: 25%; padding: 8px;">From Date:</td>
                                    <td style="width: 25%; padding: 8px;">{{ $logFromDate ?? 'Today' }}</td>
                                    <td style="font-weight: bold; width: 25%; padding: 8px;">To Date:</td>
                                    <td style="width: 25%; padding: 8px;">{{ $logToDate ?? 'Today' }}</td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold; padding: 8px;">Generated On:</td>
                                    <td style="padding: 8px;">{{ \Carbon\Carbon::now()->format('Y-m-d H:i:s') }}</td>
                                    <td style="font-weight: bold; padding: 8px;">Total Records:</td>
                                    <td style="padding: 8px;">{{ count($logs) }}</td>
                                </tr>
                            </tbody>
                        </table>

                        @if(count($logs))
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-responsive">
                                    <thead style="background-color: #343a40; color: white;">
                                        <tr>
                                            <th class="text-nowrap" style="padding: 10px; text-align: center;"><span style="color: white;">SN</span></th>
                                            <th class="text-nowrap" style="padding: 10px;"><span style="color: white;">Action</span></th>
                                            <th class="text-nowrap" style="padding: 10px;"><span style="color: white;">Staff</span></th>
                                            <th class="text-nowrap" style="padding: 10px;"><span style="color: white;">Item</span></th>
                                            <th class="text-nowrap" style="padding: 10px; text-align: right;"><span style="color: white;">Quantity Changed</span></th>
                                            <th class="text-nowrap" style="padding: 10px; text-align: right;"><span style="color: white;">Quantity Before</span></th>
                                            <th class="text-nowrap" style="padding: 10px; text-align: right;"><span style="color: white;">Quantity After</span></th>
                                            <th class="text-nowrap" style="padding: 10px;"><span style="color: white;">Timestamp</span></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($logs as $index => $log)
                                            <tr>
                                                <td class="text-nowrap" style="padding: 8px; text-align: center;">{{ $index + 1 }}</td>
                                                <td class="text-nowrap" style="padding: 8px;">{{ $log->action === 'add' ? 'Item Added' : 'Item Removed' }}</td>
                                                <td class="text-nowrap" style="padding: 8px;">{{ $log->user->name ?? 'N/A' }}</td>
                                                <td class="text-nowrap" style="padding: 8px;">{{ $log->item->item }}</td>
                                                <td class="text-nowrap" style="padding: 8px; text-align: right;">{{ $log->quantity_changed }} {{ $log->item->measurement_tag ?? '' }}</td>
                                                <td class="text-nowrap" style="padding: 8px; text-align: right;">{{ $log->quantity_before }} {{ $log->item->measurement_tag ?? '' }}</td>
                                                <td class="text-nowrap" style="padding: 8px; text-align: right;">{{ $log->quantity_after }} {{ $log->item->measurement_tag ?? '' }}</td>
                                                <td class="text-nowrap" style="padding: 8px;">{{ \Carbon\Carbon::parse($log->timestamp)->format('Y-m-d H:i:s') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <table class="table table-bordered mt-4" style="margin-top: 20px;">
                                <tbody>
                                    <tr style="background: #f8f9fa;">
                                        <td style="font-weight: bold; padding: 10px; width: 25%;">Total Additions:</td>
                                        <td style="padding: 10px; width: 25%;">{{ $logTotalAdditions }}</td>
                                        <td style="font-weight: bold; padding: 10px; width: 25%;">Total Deductions:</td>
                                        <td style="padding: 10px; width: 25%;">{{ $logTotalDeductions }}</td>
                                    </tr>
                                    <tr style="background: #d4edda;">
                                        <td colspan="3" style="font-weight: bold; padding: 12px; text-align: right; font-size: 16px;">
                                            NET CHANGE:
                                        </td>
                                        <td style="font-weight: bold; padding: 12px; text-align: right; font-size: 16px; color: #155724;">
                                            {{ $logNetChange }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        @else
                            <div class="alert alert-info text-center" style="margin: 20px 0; padding: 20px;">
                                <i class="ti ti-info-circle me-2"></i>No store activity logs found for the selected period.
                            </div>
                        @endif
                    </div>
                </div>
                <div class="modal-footer print-hide">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" id="printLogBtn2">
                        <i class="ti ti-printer me-1"></i>Print Log
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Store Report Modal -->
    <div wire:ignore.self class="modal fade" id="storeReport" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header print-hide">
                    <h5 class="modal-title">
                        <i class="ti ti-file-text me-2"></i>Store Activity Report
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Filter Section -->
                    <div class="row mb-4 print-hide">
                        <div class="col-md-4">
                            <label class="form-label">From Date</label>
                            <input wire:model="reportFromDate" type="date" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">To Date</label>
                            <input wire:model="reportToDate" type="date" class="form-control">
                        </div>
                        <div class="col-md-4 d-flex align-items-end">
                            <button wire:click="generateReport" class="btn btn-primary">
                                <i class="ti ti-refresh me-1"></i>Generate
                            </button>
                            <button type="button" class="btn btn-success ms-2" id="printReportBtn">
                                <i class="ti ti-printer me-1"></i>Print
                            </button>
                        </div>
                    </div>

                    <!-- Report Content -->
                    <div id="printable-content">
                        <table class="table table-bordered mb-3" style="margin-bottom: 20px;">
                            <tbody>
                                <tr>
                                    <td colspan="7" class="text-center" style="background-color: #f8f9fa; font-weight: bold; font-size: 18px; padding: 12px;">
                                        VINE INTERNATIONAL SUITES AND RESORTS
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="7" class="text-center" style="background-color: #f8f9fa; font-weight: bold; font-size: 16px; padding: 10px;">
                                        STORE ACTIVITY REPORT
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold; width: 25%; padding: 8px;">From Date:</td>
                                    <td style="width: 25%; padding: 8px;">{{ $reportFromDate ?? 'All Time' }}</td>
                                    <td style="font-weight: bold; width: 25%; padding: 8px;">To Date:</td>
                                    <td style="width: 25%; padding: 8px;">{{ $reportToDate ?? 'All Time' }}</td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold; padding: 8px;">Generated On:</td>
                                    <td style="padding: 8px;">{{ \Carbon\Carbon::now()->format('Y-m-d H:i:s') }}</td>
                                    <td style="font-weight: bold; padding: 8px;">Total Records:</td>
                                    <td style="padding: 8px;">{{ count($reportData) }}</td>
                                </tr>
                            </tbody>
                        </table>

                        @if(count($reportData))
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-responsive">
                                    <thead style="background-color: #343a40; color: white;">
                                        <tr>
                                            <th class="text-nowrap" style="padding: 10px; text-align: center;"><span style="color: white;">SN</span></th>
                                            <th class="text-nowrap" style="padding: 10px;"><span style="color: white;">Action</span></th>
                                            <th class="text-nowrap" style="padding: 10px;"><span style="color: white;">Item</span></th>
                                            <th class="text-nowrap" style="padding: 10px; text-align: right;"><span style="color: white;">Quantity Changed</span></th>
                                            <th class="text-nowrap" style="padding: 10px; text-align: right;"><span style="color: white;">Quantity Before</span></th>
                                            <th class="text-nowrap" style="padding: 10px; text-align: right;"><span style="color: white;">Quantity After</span></th>
                                            <th class="text-nowrap" style="padding: 10px;"><span style="color: white;">Timestamp</span></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($reportData as $index => $log)
                                            <tr>
                                                <td class="text-nowrap" style="padding: 8px; text-align: center;">{{ $index + 1 }}</td>
                                                <td class="text-nowrap" style="padding: 8px;">{{ $log->action === 'add' ? 'Item Added' : 'Item Removed' }}</td>
                                                <td class="text-nowrap" style="padding: 8px;">{{ $log->item->item }}</td>
                                                <td class="text-nowrap" style="padding: 8px; text-align: right;">{{ $log->quantity_changed }} {{ $log->item->measurement_tag ?? '' }}</td>
                                                <td class="text-nowrap" style="padding: 8px; text-align: right;">{{ $log->quantity_before }} {{ $log->item->measurement_tag ?? '' }}</td>
                                                <td class="text-nowrap" style="padding: 8px; text-align: right;">{{ $log->quantity_after }} {{ $log->item->measurement_tag ?? '' }}</td>
                                                <td class="text-nowrap" style="padding: 8px;">{{ \Carbon\Carbon::parse($log->timestamp)->format('Y-m-d H:i:s') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <table class="table table-bordered mt-4" style="margin-top: 20px;">
                                <tbody>
                                    <tr style="background: #f8f9fa;">
                                        <td style="font-weight: bold; padding: 10px; width: 25%;">Total Additions:</td>
                                        <td style="padding: 10px; width: 25%;">{{ $totalAdditions }}</td>
                                        <td style="font-weight: bold; padding: 10px; width: 25%;">Total Deductions:</td>
                                        <td style="padding: 10px; width: 25%;">{{ $totalDeductions }}</td>
                                    </tr>
                                    <tr style="background: #d4edda;">
                                        <td colspan="3" style="font-weight: bold; padding: 12px; text-align: right; font-size: 16px;">
                                            NET CHANGE:
                                        </td>
                                        <td style="font-weight: bold; padding: 12px; text-align: right; font-size: 16px; color: #155724;">
                                            {{ $netChange }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        @else
                            <div class="alert alert-info text-center" style="margin: 20px 0; padding: 20px;">
                                <i class="ti ti-info-circle me-2"></i>No store activity records found for the selected period.
                            </div>
                        @endif
                    </div>
                </div>
                <div class="modal-footer print-hide">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" id="printReportBtn2">
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
        
        /* Enhanced responsive table styles */
        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }
        
        @media (max-width: 768px) {
            .table-responsive table {
                font-size: 0.85rem;
            }
            
            .table-responsive th,
            .table-responsive td {
                padding: 6px 4px !important;
                white-space: nowrap;
            }
            
            .modal-xl {
                max-width: 95%;
            }
            
            .container-xxl {
                padding: 10px;
            }
            
            .d-flex.justify-content-between {
                flex-wrap: wrap;
                gap: 10px;
            }
            
            .btn {
                font-size: 0.8rem;
                padding: 6px 12px;
            }
        }
        
        @media (max-width: 576px) {
            .table-responsive table {
                font-size: 0.75rem;
            }
            
            .table-responsive th,
            .table-responsive td {
                padding: 4px 2px !important;
            }
            
            .modal-xl {
                max-width: 98%;
                margin: 5px;
            }
            
            .btn {
                font-size: 0.7rem;
                padding: 4px 8px;
            }
            
            .form-control {
                font-size: 0.85rem;
            }
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
        #printable-content,
        #printable-content *,
        #printable-log-content,
        #printable-log-content * {
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
        #printable-content,
        #printable-log-content {
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
            background: #000 !important;
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
            background: #f0f0f0 !important;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }
        [style*="background: #f8f9fa"] {
            background: #f0f0f0 !important;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }
        [style*="background: #d4edda"] {
            background: #e6f4e6 !important;
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
            background: #f0f8ff !important;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }
    }
    </style>

    <!-- Print Script -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        function printContent(id) {
            const content = document.getElementById(id);
            if (content) {
                window.print();
            }
        }
        const printReportBtn1 = document.getElementById('printReportBtn');
        const printReportBtn2 = document.getElementById('printReportBtn2');
        const printLogBtn1 = document.getElementById('printLogBtn');
        const printLogBtn2 = document.getElementById('printLogBtn2');
        if (printReportBtn1) {
            printReportBtn1.addEventListener('click', function(e) {
                e.preventDefault();
                printContent('printable-content');
            });
        }
        if (printReportBtn2) {
            printReportBtn2.addEventListener('click', function(e) {
                e.preventDefault();
                printContent('printable-content');
            });
        }
        if (printLogBtn1) {
            printLogBtn1.addEventListener('click', function(e) {
                e.preventDefault();
                printContent('printable-log-content');
            });
        }
        if (printLogBtn2) {
            printLogBtn2.addEventListener('click', function(e) {
                e.preventDefault();
                printContent('printable-log-content');
            });
        }
    });
    </script>
</div>