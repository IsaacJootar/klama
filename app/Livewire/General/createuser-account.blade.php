<div>
    <x-input-error-messages/>

    <div class="container-xxl flex-grow-1 container-p-y">
            <!--/ page-label component -->
        <div>
            <x-home-page-label>Create, Update and Delete User Accounts  Here </x-home-page-label>
        </div>
         <!--/ action button component -->
    <div>
        <x-modal-home-create-button  data-bs-target="#addUser">Create user Item </x-modal-home-create-button>
    </div>
        <hr class="my-2">
        <div class="card">
<div class="table-responsive text-nowrap">

    <table class="table">
      <thead class="table-light">

                        <tr>
                            <th>SN</th>
                            <th>Item Category</th>
                            <th>Item Name</th>
                            <th>Item Number</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($users as $user )
                            <tr wire:key='{{$user->id}}'>
                                <td>{{$loop->index + 1}}</td>
                                <td>
                                    {{$user->name}}
                                </td>
                                <td>
                                    {{$user->email}}
                                </td>
                                <td>
                                    {{$user->role}}
                                </td>

                                <td>
                                    {{$user->section}}
                                </td>

                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown"><i class="ti ti-dots-vertical"></i></button>
                                        <div class="dropdown-menu">
                                            <a wire:click="edit({{ $user->id }})" data-bs-toggle="modal" data-bs-target="#addUser" class="dropdown-item" href="javascript:void(0);"><i
                                                class="ti ti-pencil me-1"></i> Edit</a>
                                            <a wire:click='destroy({{ $user->id }})'
                                                wire:confirm="Are you sure you want to proceed and delete this user?"
                                                class="dropdown-item" href="javascript:void(0);"><i
                                                    class="ti ti-trash me-1"></i> Delete</a>
                                        </div>
                                    </div>
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!--/ user items -->

    </div>

    <form>
    @csrf
    <!-- Add New user Item -->
    <div  wire:ignore.self  class="modal fade" id="addUser" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered1 modal-simple modal-add-new-cc">
        <div class="modal-content">
          <div class="modal-body">
            <button wire:click='exit' type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            <div class="text-center mb-6">

              <h4 class="mb-2"><x-home-page-label>{{$modal_title}}</x-home-page-label></h4>
            </div>
              <div class="col-12">

                <label class="form-label w-100" for="modalAddValue">Enter User Name</label>
                        <div class="input-group input-group-merge">
                            <input wire:model='name' class="form-control form-control-lg" type="text"
                                aria-describedby="modalItemName" />
                            <span class="input-group-text cursor-pointer p-1" id="modalAddCard2"><span
                                    class="card-type"></span></span>
                        </div><br>
                <label class="form-label w-100" for="modaladduser">Enter User Email </label>
                <div class="input-group input-group-merge">
                  <input wire:model='email' class="form-control form-control-lg" type="email" aria-describedby="modaladduser" placeholder="Enter..." />
                  <span class="input-group-text cursor-pointer p-1" id="modalAddCard2"><span class="card-type"></span></span>
                </div><br>

                <label class="form-label w-100" for="modaladduser">Choose Password </label>
                <div class="input-group input-group-merge">
                  <input wire:model='password' class="form-control form-control-lg" type="password" aria-describedby="modaladduser" placeholder="Enter..." />
                  <span class="input-group-text cursor-pointer p-1" id="modalAddCard2"><span class="card-type"></span></span>
                </div><br>
                        <label for="selectCat" class="form-label">Roles/Permissions</label>
                        <select wire:model="role" class="form-select form-select-lg"
                            data-allow-clear="true">
                            <option value="">--Select user Role--</option>
                            <option value="truck">Normal Staff / User </option>
                            <option value="truck">HD (Help Desk | Reservations Officer) </option>
                            <option value="car">MM (Maintenance ) </option>
                            <option value="motocycle">LM (Logistics Manager | Supervisior) </option>
                            <option value="ambulance">KR (kitchen /Restaurant Manager | Supervisior) </option>
                            <option value="ambulance">HK (Room / House Keeping Manager | Supervisior) </option>
                            <option value="ambulance">SM (Sale / Promo Manager | Supervisior) </option>
                            <option value="ambulance">AP (Accounts / Payroll Manager | Supervisior) </option>
                            <option value="ambulance">IT (ICT Manager | Supervisior) </option>

                        </select><br>


                        <label for="selectCat" class="form-label">Section / Department</label>
                        <select wire:model="section" class="form-select form-select-lg"
                        data-allow-clear="true">
                        <option value="">--Select User Section / Department--</option>
                        <option value="HelpDesk|Reservations">Help Desk | Reservations </option>
                        <option value="Maintenance">Maintenance  </option>
                        <option value="Logistics">Logistics </option>
                        <option value="Kitchen|Restaurant">kitchen|Restaurant </option>
                        <option value="Room|House|Keeping">Room|House Keeping </option>
                        <option value="Sales|Marketing">Sales|Marketing </option>
                        <option value="Accounts">Accounts </option>
                        <option value="ambulance">ICT </option>

                    </select><br>
                        <div class="form-check form-switch">
                            <input checked type="checkbox"  class="form-check-input" id="futureAddress" />
                            <label for="futureAddress" class="switch-label">Assign  User <strong>Role & Rights.</strong> .</label>



                            <div class="mb-6">
                              <label for="role" class="form-label"> Dont worry you can change roles anytime</label>

                            </div>

                          </div>
    <br>
              <div class="col-12 text-center">
                <!-- if flag is TRUE, display update action  button -->
                <button wire:click='save' type="button" class="btn btn-primary">{{$modal_flag ? 'Update' : 'Create'}}</button>
                <button wire:click='exit' type="button" class="btn btn-label-secondary btn-reset" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                <x-app-loader/>
              </div>
            </form>
          </div>
        </div>
      </div>


    </div>
    <!--/ New Feet Item Modal -->

    </div>

