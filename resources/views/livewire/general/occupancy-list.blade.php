@php
    use App\Http\Helpers\Helper;
    use Carbon\Carbon;
    use App\Models\Reservation;
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Current Occupancy List - Print Preview</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@tabler/icons@2.22.0/tabler-icons.min.css" rel="stylesheet">
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background-color: #f8f9fa; }
        .hero-card {
            background: linear-gradient(135deg, #4e73df, #224abe);
            border-radius: 10px;
            padding: 20px;
            position: relative;
            overflow: hidden;
            margin-bottom: 20px;
        }
        .hero-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .hero-text {
            flex: 1;
        }
        .hero-title {
            font-weight: bold;
            color: white;
            font-size: 32px;
            margin-bottom: 10px;
        }
        .hero-subtitle {
            color: rgba(255, 255, 255, 0.8);
            font-size: 16px;
            margin-bottom: 15px;
        }
        .hero-stats {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }
        .hero-stat {
            color: white;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        .hero-decoration {
            position: absolute;
            right: 0;
            top: 0;
            bottom: 0;
            width: 150px;
            opacity: 0.2;
        }
        .floating-shape {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }
        .shape-1 { width: 80px; height: 80px; top: 20px; right: 20px; }
        .shape-2 { width: 50px; height: 50px; bottom: 30px; right: 50px; }
        .shape-3 { width: 60px; height: 60px; top: 50%; right: 10px; }
        .card { margin-bottom: 20px; }
        .table th, .table td { vertical-align: middle; }
        @media print {
            body { margin: 0; background: white; }
            .no-print { display: none; }
            .hero-card { -webkit-print-color-adjust: exact; print-color-adjust: exact; }
        }
    </style>
</head>
<body>
    <!-- Header Section -->
    <div class="container-xxl">
        <div class="hero-card">
            <div class="hero-content">
                <div class="hero-text">
                    <h4 class="hero-title">Current Occupancy List</h4>
                    <p class="hero-subtitle">
                        Generated on: {{ Carbon::now('Africa/Lagos')->format('d M Y') }}
                    </p>
                    <div class="hero-stats">
                        <span class="hero-stat">
                            <i class="ti ti-report-analytics me-1"></i>
                            Current Checked-In Guests
                        </span>
                    </div>
                </div>
                <div class="hero-decoration">
                    <div class="floating-shape shape-1"></div>
                    <div class="floating-shape shape-2"></div>
                    <div class="floating-shape shape-3"></div>
                </div>
            </div>
        </div>

        <!-- Report Content -->
        <div class="card">
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    @php
                        // Fetch checked-in reservations similar to ReservedRooms component
                        $occupancy_data = Reservation::where('checkin_status', 'Checkedin')
                            ->distinct('reservation_id')
                            ->get(['reservation_id', 'fullname', 'checkin', 'checkout']);
                    @endphp

                    <!-- Occupancy List -->
                    <table class="table table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>Guest Name</th>
                                <th>Reservation ID</th>
                                <th>Check-In Date</th>
                                <th>Check-Out Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($occupancy_data as $guest)
                                <tr>
                                    <td>{{ $guest->fullname }}</td>
                                    <td>{{ $guest->reservation_id }}</td>
                                    <td>{{ Carbon::parse($guest->checkin)->format('d M Y') }}</td>
                                    <td>{{ Carbon::parse($guest->checkout)->format('d M Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="no-print d-flex gap-2 justify-content-center">
            <button onclick="window.print()" class="btn btn-primary">
                <i class="ti ti-printer me-1"></i> Print List
            </button>
        </div>
    </div>
</body>
</html>