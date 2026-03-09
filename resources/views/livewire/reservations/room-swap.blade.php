<div>
    @php
      use Carbon\Carbon;
    @endphp
@php
    use App\Http\Helpers\Helper;
@endphp

     <div class="container-xxl flex-grow-1 container-p-y">
             <!--/ page-label component -->
         <div>
             <x-home-page-label>These  are Swapped room(s) for the Current Month of {{Carbon::now()->format('F, Y') }} </x-home-page-label>
         </div>
          <!--/ action button component -->

          <p class="my-2">
         <div class="card">

 <div class="table-responsive text-nowrap">
     <table class="table">
       <thead class="table-light">

                         <tr>
                             <th>SN</th>
                               <th>swapped By</th>
                             <th>Type of Room Swap </th>
                             <th>Swapped From</th>
                              <th>Swapped To</th>
                             <th>Swapped From Category</th>
                              <th>Swapped To Category</th>
                             <th> Reservation ID (Swapped From)</th>
                              <th> Reservation ID (Swapped To)</th>
                             <th>Customer (Swapped From)</th>
                             <th>Customer (Swapped To)</th>
                             <th>Phone (Swapped To)</th>
                             <th>Email (Swapped To)</th>
                           
                             <th>Swap Value</th>
                         </tr>
                     </thead>
                         <tbody class="table-border-bottom-0">
                             @foreach ($swaps as $swap)


                             <tr wire:key='{{$swap->id}}'>

                                 <td>{{$loop->index + 1}}</td>
                                 <td>{{Str::ucfirst(\App\Models\User::where('id', $swap->user_id)->value('name'))}}
                                </td>

                               <td>{{$swap->swap_type}}</td>
                                <td>{{Str::ucfirst(\App\Models\Room::where('id', $swap->swap_from_id)->value('name'))}}</td>
                                  <td>{{Str::ucfirst(\App\Models\Room::where('id', $swap->swap_to_id)->value('name'))}}</td>
                           
                                <td>{{Str::ucfirst(\App\Models\Roomcategory::where('id', $swap->from_category_id)->value('category'))}}</td>
                                 <td>{{Str::ucfirst(\App\Models\Roomcategory::where('id', $swap->to_category_id)->value('category'))}}</td>
                                <td>{{$swap->from_reservation_id ?? 'N/A'}}</td>
                                <td>{{$swap->to_reservation_id ?? 'N/A'}}</td>
                                <td>{{$swap->customer ?? 'N/A'}}</td>
                                <td>{{$swap->to_customer ?? 'N/A'}}</td>
                                <td>{{$swap->to_phone ?? 'N/A'}}</td>
                                <td>{{$swap->to_email ?? 'N/A'}}</td>
                                <td>{{Helper::format_currency($swap->new_value)}}</td>
                                 </tr>
                             @endforeach
                         </tbody>
                     </table>
                 </div>



       

             </div>
             <!--/ swaps rooms Rows -->

     </div>
 </div>
