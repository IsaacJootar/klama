@php
use App\Http\Helpers\Helper;
@endphp
<div>
<x-input-error-messages />

    <div class="container-xxl flex-grow-1 container-p-y">
        <div>
            <x-home-page-label>Make, Update and Delete Restaurant Orders Here</x-home-page-label>
        </div>
<div class="d-flex justify-content-between mb-2">
    {{-- Make Order Button - Made bigger and bolder --}}
    <x-modal-home-create-button data-bs-target="#makeOrder" class="btn-lg fw-bold">
        Make Order
    </x-modal-home-create-button>

   {{-- Sales Record Button - Made bigger and bolder --}}
<button type="button" class="btn btn-info btn-lg fw-bold" data-bs-toggle="modal" data-bs-target="#salesRecord">
  <i class=" ti ti-printer"> </i> Sales Record
</button>

</div>

        <hr class="my-2">
        <div class="card">
            <div class="table-responsive text-nowrap">
                <table id="myTable" class="table">
                    <thead class="table-light">
                        <tr>
                            <th>SN</th>
                            <th>Menu</th>
                            <th>Order Code</th>
                            <th>Order Date</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($orders as $order)
                            <tr wire:key='{{ $order->id }}'>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $order->order_name }}</td>
                                <td>{{ $order->order_code }}</td>
                                <td>{{ $order->order_date }}</td>
                                <td>{{ $order->category }}</td>
                                <td>{{ $order->price }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown"><i class="ti ti-dots-vertical"></i></button>
                                        <div class="dropdown-menu">
                                            <a wire:click="checkDeletePermission({{ $order->id }})"
                                           class="dropdown-item" href="javascript:void(0);">
                                            <i class="ti ti-trash me-1"></i> Delete Order
                                        </a>
                                        <a wire:click="showReceipt({{ $order->id }})"
                                           class="dropdown-item" href="javascript:void(0);"
                                           data-bs-toggle="modal" data-bs-target="#receiptModal">
                                            <i class="ti ti-printer me-1"></i> View Receipt
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

    <div wire:ignore.self class="modal fade" id="makeOrder" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-fullscreen">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <button wire:click="exit" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center mt-4 mb-3">
                        <h4 class="mb-2"><x-home-page-label>Make Orders</x-home-page-label></h4>
                    </div>

                    <div class="d-flex h-100">
                        <div class="col-md-5 p-4 border-end border-2">
                            <h5 class="mb-4">Select or Menu Items</h5>
                            <form onsubmit="return false;">
                                @csrf
                                <div class="mb-3" x-data="autocomplete">
                                    <label for="orderName" class="form-label">Menu Item</label>
                                    <select wire:model="order_name" id="orderName" class="form-select form-select-lg" x-ref="select">
                                        <option value="">--Select Menu--</option>
                                        @foreach ($menus as $menu)
                                            <option value="{{ $menu->name }}">{{ $menu->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label w-100" for="quantity">Quantity</label>
                                    <div class="input-group input-group-merge">
                                        <input wire:model="quantity" class="form-control form-control-lg" type="number" min="1" id="quantity" />
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label for="flatpickr-date2" class="form-label fw-bold">Order Date</label>
                                    <input wire:model="order_date" class="form-control form-control-lg"
                                           placeholder="Select Order Date" type="text" id="flatpickr-date2" required>
                                </div>
                                <div class="text-center">
                                    {{-- Add to Cart button - Made bigger and bolder, with icon --}}
                                    <button wire:click="addToCart" type="button" class="btn btn-primary btn-lg me-2 fw-bold">
                                        <i class="ti ti-shopping-cart-plus me-1"></i> Add to Cart
                                    </button>
                                    {{-- Close button changed to black, made bigger and bolder, with icon --}}
                                    <button wire:click="exit" type="button" class="btn btn-dark btn-lg fw-bold" data-bs-dismiss="modal">
                                        <i class="ti ti-x me-1"></i> Close
                                    </button>
                                    <x-app-loader></x-app-loader>
                                </div>
                            </form>
                        </div>

                        <div class="col-md-7 p-4">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h5 class="mb-0">Order Cart (ID: <span class="text-info">{{ $order_code }}</span>)</h5>
                                {{-- Refresh button added here --}}
                                <button wire:click="refreshCart" class="btn btn-outline-secondary btn-sm" title="Refresh Cart">
                                    <i class="ti ti-refresh"></i>
                                </button>
                            </div>
                            @if (!empty($cart))
                                <div class="table-responsive text-nowrap mb-3" style="max-height: 400px; overflow-y: auto;">
                                    <table class="table table-striped table-bordered">
                                        {{-- Cart table header changed to table-dark --}}
                                        <thead class="table-dark">
                                            <tr>
                                                <th style="width: 5%;">SN</th>
                                                <th style="width: 35%;">Menu</th>
                                                <th style="width: 15%;">Qty</th>
                                                <th style="width: 25%;">Price</th>
                                                <th style="width: 20%;">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                       @foreach ($cart as $item)
    <tr wire:key="{{ $item['cart_item_id'] ?? $loop->index }}">
        <td>{{ $loop->index + 1 }}</td>
        <td>{{ $item['order_name'] ?? 'N/A' }}</td>
        <td>
            <input type="number" min="1" value="{{ $item['quantity'] ?? 1 }}" {{-- REMOVED wire:model, ADDED value --}}
                   wire:change="updateCartItem('{{ $item['cart_item_id'] ?? '' }}', $event.target.value)"
                   class="form-control form-control-sm" style="width: 65px;">
        </td>
        <td>{{ Helper::format_currency($item['price'] ?? 0) }}</td>
        <td>
            <button wire:click="removeFromCart('{{ $item['cart_item_id'] ?? '' }}')"
                    class="btn btn-danger btn-xs py-1 px-2">Remove</button>
        </td>
    </tr>
@endforeach               </tbody>
                                    </table>
                                </div>

                                <div class="card mb-4">
                                    <div class="table-responsive text-nowrap">
                                      <table class="table table-striped table-bordered">
                                        {{-- Total Amount header changed to table-dark --}}
                                        <thead class="table-dark">
                                          <tr>
                                            <th class="fw-bold text-end">Total Amount:</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <tr>
                                            <td class="text-end">
                                              <span class="fw-bold text-success fs-5">{{ Helper::format_currency($totalAmount) }}</span>
                                            </td>
                                          </tr>
                                        </tbody>
                                      </table>
                                    </div>
                                  </div>
                                <div class="d-flex justify-content-center gap-2 mb-5"> {{-- Added mb-5 here --}}
                                    {{-- Cart action buttons - Changed to standard btn btn-*, made bigger and bolder, with icons --}}
                                    <button wire:click="clearCart" class="btn btn-danger btn-lg fw-bold">
                                        <i class="ti ti-trash me-1"></i> Clear Cart
                                    </button>
                                    <button wire:click="submitOrder" class="btn btn-primary btn-lg fw-bold" data-bs-dismiss="modal">
                                        <i class="ti ti-check me-1"></i> Submit Order
                                    </button>
                                    <button wire:click="submitAndPrint" class="btn btn-success btn-lg fw-bold" data-bs-dismiss="modal">
                                        <i class="ti ti-printer me-1"></i> Submit and Print
                                    </button>
                                </div>
                            @else
                                <div class="alert alert-info text-center mb-0 mt-5">Cart is empty</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" id="receiptModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-simple modal-add-new-cc modal-xl">
            <div class="modal-content">
                <div class="modal-body">
                    <button wire:click="closeReceiptModal" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center mb-4">
                        <h4 class="mb-2"><x-home-page-label>Order Receipt</x-home-page-label></h4>
                    </div>

                    @if (!empty($receiptItems))
                        <div class="card mb-4">
                            <div class="table-responsive text-nowrap">
                                <table class="table table-striped table-bordered">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="fw-bold">Order Code</th>
                                            <th class="fw-bold">Total Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <span class="badge bg-label-info">{{ $receiptOrderCode }}</span>
                                            </td>
                                            <td>
                                                <span class="fw-bold text-success fs-5">{{ Helper::format_currency($receiptTotalAmount) }}</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="table-responsive text-nowrap">
                            <table class="table table-striped table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th>SN</th>
                                        <th>Menu</th>
                                        <th>Quantity</th>
                                        <th>Category</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($receiptItems as $item)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $item['order_name'] ?? 'N/A' }}</td>
                                            <td>{{ $item['quantity'] ?? 1 }}</td>
                                            <td>{{ $item['category'] ?? 'N/A' }}</td>
                                            <td>{{ Helper::format_currency($item['price'] ?? 0) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="text-center mt-3">
                            <button wire:click="printReceipt" class="btn btn-label-success">Print Receipt</button>
                        </div>
                    @else
                        <div class="alert alert-info text-center mb-0">No receipt items found.</div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Thermal print template --}}
    @if ($showReceiptModal || $printOrder)
    <div id="print-receipt" style="display: none;">
        <div style="font-family: 'Courier New', monospace; font-size: 12px; width: 80mm; text-align: center; line-height: 1.2; margin: 0; padding: 2mm;">
            <div style="font-weight: bold; margin-bottom: 8px; font-size: 14px;">Vine International Suites and Resorts</div>
            <div style="margin-bottom: 6px; font-size: 12px;">Order Receipt</div>
            <div style="margin-bottom: 4px;">Order Code: {{ $showReceiptModal ? $receiptOrderCode : $printOrderCode }}</div>
            <div style="margin-bottom: 6px;">Date: {{ \Carbon\Carbon::now()->format('Y-m-d H:i:s') }}</div>
            <div style="margin: 6px 0; border-top: 1px dashed #000; width: 100%;"></div>

            <div style="text-align: left; width: 100%;">
                @foreach ($showReceiptModal ? $receiptItems : $printCart as $item)
                <div style="margin: 4px 0 2px 0;">
                    <span style="font-weight: bold;">{{ Str::limit($item['order_name'], 25) }}</span>
                </div>
                <div style="margin: 0 0 6px 0;">
                    <span style="float: left;">{{ $item['quantity'] }} x {{ Helper::format_currency($item['price'] / $item['quantity']) }}</span>
                    <span style="float: right;">{{ Helper::format_currency($item['price']) }}</span>
                    <div style="clear: both;"></div>
                </div>
                @endforeach
            </div>

            <div style="margin: 8px 0; border-top: 1px dashed #000; width: 100%;"></div>

            <div style="text-align: right; font-weight: bold; font-size: 14px; margin: 8px 0;">
                Total: {{ Helper::format_currency($showReceiptModal ? $receiptTotalAmount : $printTotalAmount) }}
            </div>

            <div style="margin: 8px 0; border-top: 1px dashed #000; width: 100%;"></div>

            <div style="text-align: center; margin: 8px 0;">Thank you for your order!</div>
            <div style="font-size: 9px; margin-top: 8px; text-align: center;">Powered with ❤️ by KlickitSystems</div>
        </div>
    </div>

    <style>
    @media print {
        body * {
            visibility: hidden !important;
            margin: 0 !important;
            padding: 0 !important;
        }

        #print-receipt, #print-receipt * {
            visibility: visible !important;
            display: block !important;
        }

        #print-receipt {
            position: absolute !important;
            left: 0 !important;
            top: 0 !important;
            width: 80mm !important;
            font-family: 'Courier New', monospace !important;
            font-size: 12px !important;
            line-height: 1.2 !important;
            background: white !important;
            color: black !important;
            margin: 0 !important;
            padding: 2mm !important;
        }

        /* Clear floats properly */
        #print-receipt div:after {
            content: "";
            display: table;
            clear: both;
        }

        /* Ensure proper spacing */
        #print-receipt > div > div {
            margin: 2px 0 !important;
            padding: 0 !important;
        }

        @page {
            margin: 0 !important;
            size: 80mm auto !important;
        }
    }
    </style>
    @endif

    {{-- Sales Record Modal --}}
    <div wire:ignore.self class="modal fade" id="salesRecord" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header print-hide">
                    <h5 class="modal-title">
                        <i class="ti ti-file-text me-2"></i>Sales Record Report
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-4 print-hide">
                        <div class="col-md-4">
                            <label class="form-label">From Date</label>
                            <input wire:model.live="salesFromDate" type="date" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">To Date</label>
                            <input wire:model.live="salesToDate" type="date" class="form-control">
                        </div>
                       <div class="col-md-4 d-flex align-items-end">
    <button wire:click="refreshSalesData" class="btn btn-primary btn-sm">
        <i class="ti ti-refresh me-1"></i>Refresh
    </button>
    <button type="button" class="btn btn-success btn-sm ms-2" id="printReportBtn">
        <i class="ti ti-printer me-1"></i>Print
    </button>
