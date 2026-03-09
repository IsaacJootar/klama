<div>
   @php
     use Carbon\Carbon;
   @endphp
@php
    use App\Http\Helpers\Helper;
@endphp

    <div class="container-xxl flex-grow-1 container-p-y">
        <div>
            <x-home-page-label>These  are available rooms for today {{Carbon::now()->format('l, jS \ F, Y')}}</x-home-page-label>
        </div>

        <p class="my-2">
        <div class="card">

<div class="table-responsive text-nowrap">
    <table id="myTable" class="table">
      <thead class="table-light">

                        <tr>
                            <th>SN</th>
                            <th>Room</th>
                            <th>Category</th>
                            <th>Value</th>
                          <th>Status</th>

                        </tr>
                    </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($availables as $available)


                            <tr wire:key='{{$available->id}}'>

                                <td>{{$loop->index + 1}}</td>
                                <td>{{Str::ucfirst($room = \App\Models\Room::where('id', $available->room_id)->value('name'))}}
                                </td>
                                <td>{{\App\Models\Roomcategory::where('id', $available->category_id)->value('category')}}
                                </td>

                    <td>

                                    {{Helper::format_currency($available->price)}}
                                </td>

                                <td><span class="badge bg-label-success me-1">Available</span></td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!--/ categories Rows -->

    </div>
</div>
