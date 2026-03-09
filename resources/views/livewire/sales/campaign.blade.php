<div>
    <x-input-error-messages/>

    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Page Label -->
        <div>
            <x-home-page-label>Manage Sales Campaigns Here</x-home-page-label>
        </div>

        <!-- Action Button -->
        <div>
            <x-modal-home-create-button data-bs-target="#addCampaign">Create Campaign</x-modal-home-create-button>
        </div>
        <hr class="my-2">

        <!-- Campaigns Table -->
        <div class="card">
            <div class="table-responsive text-nowrap">
                <table id="myTable" class="table">
                    <thead class="table-light">
                        <tr class="bg-gray-200 text-left">
                            <th>SN</th>
                            <th>Campaign Name</th>
                            <th>Type</th>
                            <th>Validity</th>
                            <th>Budget</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($campaigns as $campaign)
                            <tr wire:key="{{ $campaign->id }}">
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $campaign->campaign_name }}</td>
                                <td>{{ ucfirst($campaign->campaign_type) }}</td>
                                <td>
                                    {{ $campaign->start_date->format('Y-m-d') }} -
                                    {{ $campaign->end_date->format('Y-m-d') }}
                                </td>
                                <td>
                                    @if($campaign->budget)
                                        ${{ number_format($campaign->budget, 2) }}
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>{{ ucfirst($campaign->status) }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                            <i class="ti ti-dots-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <!--<a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#addCampaign" wire:click="edit({{ $campaign->id }})">-->
                                            <!--    <i class="ti ti-pencil me-1"></i> Edit-->
                                            <!--</a>-->
                                            <a class="dropdown-item" href="javascript:void(0)"
                                               wire:confirm="Are you sure you want to delete this campaign?"
                                               wire:click="delete({{ $campaign->id }})">
                                                <i class="ti ti-trash me-1"></i> Delete
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
        <!-- End Campaigns Table -->
    </div>

    <!-- Modal for Create/Edit Campaign -->
    <form>
        @csrf
        <div wire:ignore.self class="modal fade" data-bs-focus="false" id="addCampaign" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered1 modal-simple modal-add-new-cc">
                <div class="modal-content">
                    <div class="modal-body">
                        <button wire:click="exit" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                        <div class="text-center mb-6">
                            <h4 class="mb-2"><x-home-page-label>{{ $modal_title }}</x-home-page-label></h4>
                        </div>

                        <div class="col-12">
                            <!-- Campaign Name -->
                            <label class="form-label w-100" for="campaignName">Campaign Name</label>
                            <div class="input-group input-group-merge">
                                <input wire:model="campaign_name" class="form-control form-control-lg" type="text" id="campaignName" placeholder="Enter campaign name" />
                            </div>
                            <br>

                            <!-- Campaign Type -->
                            <label class="form-label w-100" for="campaignType">Campaign Type</label>
                            <select wire:model="campaign_type" class="form-select form-select-lg" id="campaignType">
                                <option value="email">Email</option>
                                <option value="social_media">Social Media</option>
                            </select>
                            <br>

                            <!-- Description -->
                            <label class="form-label w-100" for="description">Description</label>
                            <textarea wire:model="description" class="form-control form-control-lg" id="description" placeholder="Enter campaign description"></textarea>
                            <br>

                            <!-- Start Date -->
                            <label class="form-label w-100" for="startDate">Start Date</label>
                            <div class="input-group input-group-merge">
                                <input wire:model="start_date" class="form-control form-control-lg" type="date" id="startDate" />
                                <span class="input-group-text cursor-pointer p-1">
                                    <i class="ti ti-calendar"></i>
                                </span>
                            </div>
                            <br>

                            <!-- End Date -->
                            <label class="form-label w-100" for="endDate">End Date</label>
                            <div class="input-group input-group-merge">
                                <input wire:model="end_date" class="form-control form-control-lg" type="date" id="endDate" />
                                <span class="input-group-text cursor-pointer p-1">
                                    <i class="ti ti-calendar"></i>
                                </span>
                            </div>
                            <br>

                            <!-- Budget -->
                            <label class="form-label w-100" for="budget">Budget</label>
                            <div class="input-group input-group-merge">
                                <input wire:model="budget" class="form-control form-control-lg" type="number" id="budget" placeholder="Budget" step="0.01" />
                                <span class="input-group-text cursor-pointer p-1">
                                    <i class="ti ti-currency-dollar"></i>
                                </span>
                            </div>
                            <br>

                            <!-- Performance Metrics -->
                            <label class="form-label w-100" for="performanceMetrics">Performance Metrics (JSON)</label>
                            <textarea wire:model="performance_metrics" class="form-control form-control-lg" id="performanceMetrics" placeholder='e.g., {"clicks": 0, "impressions": 0}'></textarea>
                            <br>

                            <!-- Status -->
                            <label class="form-label w-100" for="status">Status</label>
                            <select wire:model="status" class="form-select form-select-lg" id="status">
                                <option value="planned">Planned</option>
                                <option value="active">Active</option>
                                <option value="completed">Completed</option>
                                <option value="cancelled">Cancelled</option>
                            </select>
                        </div>

                        <div class="col-12 text-center mt-4">
                            <button wire:click="save" type="button" class="btn btn-primary">
                                {{ $modal_flag ? 'Update' : 'Save' }}
                            </button>
                            <button wire:click="exit" type="button" class="btn btn-label-secondary btn-reset" data-bs-dismiss="modal" aria-label="Close">
                                Cancel
                            </button>
                            <x-app-loader/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
