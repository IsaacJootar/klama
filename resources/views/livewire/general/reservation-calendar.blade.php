@php
    use Carbon\Carbon;
@endphp

<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Header Section -->
    <div class="hero-card">
        <div class="hero-content">
            <div class="hero-text">
                <h4 class="hero-title">Reservation Calendar</h4>
                <p class="hero-subtitle">{{ Carbon::today()->timezone('Africa/Lagos')->format('l, F j, Y') }}</p>
                <div class="hero-stats">
                    <span class="hero-stat">
                        <i class="ti ti-person-check-fill me-1"></i>
                        {{ \App\Models\Reservation::where('checkin_status', 'Checkedin')
                            ->where('checkout_status', 'Pending')
                            ->whereDate('checkin', '<=', Carbon::today()->timezone('Africa/Lagos'))
                            ->whereDate('checkout', '>=', Carbon::today()->timezone('Africa/Lagos'))
                            ->count() }} Checked-In Guests
                    </span>
                    <span class="hero-stat">
                        <i class="ti ti-calendar-event me-1"></i>
                        {{ \App\Models\Reservation::where('checkout_status', 'Pending')
                            ->whereDate('checkin', '<=', Carbon::today()->timezone('Africa/Lagos'))
                            ->whereDate('checkout', '>=', Carbon::today()->timezone('Africa/Lagos'))
                            ->count() }} Active Reservations
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

    <!-- Calendar Card -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="card-title">
                <i class="ti ti-calendar me-1"></i> Reservation & Check-In Calendar
            </h5>
        </div>
        <div class="card-body">
            <div id="reservationCalendar"></div>
        </div>
    </div>

    <!-- Event Details Modal -->
    <div class="modal fade" id="eventModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Reservation Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive text-nowrap">
                        <table class="table table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>Guest Name</th>
                                    <th>Reservation ID</th>
                                    <th>Room</th>
                                    <th>Status</th>
                                    <th>Check-In</th>
                                    <th>Check-Out</th>
                                </tr>
                            </thead>
                            <tbody id="eventDetails"></tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Styles -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }

        /* Hero Section */
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

        /* Calendar Card */
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background: #ffffff;
            border-bottom: 1px solid #e9ecef;
            padding: 15px;
        }

        .card-title {
            margin: 0;
            font-size: 18px;
            font-weight: 600;
            display: flex;
            align-items: center;
        }

        .card-body {
            padding: 20px;
        }

        /* FullCalendar Customizations */
        #reservationCalendar {
            max-width: 100%;
            margin: 0 auto;
        }

        .fc {
            font-family: Arial, sans-serif;
        }

        .fc .fc-toolbar-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #2d3748;
        }

        .fc .fc-button {
            background: #ffffff;
            color: #2d3748;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .fc .fc-button:hover {
            background: linear-gradient(135deg, #4e73df, #224abe);
            color: #ffffff;
            border-color: #224abe;
        }

        .fc .fc-button.fc-dayGridMonth-button,
        .fc .fc-button.fc-dayGridWeek-button {
            background: #ffffff;
            color: #2d3748;
        }

        .fc .fc-button.fc-dayGridMonth-button.fc-button-active,
        .fc .fc-button.fc-dayGridWeek-button.fc-button-active {
            background: linear-gradient(135deg, #4e73df, #224abe);
            color: #ffffff;
            border-color: #224abe;
        }

        .fc .fc-daygrid-day-number {
            color: #2d3748;
            font-weight: 500;
        }

        .fc .fc-daygrid-day-top {
            padding: 0.5rem;
        }

        .fc .fc-event {
            border-radius: 5px;
            padding: 2px 5px;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .fc .fc-event:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        /* Modal Styling */
        .modal-content {
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .modal-header {
            background: linear-gradient(135deg, #4e73df, #224abe);
            color: white;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .modal-body .table th,
        .modal-body .table td {
            vertical-align: middle;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 24px;
            }

            .hero-content {
                flex-direction: column;
                text-align: center;
            }

            .hero-stats {
                justify-content: center;
                flex-wrap: wrap;
            }

            .fc .fc-toolbar-title {
                font-size: 1.2rem;
            }
        }
    </style>

    <!-- FullCalendar and Bootstrap Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize FullCalendar
            var calendarEl = document.getElementById('reservationCalendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: @json($events ?? []),
                eventClick: function(info) {
                    document.getElementById('eventDetails').innerHTML = `
                        <tr>
                            <td>${info.event.title}</td>
                            <td>${info.event.extendedProps.reservation_id}</td>
                            <td>${info.event.extendedProps.room_name}</td>
                            <td>${info.event.extendedProps.checkin_status}</td>
                            <td>${info.event.start.toLocaleDateString()}</td>
                            <td>${info.event.end.toLocaleDateString()}</td>
                        </tr>
                    `;
                    new bootstrap.Modal(document.getElementById('eventModal'), {
                        backdrop: 'static',
                        keyboard: true
                    }).show();
                },
                eventMouseEnter: function(info) {
                    info.el.style.transform = 'scale(1.05)';
                    info.el.style.boxShadow = '0 5px 15px rgba(0, 0, 0, 0.2)';
                },
                eventMouseLeave: function(info) {
                    info.el.style.transform = 'scale(1)';
                    info.el.style.boxShadow = 'none';
                },
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,dayGridWeek'
                },
                height: 'auto',
                contentHeight: 600,
                aspectRatio: 1.35,
                dayMaxEvents: 3,
                eventTimeFormat: {
                    hour: 'numeric',
                    minute: '2-digit',
                    meridiem: 'short'
                }
            });
            calendar.render();

            // Reinitialize navbar on Livewire navigation
            const navbarToggler = document.querySelector('.navbar-toggler');
            const navbarCollapse = document.querySelector('.navbar-collapse');
            if (navbarToggler && navbarCollapse) {
                // Remove existing event listeners to prevent duplicates
                const newToggler = navbarToggler.cloneNode(true);
                navbarToggler.replaceWith(newToggler);
                newToggler.addEventListener('click', function () {
                    navbarCollapse.classList.toggle('show');
                });
            }

            // Ensure navbar reinitializes after Livewire updates
            document.addEventListener('livewire:navigated', function () {
                const navbarToggler = document.querySelector('.navbar-toggler');
                const navbarCollapse = document.querySelector('.navbar-collapse');
                if (navbarToggler && navbarCollapse) {
                    const newToggler = navbarToggler.cloneNode(true);
                    navbarToggler.replaceWith(newToggler);
                    newToggler.addEventListener('click', function () {
                        navbarCollapse.classList.toggle('show');
                    });
                }
            });
        });
    </script>
</div>

@livewireScripts