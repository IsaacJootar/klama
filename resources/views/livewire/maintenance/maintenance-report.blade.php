<div>
    <x-input-error-messages/>
    <div class="container-xxl flex-grow-1 container-p-y">
            <!--/ page-label component -->
        <div>
            <x-home-page-label>Send and Update Your Daily, Weekly or Monthly Peport Here</x-home-page-label>
        </div>
         <!--/ action button component -->
    <div>
        <x-modal-home-create-plain-button  data-bs-target="#createApp"> <i class="ti ti-file-text"> </i> Send Report </x-modal-home-create-plain-button>
    </div>
        <hr class="my-2">
        <div class="card">
<div class="table-responsive text-nowrap">

    <table class="table">
      <thead class="table-light">

                        <tr>
                            <th>SN</th>
                            <th>Number of equipment checked</th>
                            <th>Number of repairs completed</th>
                            <th>issues reported</th>
                             <th>emergency repairs</th>
                             <th>scheduled maintenance</th>
                              <th>total money spend</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($reports as $report )
                            <tr wire:key='{{$report->id}}'>
                                <td>{{$loop->index + 1}}</td>
                                <td>
                                    {{$report->equipment_checked}}
                                </td>
                                <td>
                                    {{$report->repairs_done}}
                                </td>
                                <td>
                                    {{$report->faults_reported}}
                                </td>
                                <td>
                                    {{$report->emergency_repairs}}

                                </td>
                                <td>
                                    {{$report->scheduled_maintenance}}

                                </td>
                                <td>
                                    {{$report->amount}}

                                </td>

                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown"><i class="ti ti-dots-vertical"></i></button>
                                        <div class="dropdown-menu">
                                            <a wire:click="edit({{ $report->id }})" data-bs-toggle="modal" data-bs-target="#createApp" class="dropdown-item" href="javascript:void(0);"><i
                                                class="ti ti-pencil me-1"></i> Edit</a>
                                            <a wire:click='destroy({{ $report->id }})'
                                                wire:confirm="Are you sure you want to proceed and delete this item?"
                                                class="dropdown-item" href="javascript:void(0);"><i
                                                    class="ti ti-search me-1"></i> View Report</a>
                                        </div>
                                    </div>
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!--/ Reports -->

    </div>
