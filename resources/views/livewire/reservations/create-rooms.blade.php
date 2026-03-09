<div>
    <x-input-error-messages/>

<hr class="my-2">

@csrf
<!-- Add New Room Modal -->
<div  wire:ignore.self  class="modal fade" data-bs-focus="false" id="createRoom" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered1 modal-simple modal-add-new-cc">
    <div class="modal-content">
      <div class="modal-body">
        <button wire:click='exit' type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

        <div class="text-center mb-6">

          <h4 class="mb-2"><x-home-page-label>{{$modal_title}}</x-home-page-label></h4>
        </div>
          <div class="col-12">
            <label class="form-label w-100" for="modalAddRoom">Room Name</label>
            <div class="input-group input-group-merge">
              <input wire:model='name' class="form-control form-control-lg" type="text" aria-describedby="modalAddRoom" />
              <span class="input-group-text cursor-pointer p-1" id="modalAddCard2"><span class="card-type"></span></span>
            </div>


            <br>
             <form wire:submit.prevent="store">
                 @csrf
          <div class="col-12 text-center">

         @if ($modal_flag) <!-- if flag is TRUE, display update action  button -->
            <button wire:click='update' type="button" class="btn btn-primary">Update</button>
            <button wire:click='exit' type="button" class="btn btn-label-secondary btn-reset" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
            <x-app-loader/>
        @else
            <button type="submit" class="btn btn-primary">Create</button>
            <button wire:click='exit' type="button" class="btn btn-label-secondary btn-reset" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
           <x-app-loader/>
        @endif
          </div>
        </form>
      </div>
    </div>
  </div>


</div>
<!--/ New Room  Modal -->


</div>
