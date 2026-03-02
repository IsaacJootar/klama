<div>
    <x-input-error-messages/>

    <div class="container-xxl flex-grow-1 container-p-y">
            <!--/ page-label component -->
        <div>
            <x-home-page-label>Create, update and delete Maintenance Request Here </x-home-page-label>
        </div>
         <!--/ action button component -->
    <div>
        <x-modal-home-create-button  data-bs-target="#addAsset">Create Maintenance Request </x-modal-home-create-button>
    </div>
        <hr class="my-2">
        <div class="card">
<div class="table-responsive text-nowrap">

    <table id="myTable" class="table">
      <thead class="table-light">

        <tr class="bg-gray-200 text-left">
                    <th>SN</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Priority</th>
                    <th>Department</th>
                    <th>Assigned To</th>
                    <th>Asset</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($requests as $request)
                    <tr wire:key='{{$request->id}}'>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $request->title }}</td>
                        <td>{{ $request->description }}</td>
                        <td>{{ $request->status }}</td>
                        <td>{{ $request->priority }}</td>
                        <td>{{ $request->department_id }}</td>
                        <td> {{ DB::table('maint_technicians')->where('id', $request->assigned_to)->value('name') ?? 'N/A' }}  </td>
                        <td>{{ DB::table('maint_assets')->where('id', $request->asset_id)->value('name') ?? 'N/A' }}</td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="ti ti-dots-vertical"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#addAsset" wire:click="edit({{ $request->id }})">
                                        <i class="ti ti-pencil me-1"></i> Edit
                                    </a>
                                    <a class="dropdown-item" href="javascript:void(0)"
                                     wire:confirm="Are you sure you want to proceed and delete this Maintenance Request?"
                                    wire:click="delete({{ $request->id }})">
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
    <!--/ Assets items -->

</div>

<form>
@csrf
<!-- Add New Fleet Item -->
<div  wire:ignore.self  class="modal fade" data-bs-focus="false" id="addAsset" tabindex="-1" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered1 modal-simple modal-add-new-cc">
<div class="modal-content">
  <div class="modal-body">
    <button wire:click='exit' type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

    <div class="text-center mb-6">

      <h4 class="mb-2"><x-home-page-label>{{$modal_title}}</x-home-page-label></h4>
    </div>


      <div class="col-12">

        <label class="form-label w-100" for="modaladdFleet">Title </label>
        <div class="input-group input-group-merge">
          <input wire:model='title' class="form-control form-control-lg" type="text" aria-describedby="modaladdFleet" placeholder="Maintenance Request Title" />
          <span class="input-group-text cursor-pointer p-1" id="modalAddCard2"><span class="card-type"></span></span>
        </div>
            <br>
                <label class="form-label w-100" for="modalAddValue">Description</label>
                <div class="input-group input-group-merge">
                    <textarea wire:model="description" placeholder="Store or Room 1" class="form-control form-control-lg"></textarea>
                    <span class="input-group-text cursor-pointer p-1" id="modalAddCard2"><span
                            class="card-type"></span></span>
                </div>
                <br>
        <label for="status" class="form-label">Status</label>
        <select wire:model="status" class="form-select form-select-lg"
            data-allow-clear="true">
            <option value="">--Select Status--</option>
            <option value="Open">Open</option>
            <option value="In Progress">In Progress</option>
            <option value="Resolved">Resolved</option>
            <option value="Closed">Closed</option>
        </select>
        <br>
        <label for="status" class="form-label">Priority</label>
        <select wire:model="priority" class="form-select form-select-lg"
            data-allow-clear="true">
            <option>--Select Priority--</option>
            <option value="Low">Low</option>
            <option value="Medium">Medium</option>
            <option value="High">High</option>
        </select>
        <br>

        {{-- <label for="status" class="form-label">Department</label>
        <select wire:model="department_id" class="form-select form-select-lg" data-allow-clear="true">
            <option value="">--Select Department-</option>
            @foreach (users as user)

            <option value="{{$department->id}}">{{$department->name}}</option>
            @endforeach
          </select><br>
--}}
          <label for="status" class="form-label">Assigned To</label>
          <select wire:model="assigned_to" class="form-select form-select-lg" data-allow-clear="true">
              <option value="">--Select Technician-</option>
              @foreach ($technicians as $technician)

              <option value="{{$technician->id}}">{{$technician->name}}</option>
              @endforeach
            </select><br>

            <label for="status" class="form-label">Asset </label>
            <select wire:model="asset_id" class="form-select form-select-lg" data-allow-clear="true">
                <option value="">--Select Asset-</option>
                @foreach ($assets as $asset)

                <option value="{{$asset->id}}">{{$asset->name}}</option>
                @endforeach
              </select><br>

      <div class="col-12 text-center">
        <!-- if flag is TRUE, display update action  button -->
        <button wire:click='save' type="button" class="btn btn-primary">{{$modal_flag ? 'Update' : 'Save'}}</button>
        <button wire:click='exit' type="button" class="btn btn-label-secondary btn-reset" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
        <x-app-loader/>
      </div>
    </form>
  </div>
</div>
</div>


</div>
<!--/ Asset Modal -->

</div>

