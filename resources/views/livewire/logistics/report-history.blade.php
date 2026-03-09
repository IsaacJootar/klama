<div>
    @php
    use App\Http\Helpers\Helper;
@endphp
    <x-input-error-messages/>
    <div class="container-xxl flex-grow-1 container-p-y">
            <!--/ page-label component -->
        <div>
            <x-home-page-label>Report History</x-home-page-label>
        </div>
         <!--/ action button component -->

        <hr class="my-2">
        <div class="card">
<div class="table-responsive text-nowrap">

    <table id="myTable" class="table">
      <thead class="table-light">

                        <tr>
                            <th>SN</th>
                            <th>Report ID</th>
                            <th>Trips Made</th>
                            <th>Airport PickUps</th>
                            <th>Other Movements</th>
                             <th>Breakdowns</th>
                             <th>Summary Note</th>

                             <th>Contain File(s)?</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($reports as $report )
                            <tr wire:key='{{$report->id}}'>
                                <td>{{$loop->index + 1}}</td>
                                <td>
                                    {{$report->report_id}}
                                </td>
                                <td>
                                    {{$report->trips_made}}
                                </td>
                                <td>
                                    {{$report->airport_pickups}}
                                </td>
                                <td>
                                    {{$report->other}}
                                </td>
                                <td>
                                    {{$report->breakdowns}}

                                </td>

                                <td>
                                    {{Str::limit($report->note, 20)}}
                                </td>




                                <td>
                                    {{Helper:: reportHasFiles($report->report_id)}}

                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown"><i class="ti ti-dots-vertical"></i></button>
                                        <div class="dropdown-menu">
                                            <a wire:click="view({{ $report->report_id }})" data-bs-toggle="modal" data-bs-target="#report" class="dropdown-item" href="javascript:void(0);"><i
                                                class="ti ti-eye me-1"></i> View Report</a>
                                        </div>
                                    </div>
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!--/ Reports History-->

    </div>

<!-- view Report Modal -->
jdkskldle
<div  wire:ignore.self  class="modal fade" data-bs-focus="false" id="report" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered1 modal-simple modal-add-new-cc">
      <div class="modal-content">
        <div class="modal-body">
          <button wire:click='exit' type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="text-center mb-6">

            <h4 class="mb-2"><x-home-page-label>{{$modal_title}}</x-home-page-label></h4>

            <b class="badge bg-label-secondary ms-1">  Report Date / Time:  {{$data = \App\Models\Report::where('report_id', $report_id)->value('created_at')}}
            </b>
                <p  class="badge bg-label-info ms-1">
          @php use Carbon\Carbon; echo  Carbon::parse($data)->diffForHumans(); @endphp
        </p>

          </div>


  <!-- Report Full View-->

    <div class="card h-100">
      <div class="card-header d-flex align-items-center justify-content-between">
        <div class="card-title mb-0">
        </div>
        <div class="dropdown">
          <button class="btn btn-text-secondary rounded-pill text-muted border-0 p-2 me-n1" type="button" id="salesByCountryTabs" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="ti ti-dots-vertical ti-md text-muted"></i>
          </button>
          <div class="dropdown-menu dropdown-menu-end" aria-labelledby="salesByCountryTabs">
            <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
            <a class="dropdown-item" href="javascript:void(0);">Archive</a>

          </div>
        </div>
      </div>
      <div class="card-body p-0">

        <div class="nav-align-top">
          <ul class="nav nav-tabs nav-fill rounded-0 timeline-indicator-advanced" role="tablist">
            <li class="nav-item">
              <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-new" aria-controls="navs-justified-new" aria-selected="true">Report Summary Data</button>
            </li>
            <li class="nav-item">
              <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-link-preparing" aria-controls="navs-justified-link-preparing" aria-selected="false">Report Note</button>
            </li>
            <li class="nav-item">
              <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-link-shipping" aria-controls="navs-justified-link-shipping" aria-selected="false">Report Files</button>
            </li>
          </ul>
          <div class="tab-content border-0  mx-1">
            <div class="tab-pane fade show active" id="navs-justified-new" role="tabpanel">


                        <div class="card-body">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="avatar me-4">
                                        <span class="avatar-initial rounded bg-label-primary"><i
                                                class='ti ti-car ti-28px'></i></span>
                                    </div>
                                    <h4 class="mb-0">{{\App\Models\Report::where('report_id', $report_id)->get()->value('trips_made')}}</h4>
                                </div>
                                <p class="mb-1">Trips Made </p>
                               
                            </div>
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="avatar me-4">
                                        <span class="avatar-initial rounded bg-label-warning"><i
                                                class='ti ti-plane ti-28px'></i></span>
                                    </div>
                                    <h4 class="mb-0">{{\App\Models\Report::where('report_id', $report_id)->get()->value('airport_pickups')}}</h4>
                                </div>
                                <p class="mb-1">Airport PickUps</p>
                               
                            </div>

                            <div class="card-body">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="avatar me-4">
                                        <span class="avatar-initial rounded bg-label-primary"><i
                                                class='ti ti-git-fork ti-28px'></i></span>
                                    </div>
                                    <h4 class="mb-0">{{\App\Models\Report::where('report_id', $report_id)->get()->value('other')}}</h4>
                                </div>
                                <p class="mb-1">Other Errands</p>
                                
                            </div>

                            <div class="card-body">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="avatar me-4">
                                        <span class="avatar-initial rounded bg-label-danger"><i
                                                class='ti ti-alert-triangle ti-28px'></i></span>
                                    </div>

                                    <h4 class="mb-0">{{\App\Models\Report::where('report_id', $report_id)->get()->value('breakdowns')}}</h4>
                                </div>
                                <p class="mb-1">Breakdowns</p>
                               
                            </div>

            </div>
            <div class="tab-pane fade" id="navs-justified-link-preparing" role="tabpanel">
                <div>
                    <h5> <i class="badge bg-label-secondary ms-1">Summary Note</i></h5>
                    <p class="mb-0">{{\App\Models\Report::where('report_id', $report_id)->get()->value('note')}}</p>

                    </button>
                  </div>


            </div>
            <div class="tab-pane fade" id="navs-justified-link-shipping" role="tabpanel">
                @if ($modal_title)  <!--a flag to be know edit button is clicked, to avoid foreach being NULL-->
            <h5><i class="badge bg-label-secondary ms-1">Report Files</i></h5>
            <tr class="table-default">


                <ul>
                    @foreach ($files as $file)
                <td>
                        <li>
                            {{  $file->file_name }}
                            <a href="{{ asset('public'.Storage::url($file->path)) }}" download class="ti-ti">

                                <i class="ti ti-download"></i>   Download File
                            </a>


                            <a
                                href="{{ asset('public'. Storage::url($file->path)) }}"
                                target="_blank">
                                <i class="ti ti-eye"></i>{{ $file->name }}      Open File
                            </a>
                        </li>
                </td>
                    @endforeach
                </ul>
                @endif
            </div>


      </div>
    </div>
  </div>

        </div>
      </div>
    </div>


  </div>
  <!--/ New Feet Item Modal -->


    </div>

