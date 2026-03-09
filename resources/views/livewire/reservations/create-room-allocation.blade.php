<div>
    <x-input-error-messages/>

    <hr class="my-2">
   
  
    <!-- Add New Room Modal -->
    <div  wire:ignore.self class="modal fade" id="roomAllocationModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered1 modal-simple modal-add-new-cc">
        <div class="modal-content">
          <div class="modal-body">
            <button wire:click='exit' type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="text-center mb-6">

              <h4 class="mb-2"><x-home-page-label>{{$modal_title}}</x-home-page-label></h4>
            </div>
  <form onSubmit="return false">
   @csrf
            <label for="selectRoom" class="form-label">Select Room</label>
                <select wire:model="room_id"  class="form-select form-select-lg" data-allow-clear="true">
                    <option value="">--Select Room--</option>
                    @foreach ($rooms as $room)

                    <option value="{{$room->id}}">{{$room->name}}</option>
                    @endforeach
                  </select><br>

                <label for="selectCat" class="form-label">Select Room Category</label>
                <select wire:model="category_id" class="form-select form-select-lg" data-allow-clear="true">
                    <option value="">--Select Room--</option>
                    @foreach ($categories as $category)

                    <option value="{{$category->id}}">{{$category->category}}</option>
                    @endforeach
                  </select><br>
                  <label class="form-label w-100" for="modalAddValue">Assign Value Amount</label>
            <div class="input-group input-group-merge">
              <input wire:model='price' class="form-control form-control-lg" type="text" aria-describedby="modalAllocate" />
              <span class="input-group-text cursor-pointer p-1" id="modalAddCard2"><span class="card-type"></span></span>
            </div><br>

              <div class="col-12">

              <div class="col-12 text-center">

                @if ($modal_flag) <!-- if flag is TRUE, display update action  button -->
                <button wire:click='update' type="button" class="btn btn-primary">Update</button>
                <button wire:click='exit' type="button" class="btn btn-label-secondary btn-reset" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                <x-app-loader></x-app-loader>
            @else
                <button wire:click='store' type="button" class="btn btn-primary">Allocate</button>
                <button wire:click='exit' type="button" class="btn btn-label-secondary btn-reset" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
               <x-app-loader></x-app-loader>
                @endif
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!--/ New Room  Modal -->


    </div>
