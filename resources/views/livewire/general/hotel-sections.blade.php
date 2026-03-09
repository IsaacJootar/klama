<div>
    <x-input-error-messages/>

    <div class="container-xxl flex-grow-1 container-p-y">
            <!--/ page-label component -->
        <div>
            <x-home-page-label>Create and  Remove  Hotel Work Sections </x-home-page-label>
        </div>
         <!--/ action button component -->
    <div>
        <x-modal-home-create-button  data-bs-target="#addSection">Create section </x-modal-home-create-button>
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
                            <th>SECTIONS| DEPARTMENTS </th>

                        </tr>
                    </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($sections as $section )
                            <tr wire:key='{{$section->id}}'>
                                <td>{{$loop->index + 1}}</td>
                                <td>
                                    {{$section->section}}
                                </td>


                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!--/ section items -->

    </div>

<form>
@csrf
<!-- Add New sections Modal -->
<div  wire:ignore.self  class="modal fade" data-bs-focus="false" id="addSection" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered1 modal-simple modal-add-new-cc">
    <div class="modal-content">
      <div class="modal-body">
        <button wire:click='exit' type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

        <div class="text-center mb-6">

          <h4 class="mb-2"><x-home-page-label>{{$modal_title}}</x-home-page-label></h4>
        </div>

            <select wire:model="section" class="form-select form-select-lg"
                data-allow-clear="true">
                <option value="">--Select System section</option>
                <option value="Default">Normal Staff / User </option>
                <option value="FrontDesk_Reservations">FD (FrontF Desk | Reservations Officer) </option>
                <option value="Maintenance">MM (Maintenance ) </option>
                <option value="Logistics">LM (Logistics Manager | Supervisior) </option>
<<<<<<< HEAD
                <option value="Kitchen_And_Restaurant">KR (kitchen /Restaurant Manager | Supervisior) </option>
=======
                <option value="Kitchen_Restaurant">KR (kitchen /Restaurant Manager | Supervisior) </option>
>>>>>>> af17489a4476af6b8ac0e130fbe8c70cf0876cfa
                <option value="Room_HouseKeeping">HK (Room / House Keeping Manager | Supervisior) </option>
                <option value="Sales_Marketing">SM (Sale / Promo Manager | Supervisior) </option>
                <option value="Accounts_payroll">AP (Accounts / Payroll Manager | Supervisior) </option>
                <option value="ICT">IT (ICT Manager | Supervisior) </option>
            </select><br>
            <br>

                <div class="mb-6">

                    <label for="futureAddress" class="switch-label"><strong>Beside Customers</strong> every User will fall under a Section or Department</label>

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
<!--/ New sections  Modal -->


</div>
