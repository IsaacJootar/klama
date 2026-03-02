<div>
    
    @php
    use App\Http\Helpers\Helper;
@endphp
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
 <table id="myTable" class="table">
      <thead class="table-light">

                        <tr>
                            <th>SN</th>
                            <th> Number of Orders</th>
                            <th> Revenue Generated</th>
                            <th>Amount of food/beverage wasted</th>
                             <th>Customer Complaints</th>
                             <th>Special Meal Requests</th>
                              <th>Items Used</th>
                             <th>Remaining Stock </th>
                              <th>Money Spend</th>
                          
                        </tr>
                    </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($reports as $report )
                            <tr wire:key='{{$report->id}}'>
                                <td>{{$loop->index + 1}}</td>
                                <td>
                                    {{$report->total_orders}}
                                </td>
                                <td>
                                    {{ Helper::format_currency($report->total_revenue) }}
                                </td>
                                <td>
                                    {{$report->wastage}}
                                </td>
                                <td>
                                    {{$report->complaints_received}}

                                </td>
                                <td>
                                    {{$report->special_requests}}

                                </td>
                                <td>
                                    {{$report->inventory_used}}

                                </td>
                                <td>
                                    {{$report->inventory_remaining}}

                                </td>
                                <td>
                                    {{ Helper::format_currency($report->amount)}}

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
<div wire:ignore.self class="modal fade" id="createApp" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-simple modal-upgrade-plan">
    <div class="modal-content">
      <div class="modal-body">
        <button wire:click='exit' type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

        <div class="text-center">
          <h4 class="mb-2"><x-home-page-label>Send Report</x-home-page-label></h4>
        </div>

        <div id="wizard-create-app" class="bs-stepper vertical mt-2 shadow-none">
          <!-- Stepper Header -->
          <div class="bs-stepper-header border-0 p-1">
            <div class="step active" data-target="#inputs">
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
                  <span class="bs-stepper-subtitle">Upload Files</span>
                </span>
              </button>
            </div>
            <div class="line"></div>

            <div class="step" data-target="#submit">
              <button type="button" class="step-trigger">
                <span class="bs-stepper-circle"><i class="ti ti-check"></i></span>
                <span class="bs-stepper-label">
                  <span class="bs-stepper-title text-uppercase">Done</span>
                  <span class="bs-stepper-subtitle">Submit Report</span>
                </span>
              </button>
            </div>
          </div>

          <!-- Stepper Content -->
          <div class="bs-stepper-content p-1">
            <form onSubmit="return false">
              @csrf

              <!-- STEP 1 -->
              <div id="inputs" class="content active pt-4 pt-lg-0">
                <h6>Enter Activity Inputs</h6>
                <ul class="p-0 m-0">
                  <label class="form-label w-100">Total number of orders</label>
                  <input wire:model='total_orders' class="form-control form-control-lg" placeholder="E.g 9" type="text" />

                  <label class="form-label w-100 mt-3">Total revenue generated</label>
                  <input wire:model='total_revenue' class="form-control form-control-lg" placeholder="E.g 17000" type="text" />

                  <label class="form-label w-100 mt-3">Amount of food/beverage wasted</label>
                  <input wire:model='wastage' class="form-control form-control-lg" placeholder="E.g 4" type="text" />

                  <label class="form-label w-100 mt-3">Number of customer complaints</label>
                  <input wire:model='complaints_received' class="form-control form-control-lg" placeholder="E.g 0" type="text" />

                  <label class="form-label w-100 mt-3">Number of special meal requests</label>
                  <input wire:model='special_requests' class="form-control form-control-lg" placeholder="E.g 0" type="text" />

                  <label class="form-label w-100 mt-3">Number of items used</label>
                  <input wire:model='inventory_used' class="form-control form-control-lg" placeholder="E.g 0" type="text" />

                  <label class="form-label w-100 mt-3">Remaining stock count</label>
                  <input wire:model='inventory_remaining' class="form-control form-control-lg" placeholder="E.g 0" type="text" />

                  <label class="form-label w-100 mt-3">Total money spent</label>
                  <input wire:model='amount' class="form-control form-control-lg" placeholder="E.g 0" type="text" />
                </ul>

                <div class="col-12 d-flex justify-content-between mt-4">
                  <button class="btn btn-label-secondary btn-prev" disabled>Previous</button>
                  <button type="button" class="btn btn-primary btn-next" onclick="stepper.next()">Next</button>
                </div>
              </div>

              <!-- STEP 2 -->
              <div id="note" class="content pt-4 pt-lg-0">
                <h6>Report Summary Note</h6>
                <label class="form-label">Write your report note below</label>
                <textarea wire:model='notes' class="form-control" rows="3"></textarea>

                <div class="col-12 d-flex justify-content-between mt-4">
                  <button type="button" class="btn btn-label-secondary btn-prev" onclick="stepper.previous()">Previous</button>
                  <button type="button" class="btn btn-primary btn-next" onclick="stepper.next()">Next</button>
                </div>
              </div>

              <!-- STEP 3 -->
              <div id="files" class="content pt-4 pt-lg-0">
                <h6>Upload Report Files</h6>
                <label class="form-label">You can upload multiple files if needed</label>
                <x-filepond::upload wire:model="files" multiple />

                <div class="col-12 d-flex justify-content-between mt-4">
                  <button type="button" class="btn btn-label-secondary btn-prev" onclick="stepper.previous()">Previous</button>
                  <button type="button" class="btn btn-primary btn-next" onclick="stepper.next()">Next</button>
                </div>
              </div>

              <!-- STEP 4 -->
              <div id="submit" class="content pt-4 pt-lg-0 text-center">
                <h5 class="mb-1">SURE?</h5>
                <p class="small">Please select the receiver of this report.</p>

                <select wire:model="sent_to" class="form-select form-select-lg">
                  <option value="">--Select Receiver--</option>
                  <option value="1234">Maintenance Manager</option>
                </select>

                <div class="col-12 d-flex justify-content-between mt-4">
                  <button type="button" class="btn btn-label-secondary btn-prev" onclick="stepper.previous()">Previous</button>
                  <button wire:click='save' type="button" class="btn btn-success">
                    {{ $modal_flag ? 'Update Report' : 'Send Report' }}
                  </button>
                  <x-app-loader>Sending...</x-app-loader>
                </div>
              </div>

            </form>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>

<!-- INIT the Stepper -->
<script>
  document.addEventListener('DOMContentLoaded', function () {
    window.stepper = new Stepper(document.querySelector('#wizard-create-app'), {
      linear: false,
      animation: true
    });
  });
</script>