<!-- Create Report Modal -->
<div wire:ignore.self  class="modal fade" id="createApp" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-simple modal-upgrade-plan">
      <div class="modal-content">
        <div class="modal-body">
            <button wire:click='exit' type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

          <div class="text-center">
            <h4 class="mb-2"><x-home-page-label>Send  Report</x-home-page-label></h4>

          </div>
          <div id="wizard-create-app" class="bs-stepper vertical mt-2 shadow-none">
            <div class="bs-stepper-header border-0 p-1">
              <div class="step" data-target="#inputs">
                <button type="button" class="step-trigger">
                  <span class="bs-stepper-circle"><i class="ti ti-box"></i></span>
                  <span class="bs-stepper-label">
                    <span class="bs-stepper-title text-uppercase">SUMMARY INPUTS</span>
                    <span class="bs-stepper-subtitle">Enter Activity Summary</span>
                  </span>
                </button>
              </div>
              <div class="line"></div>
              <div class="step" data-target="#note">
                <button type="button" class="step-trigger">
                  <span class="bs-stepper-circle"><i class="ti ti-file-text"></i></span>
                  <span class="bs-stepper-label">
                    <span class="bs-stepper-title text-uppercase">SUMMARY NOTE</span>
                    <span class="bs-stepper-subtitle">Enter Summary Note</span>
                  </span>
                </button>
              </div>
              <div class="line"></div>
              <div class="step" data-target="#files">
                <button type="button" class="step-trigger">
                  <span class="bs-stepper-circle"><i class="ti ti-cloud"></i></span>
                  <span class="bs-stepper-label">
                    <span class="bs-stepper-title text-uppercase">REPORT FILES</span>
                    <span class="bs-stepper-subtitle">Report Files</span>
                  </span>
                </button>
              </div>
              <div class="line"></div>

              <div class="line"></div>
              <div class="step" data-target="#submit">
                <button type="button" class="step-trigger">
                  <span class="bs-stepper-circle"><i class="ti ti-check"></i></span>
                  <span class="bs-stepper-label">
                    <span class="bs-stepper-title text-uppercase">Done</span>
                    <span class="bs-stepper-subtitle">Done with report</span>
                  </span>
                </button>
              </div>
            </div>
            <div class="bs-stepper-content p-1">
                <form onSubmit="return false">
                    @csrf
                <!-- these summary inputs are different from hotel section to section but the summary note below is a must for all sections -->

                <div id="inputs" class="content pt-4 pt-lg-0">
                 <h6>Enter Activity Inputs</h6>
                 <ul class="p-0 m-0">
                 <label class="form-label w-100" for="modalAddValue">Number of equipment checked</label>
                 <div class="input-group input-group-merge">
                     <input wire:model='equipment_checked' placeholder="E.g 9" class="form-control form-control-lg" type="text"
                         aria-describedby="modalItemName" />
                     <span class="input-group-text cursor-pointer p-1" id="modalAddCard2"><span
                             class="card-type"></span></span>
                 </div>
         <label class="form-label w-100" for="modaladdFleet">Number of repairs completed</label>
         <div class="input-group input-group-merge">
           <input wire:model='repairs_done' placeholder="E.g 17" class="form-control form-control-lg" type="text" aria-describedby="modaladdFleet" placeholder="Eg. Vehicle Plate No." />
           <span class="input-group-text cursor-pointer p-1" id="modalAddCard2"><span class="card-type"></span></span>
         </div>
         <label class="form-label w-100" for="modalAddValue">Number of faults/issues reported</label>
                 <div class="input-group input-group-merge">
                     <input wire:model='faults_reported' placeholder="E.g 4" class="form-control form-control-lg" type="text"
                         aria-describedby="modalItemName" />
                     <span class="input-group-text cursor-pointer p-1" id="modalAddCard2"><span
                             class="card-type"></span></span>
                 </div>
                 <label class="form-label w-100" for="modaladdFleet">Number of emergency repairs </label>
                 <div class="input-group input-group-merge">
                   <input wire:model='emergency_repairs' placeholder="E.g 0" class="form-control form-control-lg" type="text" aria-describedby="modaladdFleet" placeholder="Eg. Vehicle Plate No." />
                   <span class="input-group-text cursor-pointer p-1" id="modalAddCard2"><span class="card-type"></span></span>
                 </div>
                 <label class="form-label w-100" for="modaladdFleet">Number of scheduled maintenance tasks</label>
                 <div class="input-group input-group-merge">
                   <input wire:model='scheduled_maintenance' placeholder="E.g 0" class="form-control form-control-lg" type="text" aria-describedby="modaladdFleet" placeholder="Eg. Vehicle Plate No." />
                   <span class="input-group-text cursor-pointer p-1" id="modalAddCard2"><span class="card-type"></span></span>
                 </div>
                 <label class="form-label w-100" for="modaladdFleet">Total money for maintenance tasks</label>
                 <div class="input-group input-group-merge">
                   <input wire:model='amount' placeholder="E.g 0" class="form-control form-control-lg" type="text" aria-describedby="modaladdFleet" placeholder="Eg. Vehicle Plate No." />
                   <span class="input-group-text cursor-pointer p-1" id="modalAddCard2"><span class="card-type"></span></span>
                 </div>

                 </ul>
                  <div class="col-12 d-flex justify-content-between mt-6">
                    <button class="btn btn-label-secondary btn-prev" disabled> <i class="ti ti-arrow-left ti-xs me-sm-2 me-0"></i>
                      <span class="align-middle d-sm-inline-block d-none">Previous</span>
                    </button>
                    <button class="btn btn-primary btn-next"> <span class="align-middle d-sm-inline-block d-none me-sm-2">Next</span> <i class="ti ti-arrow-right ti-xs"></i></button>
                  </div>
                </div>

                <!-- note is a must on all reports -->
                <div id="note" class="content pt-4 pt-lg-0">
                 <h6>Report Summary Note</h6>
                  <ul class="p-0 m-0">
                     <div>
                         <label for="exampleFormControlTextarea1" class="form-label">Write Your report Note Below</label>
                         <textarea wire:model='notes' class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                       </div>
                  </ul>

                  <div class="col-12 d-flex justify-content-between mt-6">
                    <button class="btn btn-label-secondary btn-prev"> <i class="ti ti-arrow-left ti-xs me-sm-2 me-0"></i> <span class="align-middle d-sm-inline-block d-none">Previous</span> </button>
                    <button class="btn btn-primary btn-next"> <span class="align-middle d-sm-inline-block d-none me-sm-2">Next</span> <i class="ti ti-arrow-right ti-xs"></i></button>
                  </div>
                </div>

                <!-- files -->

                <div id="files" class="content pt-4 pt-lg-0">
                 <h6>Upload Report Files if Necessary</h6>
                 <ul class="p-0 m-0">

                     <div class="card-body">

                       <div class="mb-4">
                         <label for="formFileMultiple" class="form-label">You can upload Multiple files at once if necessary</label>
                         <x-filepond::upload wire:model="files" />
                       </div>
                   </div>
                 </ul>

                  <div class="col-12 d-flex justify-content-between mt-6">
                    <button class="btn btn-label-secondary btn-prev"> <i class="ti ti-arrow-left ti-xs me-sm-2 me-0"></i> <span class="align-middle d-sm-inline-block d-none">Previous</span> </button>
                    <button class="btn btn-primary btn-next"> <span class="align-middle d-sm-inline-block d-none me-sm-2">Next</span> <i class="ti ti-arrow-right ti-xs"></i></button>
                  </div>
                </div>


                <!-- submit -->
                <div id="submit" class="content text-center pt-4 pt-lg-0">
                  <h5 class="mb-1">SURE?</h5>
                  <p class="small">Please select the receiver of this report. </p>

                  <!-- REPORTING CHANNEL -->
                 <select wire:model="sent_to" value='admin' class="form-select form-select-lg"
                     data-allow-clear="true">
                     <option value="">--Select Receiver--</option>
                <!-- select from stored database reporting channel configuration -->

                     <option value="1234">Maintenance Manager </option>
                 </select><br>
                  <div class="col-12 d-flex justify-content-between mt-6">
                    <button class="btn btn-label-secondary btn-prev"> <i class="ti ti-arrow-left ti-xs me-sm-2 me-0"></i> <span class="align-middle d-sm-inline-block d-none">Previous</span> </button>

                    <button wire:click='save' type="button" class="btn btn-success">{{$modal_flag ? 'Update Report' : 'Send Report'}}</button>

                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--/Create Modal -->


    </div>