</div>

                </div>

                <div id="printable-content">
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
                                        SALES RECORD REPORT
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold; width: 25%; padding: 8px;">From Date:</td>
                                    <td style="width: 25%; padding: 8px;">{{ $salesFromDate ?? 'All Time' }}</td>
                                    <td style="font-weight: bold; width: 25%; padding: 8px;">To Date:</td>
                                    <td style="width: 25%; padding: 8px;">{{ $salesToDate ?? 'All Time' }}</td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold; padding: 8px;">Generated On:</td>
                                    <td style="padding: 8px;">{{ \Carbon\Carbon::now()->format('Y-m-d H:i:s') }}</td>
                                    <td style="font-weight: bold; padding: 8px;">Total Records:</td>
                                    <td style="padding: 8px;">{{ !empty($salesData) ? count($salesData) : 0 }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    @if(!empty($salesData))
                        <div class="table-responsive text-nowrap">
                            <table class="table table-bordered table-striped">
                                <thead style="background-color: #343a40; color: white;">
                                    <tr>
                                        <th style="padding: 10px; text-align: center;"><font color="white">SN</font></th>
                                        <th style="padding: 10px;"><font color="white">Order Code</font></th>
                                        <th style="padding: 10px;"><font color="white">Menu Item</font></th>
                                        <th style="padding: 10px;"><font color="white">Category</font></th>
                                        <th style="padding: 10px;"><font color="white">Order Date</font></th>
                                        <th style="padding: 10px; text-align: center;"><font color="white">Qty</font></th>
                                        <th style="padding: 10px; text-align: right;"><font color="white">Unit Price</font></th>
                                        <th style="padding: 10px; text-align: right;"><font color="white">Total Amount</font></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($salesData as $index => $sale)
                                        <tr>
                                            <td style="padding: 8px; text-align: center;">{{ $index + 1 }}</td>
                                            <td style="padding: 8px;">{{ $sale->order_code }}</td>
                                            <td style="padding: 8px;">{{ $sale->order_name }}</td>
                                            <td style="padding: 8px;">{{ $sale->category }}</td>
                                            <td style="padding: 8px;">{{ \Carbon\Carbon::parse($sale->order_date)->format('Y-m-d') }}</td>
                                            <td style="padding: 8px; text-align: center;">{{ $sale->quantity }}</td>
                                            <td style="padding: 8px; text-align: right;">{{ Helper::format_currency($sale->price / $sale->quantity) }}</td>
                                            <td style="padding: 8px; text-align: right;">{{ Helper::format_currency($sale->price) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="table-responsive text-nowrap">
                            <table class="table table-bordered mt-4" style="margin-top: 20px;">
                                <tbody>
                                    <tr style="background-color: #f8f9fa;">
                                        <td style="font-weight: bold; padding: 10px; width: 25%;">Total Orders:</td>
                                        <td style="padding: 10px; width: 25%;">{{ count($salesData) }}</td>
                                        <td style="font-weight: bold; padding: 10px; width: 25%;">Total Quantity:</td>
                                        <td style="padding: 10px; width: 25%;">{{ $salesData->sum('quantity') }}</td>
                                    </tr>
                                    <tr style="background-color: #d4edda;">
                                        <td colspan="3" style="font-weight: bold; padding: 12px; text-align: right; font-size: 16px;">
                                            GRAND TOTAL:
                                        </td>
                                        <td style="font-weight: bold; padding: 12px; text-align: right; font-size: 16px; color: #155724;">
                                            {{ Helper::format_currency($salesData->sum('price')) }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-info text-center" style="margin: 20px 0; padding: 20px;">
                            <i class="ti ti-info-circle me-2"></i>No sales records found for the selected period.
                        </div>
                    @endif
                </div>
            </div>
          <div class="modal-footer print-hide">
    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
    <button type="button" class="btn btn-success btn-sm" id="printReportBtn2">
        <i class="ti ti-clipboard-data"></i>Print Report
    </button>
</div>
        </div>
    </div>
</div>

{{-- Improved Print Styles --}}
<style>
@media screen {
    .print-only {
        display: none !important;
    }
}

@media print {
    /* Reset everything */
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

    /* Hide everything first */
    body * {
        visibility: hidden !important;
    }

    /* Show only printable content */
    #printable-content,
    #printable-content * {
        visibility: visible !important;
    }

    /* Hide non-printable elements */
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

    /* Position printable content at top */
    #printable-content {
        position: absolute !important;
        top: 0 !important;
        left: 0 !important;
        right: 0 !important;
        width: 100% !important;
        margin: 0 !important;
        padding: 10px !important;
        background: white !important;
    }

    /* Modal structure adjustments */
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

    /* Table styling */
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

    /* Header table specific styling */
    table:first-child td {
        padding: 6px 8px !important;
    }

    /* Data table styling */
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

    /* Background colors */
    [style*="background-color: #f8f9fa"] {
        background-color: #f0f0f0 !important;
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
    }

    [style*="background-color: #d4edda"] {
        background-color: #e6f4e6 !important;
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !impoertant;
    }

    /* Text colors */
    [style*="color: #155724"] {
        color: #000 !important;
        font-weight: bold !important;
    }

    /* Page settings */
    @page {
        margin: 0.4in !important;
        size: A4 portrait !important;
    }

    /* Prevent page breaks */
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

    /* Alert styling */
    .alert {
        border: 2px solid #ccc !important;
        padding: 15px !important;
        margin: 10px 0 !important;
        background-color: #f0f8ff !important;
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !impoertant;
    }
}
</style>

{{-- Custom styles for Tom Select dropdown --}}
<style>
    .ts-dropdown {
        font-size: 1.1rem; /* Makes the dropdown text bigger */
    }

    .ts-dropdown .option {
        padding: 10px 15px; /* Adds more padding to each option */
        font-size: 1.1rem; /* Makes the text within each option bigger */
    }

    .ts-control.form-select-lg {
        padding: 0.5rem 1rem; /* Adjust padding for the select input itself */
        font-size: 1.25rem; /* Make the input text bigger */
    }
</style>

<script>
// Print Report Button Script
document.addEventListener('DOMContentLoaded', function() {
    // Function to handle print report
    function printReport() {
        // Show print dialog
        window.print();
    }

    // Add event listeners to both print buttons
    const printBtn1 = document.getElementById('printReportBtn');
    const printBtn2 = document.getElementById('printReportBtn2');

    if (printBtn1) {
        printBtn1.addEventListener('click', function(e) {
            e.preventDefault();
            printReport();
        });
    }

    if (printBtn2) {
        printBtn2.addEventListener('click', function(e) {
            e.preventDefault();
            printReport();
        });
    }

    // Alternative: If buttons are dynamically created, use event delegation
    document.addEventListener('click', function(e) {
        if (e.target.id === 'printReportBtn' || e.target.id === 'printReportBtn2') {
            e.preventDefault();
            printReport();
        }
    });
});
</script>

{{-- Tom Select and Alpine.js --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css">
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.1/dist/cdn.min.js"></script>
   <script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('autocomplete', () => ({
            tomSelectInstance: null,
            initSelect() {
                if (this.tomSelectInstance) {
                    this.tomSelectInstance.destroy();
                    this.tomSelectInstance = null;
                }
                if (!this.$refs.select) {
                    return;
                }
                this.tomSelectInstance = new TomSelect(this.$refs.select, {
                    valueField: 'value',
                    labelField: 'text',
                    searchField: 'text',
                    maxOptions: 50,
                    create: false,
                    load: (query, callback) => {
                        fetch('{{ url('/api/menus') }}?search=' + encodeURIComponent(query))
                            .then(response => response.json())
                            .then(json => {
                                callback(json.map(item => ({ value: item.name, text: item.name })));
                            }).catch(() => {
                                callback();
                            });
                    }
                });
            },
            init() {
                this.initSelect();
                // Reinitialize on modal show
                document.getElementById('makeOrder').addEventListener('shown.bs.modal', () => {
                    // Added a delay to ensure Livewire has updated the DOM
                    setTimeout(() => {
                        if (this.$refs.select) {
                            this.initSelect();
                        }
                    }, 250); 
                });
                // Listen for Livewire event to refresh Tom Select
                window.addEventListener('refresh-tom-select', () => {
                    // Added a delay to ensure Livewire has updated the DOM
                    setTimeout(() => {
                        this.initSelect();
                    }, 250); 
                });
                // Listen for submit-and-print event
                window.addEventListener('submit-and-print', () => {
                    setTimeout(() => {
                        // Ensure print-receipt is populated
                        const printReceipt = document.getElementById('print-receipt');
                        if (printReceipt) {
                            // Temporarily make print-receipt visible for thermal printer
                            printReceipt.style.display = 'block';
                            window.print();
                            // Reset display and printOrder after printing
                            printReceipt.style.display = 'none';
                            Livewire.dispatch('resetPrintOrder');
                        }
                    }, 1000); // Increased delay to 1000ms to ensure DOM update
                });
                // Listen for print-receipt-thermal event
                window.addEventListener('print-receipt-thermal', () => {
                    setTimeout(() => {
                        const printReceipt = document.getElementById('print-receipt');
                        if (printReceipt) {
                            printReceipt.style.display = 'block';
                            window.print();
                            printReceipt.style.display = 'none';
                        }
                    }, 500);
                });
            }
        }));
    });

    // Print-specific CSS (Moved to global style block for better management)
</script>
</div>