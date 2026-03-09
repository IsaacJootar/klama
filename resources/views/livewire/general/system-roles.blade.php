<div>
    <x-input-error-messages/>

    <div class="container-xxl flex-grow-1 container-p-y">
            <!--/ page-label component -->
        <div>
            <x-home-page-label>Create and  Remove  Default System Roles Here </x-home-page-label>
        </div>
         <!--/ action button component -->
    <div>
        <x-modal-home-create-button  data-bs-target="#addRole">Create Role </x-modal-home-create-button>
    </div>
        <hr class="my-2">
        <div class="card">
<div class="table-responsive text-nowrap">

<<<<<<< HEAD
    <table id="myTable" class="table">
=======
    <table class="table">
>>>>>>> af17489a4476af6b8ac0e130fbe8c70cf0876cfa
      <thead class="table-light">

                        <tr>
                            <th>SN</th>
                            <th>ROLE</th>
                        </tr>
                    </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($roles as $role )
                            <tr wire:key='{{$role->id}}'>
                                <td>{{$loop->index + 1}}</td>
                                <td>
                                    {{$role->role}}
                                </td>


                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!--/ role items -->

    </div>

<form>
@csrf
<!-- Add New roles Modal -->
<div  wire:ignore.self  class="modal fade" data-bs-focus="false" id="addRole" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered1 modal-simple modal-add-new-cc">
    <div class="modal-content">
      <div class="modal-body">
        <button wire:click='exit' type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

        <div class="text-center mb-6">

          <h4 class="mb-2"><x-home-page-label>{{$modal_title}}</x-home-page-label></h4>
        </div>

        <select wire:model="role" class="form-select form-select-lg"
        data-allow-clear="true">
        <option value="">--Select System Default Role--</option>
        <option value="default">Normal Staff | User </option>
        <option value="FD_Manager | Supervisior">FD (FrontF Desk | Reservations Officer) </option>
        <option value="MM_Manager | Supervisior">MM (Maintenance ) </option>
        <option value="LM_Manager | Supervisior">LM (Logistics Manager | Supervisior) </option>
        <option value="KR_Manager | Supervisior">KR (kitchen | Restaurant Manager | Supervisior) </option>
        <option value="HK_Manager | Supervisior">HK (Room  |House Keeping Manager | Supervisior) </option>
        <option value="SM_Manager | Supervisior">SM (Sale | Promo Manager | Supervisior) </option>
        <option value="AP_Manager | Supervisior">AP (Accounts | Payroll Manager | Supervisior) </option>
        <option value="IT_Manager | Supervisior">IT (ICT Manager | Supervisior) </option>
    </select><br>

            <br>




                <div class="mb-6">

                    <label for="futureAddress" class="switch-label"> <strong>Syetem Roles | Rights </strong> is what determines which section or whats actions a user can have access to or take.</label>


                </div>


          <div class="col-12 text-center">
            <button wire:click='save' type="button" class="btn btn-primary">Activate</button>
            <button wire:click='exit' type="button" class="btn btn-label-secondary btn-reset" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
           <x-app-loader/>
          </div>
        </form>
      </div>
    </div>
  </div>


</div>
<!--/ New roles  Modal -->


</div>
