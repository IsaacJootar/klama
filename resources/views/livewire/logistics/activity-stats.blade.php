<div>
        <!-- Content wrapper -->
        <div class="content-wrapper">
            @php
             use Carbon\Carbon;
            {{$date = Carbon::now()->timezone('Africa/Lagos')->format('Y-m-d');}}

            $section = 'Logistics';
            @endphp
            <!-- Content -->
                <div class="row g-6">
                    <!-- Stats -->
                    <div class="col-lg-3 col-sm-6">
                        <div class="card card-border-shadow-primary h-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="avatar me-4">
                                        <span class="avatar-initial rounded bg-label-primary"><i
                                                class='ti ti-car ti-28px'></i></span>
                                    </div>
                                    <h4 class="mb-0">{{\App\Models\Report::where('date', $date)
                                        ->where('section', $section)
                                        ->get()->value('trips_made')}}</h4>
                                </div>
                                <p class="mb-1">Trips Made </p>
                                <p class="mb-0">
                                    <span class="text-heading fw-medium me-2">+18.2%</span>
                                    <small class="text-muted">than last week</small>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card card-border-shadow-warning h-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="avatar me-4">
                                        <span class="avatar-initial rounded bg-label-warning"><i
                                                class='ti ti-plane ti-28px'></i></span>
                                    </div>
                                    <h4 class="mb-0">{{\App\Models\Report::where('date', $date)->get()->value('airport_pickups')}}</h4>
                                </div>
                                <p class="mb-1">Airport PickUps</p>
                                <p class="mb-0">
                                    <span class="text-heading fw-medium me-2">-8.7%</span>
                                    <small class="text-muted">than last week</small>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card card-border-shadow-danger h-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="avatar me-4">
                                        <span class="avatar-initial rounded bg-label-primary"><i
                                                class='ti ti-git-fork ti-28px'></i></span>
                                    </div>
                                    <h4 class="mb-0">{{\App\Models\Report::where('date', $date)
                                        ->where('section', $section)
                                        ->get()->value('other')}}</h4>
                                </div>
                                <p class="mb-1">Other Errands</p>
                                <p class="mb-0">
                                    <span class="text-heading fw-medium me-2">+4.3%</span>
                                    <small class="text-muted">than last week</small>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card card-border-shadow-info h-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="avatar me-4">
                                        <span class="avatar-initial rounded bg-label-danger"><i
                                                class='ti ti-alert-triangle ti-28px'></i></span>
                                    </div>
                                    <h4 class="mb-0">{{\App\Models\Report::where('date', $date)
                                        ->where('section', $section)
                                        ->get()->value('breakdowns')}}</h4>
                                </div>
                                <p class="mb-1">Breakdowns</p>
                                <p class="mb-0">
                                    <span class="text-heading fw-medium me-2">-2.5%</span>
                                    <small class="text-muted">than last week</small>
                                </p>
                            </div>
                        </div>
                    </div>
                    <!--/ Stats -->





                </div>



    </div>
