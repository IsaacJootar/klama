<div>
    @php
         use Carbon\Carbon;
    @endphp
    <x-input-error-messages/>
    <div class="container-xxl flex-grow-1 container-p-y">
            <!--/ page-label component -->
        <div>
            <x-home-page-label>Send and Update Messages Here</x-home-page-label>
        </div>
         <!--/ action button component -->
    <div>
        <x-modal-home-create-plain-button  data-bs-toggle="modal" data-bs-target="#twoFactorAuth"> <i class="ti ti-messages"> </i>  Send Message </x-modal-home-create-plain-button>
    </div>
        <hr class="my-2">
        <div class="card">
<div class="table-responsive text-nowrap">

    <table class="table">
      <thead class="table-light">

                        <tr>
                            <th>SN</th>
                            <th>Message ID</th>
                            <th>Message</th>
                            <th>Sender</th>
                            <th>Receiver</th>



                        </tr>
                    </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($messages as $message )
                            <tr wire:key='{{$message->id}}'>
                                <td>{{$loop->index + 1}}</td>
                                <td>
                                    {{$message->message_id}}
                                </td>
                                <td>
                                    {{$message->message}}
                                </td>
                                <td>
                                    {{$message->sent_by}}
                                </td>
                                <td>
                                    {{$message->sent_to}}
                                </td>



                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!--/ Reports -->

    </div>



<!-- Two Factor Auth Modal -->

<div  wire:ignore.self  class="modal fade" id="twoFactorAuth" tabindex="-1" aria-hidden="true">

    <div class="modal-dialog modal-lg modal-dialog-centered modal-simple">
      <div class="modal-content">
        <div class="modal-body">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          <div class="text-center mb-6">
            <h4 class="mb-2">Select Messaging Channel</h4>
            <p>Please select a method by which will be sent by the system</p>
          </div>
          <div class="row">
            <div class="col-12 mb-6">
              <div class="form-check custom-option custom-option-basic">
                <label class="form-check-label custom-option-content" for="customRadioTemp1" data-bs-target="#twoFactorAuthOne" data-bs-toggle="modal">
                  <input name="customRadioTemp" class="form-check-input" type="radio" value="" id="customRadioTemp1" checked />
                  <span class="custom-option-header">
                    <span class="h6 mb-0 d-flex align-items-center"><i class="ti ti-mail me-1"></i>Send Message Via Email</span>
                  </span>
                  <span class="custom-option-body">
                    <small>This option will allow the system send your message to the reciever via Email.</small>
                  </span>
                </label>
              </div>
            </div>
            <div class="col-12">
              <div class="form-check custom-option custom-option-basic">
                <label class="form-check-label custom-option-content" for="customRadioTemp2" data-bs-target="#twoFactorAuthTwo" data-bs-toggle="modal">
                  <input name="customRadioTemp" class="form-check-input" type="radio" value="" id="customRadioTemp2" />
                  <span class="custom-option-header">
                    <span class="h6 mb-0 d-flex align-items-center"><i class="ti ti-message me-1"></i>Send Via System Messaging</span>
                  </span>
                  <span class="custom-option-body">
                    <small>This option will allow the system send your message through the the default system messaging.</small>
                  </span>
                </label>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <form onSubmit="return false">
    @csrf

  <!-- Via Email Massaging-->
  <div wire:ignore.self  class="modal fade" id="twoFactorAuthOne" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-simple">
      <div class="modal-content">
        <div class="modal-body">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          <div class="text-center mb-6">
            <h5 class="mb-0">Send Message Via Email</h5>
          </div>
          <div class="alert alert-warning alert-dismissible mb-4 mt-6" role="alert">
            <p class="mb-0">Enter Your Message in the box Below, select reciever's name and Send</p>
          </div>
          <div class="mb-6">
            <label for="note" class="fw-medium text-heading mb-1">Enter Message:</label>
              <textarea required wire:model='message' class="form-control" rows="2" id="note"></textarea>
          </div>
          <div class="text-end">
            <button type="button" class="btn btn-label-secondary me-3" data-bs-toggle="modal" data-bs-target="#twoFactorAuth"><span class="align-middle">Cancel</span></button>
            <button wire:click='sendEmail' type="button" class="btn btn-success" ><span class="align-middle">Send as eMail</span>  <i class="ti ti-send ti-16px ms-2 scaleX-n1-rtl"></i></></button>
            <x-app-loader> sending email...</x-app-loader>
        </div>
        </div>
      </div>
    </div>
  </div>

  <!-- via System Messaging-->
  <div wire:ignore.self  class="modal fade" id="twoFactorAuthTwo" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-simple">
      <div class="modal-content">
        <div class="modal-body">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="text-center mb-6">
              <h5 class="mb-0">Send Message Via System Messaging</h5>
            </div>
            <div class="alert alert-info alert-dismissible mb-4 mt-6" role="alert">
              <p class="mb-0">Enter Your Message in the box Below, select reciever's name and Send</p>
            </div>
            <div class="mb-6">
              <label for="note" class="fw-medium text-heading mb-1">Enter Message:</label>
                <textarea required  wire:model='message'   class="form-control" rows="2" id="note">Remove this default message and Wite your message here, be aware it wil be sent via default system messaging </textarea>
            </div>
            <div class="text-end">
              <button type="button" class="btn btn-label-secondary me-3" data-bs-toggle="modal" data-bs-target="#twoFactorAuth"><span class="align-middle">Cancel</span></button>
              <button wire:click='sendMessage' type="button" class="btn btn-success"><span class="align-middle">Send Message</span>  <i class="ti ti-send ti-16px ms-2 scaleX-n1-rtl"></i></i></button>
              <x-app-loader> sending...</x-app-loader>
            </div>
          </div>
      </div>
    </form>
    </div>
  </div>

    <!-- via System Messaging-->



    </div>

