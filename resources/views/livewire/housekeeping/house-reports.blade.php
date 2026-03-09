<div>
    <x-input-error-messages/>
    <div class="container-xxl flex-grow-1 container-p-y">
        <!--/ Page Label Component -->
        <div>
            <x-home-page-label>Send and Update Your Daily, Weekly, or Monthly Report Here</x-home-page-label>
        </div>

        <!--/ Action Button Component -->
        <div>
            <x-modal-home-create-plain-button data-bs-target="#createApp">
                <i class="ti ti-file-text"></i> Send Report
            </x-modal-home-create-plain-button>
        </div>

        <hr class="my-2">
        <div class="card">
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead class="table-light">
                        <tr>
                            <th>SN</th>
                            <th>Total Orders</th>
                            <th>Total Revenue</th>
                            <th>Wastage</th>
                            <th>Complaints</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($reports as $report)
                        <tr wire:key='{{$report->id}}'>
                            <td>{{$loop->index + 1}}</td>
                            <td>{{$report->total_orders}}</td>
                            <td>{{$report->total_revenue}}</td>
                            <td>{{$report->wastage}}</td>
                            <td>{{$report->complaints_received}}</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                        <i class="ti ti-dots-vertical"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a wire:click="edit({{ $report->id }})" data-bs-toggle="modal" data-bs-target="#createApp" class="dropdown-item" href="javascript:void(0);">
                                            <i class="ti ti-pencil me-1"></i> Edit
                                        </a>
                                        <a wire:click='destroy({{ $report->id }})'
                                            wire:confirm="Are you sure you want to proceed and delete this item?"
                                            class="dropdown-item" href="javascript:void(0);">
                                            <i class="ti ti-search me-1"></i> View Report
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
                        </div>

                        <div class="bs-stepper-content p-1">
                            <form onSubmit="return false">
                                @csrf

                                <!-- Summary Inputs -->
                                <div id="inputs" class="content pt-4 pt-lg-0">
                                    <h6>Enter Activity Inputs</h6>
                                    <label class="form-label w-100">Total Orders</label>
                                    <input wire:model='total_orders' class="form-control form-control-lg" type="text" placeholder="E.g. 150" />

                                    <label class="form-label w-100">Total Revenue</label>
                                    <input wire:model='total_revenue' class="form-control form-control-lg" type="text" placeholder="E.g. 30000.50" />

                                    <label class="form-label w-100">Wastage</label>
                                    <input wire:model='wastage' class="form-control form-control-lg" type="text" placeholder="E.g. 5" />

                                    <label class="form-label w-100">Complaints Received</label>
                                    <input wire:model='complaints_received' class="form-control form-control-lg" type="text" placeholder="E.g. 2" />

                                    <div class="col-12 d-flex justify-content-between mt-6">
                                        <button class="btn btn-label-secondary btn-prev" disabled>
                                            <i class="ti ti-arrow-left ti-xs me-sm-2 me-0"></i> Previous
                                        </button>
                                        <button class="btn btn-primary btn-next">
                                            Next <i class="ti ti-arrow-right ti-xs"></i>
                                        </button>
                                    </div>
                                </div>

                                <!-- Summary Note -->
                                <div id="note" class="content pt-4 pt-lg-0">
                                    <h6>Report Summary Note</h6>
                                    <textarea wire:model='note' class="form-control" rows="3" placeholder="Enter summary note"></textarea>

                                    <div class="col-12 d-flex justify-content-between mt-6">
                                        <button class="btn btn-label-secondary btn-prev">
                                            <i class="ti ti-arrow-left ti-xs me-sm-2 me-0"></i> Previous
                                        </button>
                                        <button class="btn btn-primary btn-next">
                                            Next <i class="ti ti-arrow-right ti-xs"></i>
                                        </button>
                                    </div>
                                </div>

                                <!-- Submit -->
                                <div id="submit" class="content text-center pt-4 pt-lg-0">
                                    <h5 class="mb-1">SURE?</h5>
                                    <p class="small">Please select the receiver of this report.</p>
                                    <select wire:model="sent_to" class="form-select form-select-lg">
                                        <option value="">--Select Receiver--</option>
                                        <option value="1234">F&B Manager</option>
                                    </select><br>

                                    <div class="col-12 d-flex justify-content-between mt-6">
                                        <button class="btn btn-label-secondary btn-prev">
                                            <i class="ti ti-arrow-left ti-xs me-sm-2 me-0"></i> Previous
                                        </button>
                                        <button wire:click='save' type="button" class="btn btn-success">
                                            {{$modal_flag ? 'Update Report' : 'Send Report'}}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
