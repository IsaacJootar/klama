<div>
    @php
         use Carbon\Carbon;
    @endphp
    <x-input-error-messages/>
    <div class="container-xxl flex-grow-1 container-p-y">
            <!--/ page-label component -->
        <div>
            <x-home-page-label>Messaging History</x-home-page-label>
        </div>
         <!--/ action button component -->
    <div>
        <x-modal-home-create-plain-button  data-bs-toggle="modal" data-bs-target="#twoFactorAuth"> <i class="ti ti-messages"> </i>  Send Message </x-modal-home-create-plain-button>
    </div>
        <hr class="my-2">
        <div class="card">
<div class="table-responsive text-nowrap">

    <table id="myTable" class="table">
      <thead class="table-light">

                        <tr>
                            <th>SN</th>
                            <th>Message ID</th>
                            <th>Message</th>
                            <th>Sender</th>
                            <th>Receiver</th>
                            <th>Channel</th>
                            <th>Date / Time </th>
                            <th>Duration</th>



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
                                <td>
                                    {{Helper::get_message_channel_flag($message->message_id)}}
                                </td>
                                <td>
                                    {{$message->created_at}}
                                </td>
                                <td>
                                    <p  class="badge bg-label-info ms-1">
                                        {{ Carbon::parse($message->created_at)->diffForHumans();}}
                                      </p>
                                </td>


                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!--/ Reports -->

    </div>


    </div>

