<div>
    <x-input-error-messages/>

    <hr class="my-2">
    <div wire:ignore.self class="modal-onboarding modal fade animate__animated" id="onboardingSlideModal" tabindex="-1"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content text-center">
                <div class="modal-header border-0">
                    <button wire:click='exit' type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close">
                    </button>
                </div>
                <div id="modalCarouselControls" class="carousel slide pb-6 mb-2" data-bs-interval="false">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#modalCarouselControls" data-bs-slide-to="0"
                            class="active"></button>
                        <button type="button" data-bs-target="#modalCarouselControls" data-bs-slide-to="1"></button>
                        <button type="button" data-bs-target="#modalCarouselControls" data-bs-slide-to="2"></button>
                    </div>
                    <div class="carousel-inner">

                        <span class="badge bg-label-primary me-1">Give Your Room Category a Name. </span><span
                            class="badge bg-label-danger me-1">Add Room Category Details</span><span
                            class="badge bg-label-warning me-1"> Assign Special Offers</span> <span
                            class="badge bg-label-success me-1"> Upload Room Category Image</span>
                        <div class="bs-stepper vertical wizard-modern wizard-modern-vertical-icons-example mt-2">
                            <div class="bs-stepper-header">

                                <div class="step" data-target="#account-details-vertical-modern">
                                    <button type="button" class="step-trigger">

                                        <span class="bs-stepper-circle">

                                            <i class="ti ti-file-description"></i>
                                        </span>
                                        <span class="bs-stepper-label">
                                            <span class="bs-stepper-title">Category Name</span>
                                            <span class="bs-stepper-subtitle">Create Room Category Name</span>
                                        </span>
                                    </button>
                                </div>
                                <div class="line"></div>
                                <div class="step" data-target="#categoryname">
                                    <button type="button" class="step-trigger">
                                        <span class="bs-stepper-circle">
                                            <i class="ti ti-plus"></i>
                                        </span>
                                        <span class="bs-stepper-label">
                                            <span class="bs-stepper-title">Special Offers</span>
                                            <span class="bs-stepper-subtitle">check special offers appropriately</span>
                                        </span>
                                    </button>
                                </div>
                                <div class="line"></div>
                                <div class="step" data-target="#social-links-vertical-modern">
                                    <button type="button" class="step-trigger">
                                        <span class="bs-stepper-circle"><i class="ti ti-brand-instagram"></i>
                                        </span>
                                        <span class="bs-stepper-label">
                                            <span class="bs-stepper-title">Upload Category Image</span>
                                            <span class="bs-stepper-subtitle">Image should be clear and catchy</span>
                                        </span>
                                    </button>
                                </div>
                            </div>
                            <div class="bs-stepper-content">
                                <form onSubmit="return false">
                                    @csrf

                                    <!-- Category Details -->

                                    <div id="account-details-vertical-modern" class="content">
                                        <div class="content-header mb-4">
                                            <h6 class="mb-0">Category Name & Details</h6>
                                            <small>Enter Category Name & Details</small>
                                        </div>
                                        <div class="row g-6">
                                            <div class="col-sm-6">
                                                <label class="form-label" for="name-modern-vertical">Name</label>
                                                <input wire:model="category" type="text" id="name-modern-vertical"
                                                    class="form-control form-control-lg" placeholder="E.g Delux" />
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label" for="details-modern-vertical">Details</label>
                                                <input wire:model="details" type="text" id="details-modern-vertical"
                                                    class="form-control form-control-lg" placeholder="Enter..."
                                                    aria-label="Enter..." />
                                            </div>


                                            <div class="col-12 d-flex justify-content-between">
                                                <button class="btn btn-label-secondary btn-prev" disabled> <i
                                                        class="ti ti-arrow-left ti-xs me-sm-2"></i>
                                                    <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                                </button>
                                                <button class="btn btn-primary btn-next"> <span
                                                        class="align-middle d-sm-inline-block d-none me-sm-2">Next</span>
                                                    <i class="ti ti-arrow-right ti-xs"></i></button>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Personal Info -->
                                    <div id="categoryname" class="content">
                                        <div class="content-header mb-4">
                                            <h6 class="mb-0">Add Special Offers</h6>
                                            <small>Please Check Appropriately</small>
                                        </div>
                                        <div class="row g-6">
                                            <table class="table">
                                                <thead class="border-top">
                                                    <tr>

                                                        <th class="text-nowrap text-center"><i
                                                                class="fas fa-fa fa-coffee"> Breakfast</i> </th>
                                                        <th class="text-nowrap text-center"><i
                                                                class="fas fa-concierge-bell"> Lunch</i></th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>


                                                        <td>
                                                            <div class="form-check d-flex justify-content-center">
                                                                <input wire:model="breakfast" class="form-check-input"
                                                                    type="checkbox" id="defaultCheck2"

                                                                    @php
                                                                    if($breakfast == 1){ echo 'checked';}

                                                                    @endphp

                                                                    />
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check d-flex justify-content-center">
                                                                <input wire:model="lunch" class="form-check-input"
                                                                    type="checkbox" id="defaultCheck3"

                                                                    @php
                                                                    if($lunch == 1){ echo 'checked';}

                                                                    @endphp
                                                                    />
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <thead class="border-top">
                                                        <tr>

                                                            <th class="text-nowrap text-center"> <i
                                                                    class="fas fa-wifi"> Wifi</i></th>

                                                            <th class="text-nowrap text-center"><i
                                                                    class="fas fa-tshirt"> Laundry</i> </th>

                                                        </tr>
                                                    </thead>
                                                    <tr>


                                                        <td>
                                                            <div class="form-check d-flex justify-content-center">

                                                                <input wire:model="wifi" class="form-check-input"
                                                                    type="checkbox" id="defaultCheck5"

                                                                    @php
                                                                    if($wifi == 1){ echo 'checked';}

                                                                    @endphp
                                                                    />
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check d-flex justify-content-center">
                                                                <input wire:model="laundry" class="form-check-input"
                                                                    type="checkbox" id="defaultCheck6"



                                                                    @php
                                                                    if($laundry == 1){ echo 'checked';}

                                                                    @endphp/>
                                                            </div>
                                                        </td>
                                                    </tr>


                                                </tbody>
                                            </table>


                                            <div class="col-12 d-flex justify-content-between">
                                                <button class="btn btn-label-secondary btn-prev"> <i
                                                        class="ti ti-arrow-left ti-xs me-sm-2"></i>
                                                    <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                                </button>
                                                <button class="btn btn-primary btn-next"> <span
                                                        class="align-middle d-sm-inline-block d-none me-sm-2">Next</span>
                                                    <i class="ti ti-arrow-right ti-xs"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Social Links -->
                                    <div id="social-links-vertical-modern" class="content">
                                        <div class="content-header mb-4">
                                            <div class="mb-4">
                                                <label for="formFileMultiple" class="form-label">You can upload Multiple files at once if necessary</label>
                                                <x-filepond::upload wire:model="files" multiple />
                                              </div>
                                        </div>
                                        <div class="row g-6">


                                            <div class="col-12 d-flex justify-content-between">
                                                <button class="btn btn-label-secondary btn-prev"> <i
                                                        class="ti ti-arrow-left ti-xs me-sm-2"></i>
                                                    <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                                </button>
                                                @if ($modal_flag)
                                                    <!-- if flag is TRUE, display update action  button -->
                                                    <button wire:click='update' class="btn btn-success">Update</button>
                                                    <x-app-loader/>
                                                @else
                                                    <button wire:click='store' class="btn btn-success">Create Category</button>
                                                    <x-app-loader/>
                                                    <button wire:click='exit'
                                                        class="btn btn-label-secondary btn-reset"
                                                        data-bs-dismiss="modal" aria-label="Close">Exit</button>

                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>

                    </div>


                </div>

            </div>
            <!-- Modern -->
            <!-- / Content -->





        </div>


    </div>
