<?php
use App\Http\Helpers\Helper;
use Illuminate\Support\Str;
?>

<style>
    .invoice-container {
        max-width: 900px; /* Increased from 800px to make receipt longer */
        margin: 0 auto;
        padding: 50px; /* Increased padding for more vertical space */
        background: #fff;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        font-family: Arial, sans-serif;
    }
    .invoice-header {
        text-align: center;
        border-bottom: 2px solid #007bff;
        padding-bottom: 30px; /* Increased padding */
        margin-bottom: 40px; /* Increased margin */
    }
    .invoice-header img {
        max-width: 150px;
    }
    .invoice-details, .customer-details, .summary {
        margin-bottom: 50px; /* Increased margin for more vertical space */
    }
    .invoice-details h5, .customer-details h5, .summary h5 {
        color: #007bff;
        margin-bottom: 20px; /* Increased margin */
    }
    .table-container {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }
    .table-invoice {
        width: 100%;
        min-width: 800px; /* Ensure table has enough width for all columns */
        border-collapse: collapse;
        margin-bottom: 20px;
    }
    .table-invoice th, .table-invoice td {
        border: 1px solid #e0e0e0;
        padding: 10px;
        text-align: left;
    }
    .table-invoice th {
        background: #f8f9fa;
        color: #333;
    }
    .summary-table-container {
        overflow-x: auto; /* Added to make summary table scrollable */
        -webkit-overflow-scrolling: touch;
        float: right;
        width: 50%;
    }
    .summary-table {
        width: 100%;
        min-width: 300px; /* Ensure summary table has enough width */
        border-collapse: collapse;
    }
    .summary-table th, .summary-table td {
        border: 1px solid #e0e0e0;
        padding: 8px;
    }
    .summary-table th {
        background: #f8f9fa;
        color: #333;
    }
    .additional-info {
        border: 1px solid #e0e0e0;
        padding: 30px; /* Increased padding */
        border-radius: 5px;
        background: #f9f9f9;
    }
    .terms-conditions {
        border: 1px solid #e0e0e0;
        padding: 30px; /* Increased padding */
        border-radius: 5px;
        background: #f9f9f9;
    }
    .contact-info {
        border: 1px solid #e0e0e0;
        padding: 30px; /* Increased padding */
        border-radius: 5px;
        background: #f9f9f9;
    }
    .footer {
        text-align: center;
        margin-top: 80px; /* Increased margin for more vertical space */
        color: #666;
        font-size: 0.9em;
        padding: 40px 0; /* Increased padding */
    }
    .no-print {
        margin-top: 30px; /* Increased margin */
        text-align: center;
    }
    .info-row {
        margin-bottom: 15px; /* Added spacing between info rows */
    }
    .spacer {
        height: 30px; /* Added spacer class for extra vertical space */
    }
    @media print {
        body * {
            visibility: hidden;
        }
        .invoice-container, .invoice-container * {
            visibility: visible;
        }
        .invoice-container {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            border: none;
            box-shadow: none;
            margin: 0;
            padding: 10px;
        }
        .table-container {
            overflow-x: visible; /* Disable scrolling for print */
        }
        .table-invoice {
            min-width: auto; /* Remove min-width for print */
        }
        .summary-table-container {
            overflow-x: visible; /* Disable scrolling for print */
        }
        .summary-table {
            min-width: auto; /* Remove min-width for print */
        }
        .no-print {
            display: none !important;
        }
    }
</style>

<div class="container-xxl flex-grow-1 container-p-y">
    <x-input-error-messages/>
    <div class="invoice-container">
        <!-- Header -->
        <div class="invoice-header">
            <h3>VINE INTERNATIONAL SUITES AND RESORT</h3>
            <h5>Reservation Receipt</h5>
            <p><strong>Reservation ID:</strong> {{ $reservation_id }}</p>
        </div>

        <!-- Customer Details -->
        <div class="customer-details">
            <h5>Customer Information</h5>
            <p><strong>Name:</strong> {{ Str::ucfirst($customer) }}</p>
            <p><strong>Phone:</strong> {{ $phone }}</p>
            <p><strong>Email:</strong> {{ $email }}</p>
        </div>

        <!-- Room List Table -->
        <div class="invoice-details">
            <h5>Reservation Details</h5>
            <div class="table-container">
                <table class="table-invoice">
                    <thead>
                        <tr>
                            <th>Room</th>
                            <th>Category</th>
                            <th>Check-in</th>
                            <th>Check-out</th>
                            <th>Nights</th>
                            <th>Unit Price (Per Night)</th>
                            <th>Check-in Type</th>
                            <th>Early Check-in Fee</th>
                            <th>Check-out Type</th>
                            <th>Late Check-out Fee</th>
                            <th>Amount Due</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rooms as $room)
                            <tr>
                                <td>{{ Str::ucfirst($room['room_name']) }}</td>
                                <td>{{ Str::ucfirst($room['category_name']) }}</td>
                                <td>{{ $room['checkin'] }}</td>
                                <td>{{ $room['checkout'] }}</td>
                                <td>{{ $room['nights'] }}</td>
                                <td>{{ Helper::format_currency($room['unit_price']) }}</td>
                                <td>{{ $room['checkin_type'] }}</td>
                                <td>{{ $room['early_checkin_fee'] > 0 ? Helper::format_currency($room['early_checkin_fee']) : '-' }}</td>
                                <td>{{ $room['checkout_type'] }}</td>
                                <td>{{ $room['late_checkout_fee'] > 0 ? Helper::format_currency($room['late_checkout_fee']) : '-' }}</td>
                                <td>{{ Helper::format_currency($room['subtotal'] + $room['early_checkin_fee'] + $room['late_checkout_fee']) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Summary -->
        <div class="summary">
            <h5>Summary</h5>
            <div class="summary-table-container">
                <table class="summary-table">
                    @if ($coupon_code)
                        <tr>
                            <th>Coupon</th>
                            <td><small><strong style="color: #28a745;">{{ $coupon_code }} (-{{ Helper::format_currency($total_discount) }})</strong></small></td>
                        </tr>
                    @endif
                    @if ($checkin_type === 'Early Check-In' && $early_checkin_fee > 0)
                        <tr>
                            <th>Early Check-in Fee</th>
                            <td><small><strong style="color: #dc3545;">{{ Helper::format_currency($early_checkin_fee) }}</strong></small></td>
                        </tr>
                    @endif
                    @if ($checkout_type === 'Late Check-Out' && $late_checkout_fee > 0)
                        <tr>
                            <th>Late Check-out Fee</th>
                            <td><small><strong style="color: #dc3545;">{{ Helper::format_currency($late_checkout_fee) }}</strong></small></td>
                        </tr>
                    @endif
                    <tr>
                        <th>Total Amount Paid</th>
                        <td>{{ Helper::format_currency($total_amount) }}</td>
                    </tr>
                    <tr>
                        <th>Payment Medium</th>
                        <td>{{ Str::ucfirst($payment_medium) }}</td>
                    </tr>
                    <tr>
                        <th>Payment Status</th>
                        <td>{{ Helper::get_reservation_payment_status($reservation_id) }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>Thank you for choosing Vine International Suites and Resort!</p>
           
        </div>

        <!-- Print and Back Buttons -->
        <div class="no-print">
            <button type="button" class="btn btn-primary" onclick="window.print()">
                Print Receipt
            </button>
        </div>
    </div>
</div>