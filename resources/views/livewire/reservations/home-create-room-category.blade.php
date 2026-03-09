<div>



    <div class="container-xxl flex-grow-1 container-p-y">
        <!--/ page-label component -->
        <div>
            <x-home-page-label>Create, update and remove hotel room categories Here </x-home-page-label>
        </div>
        <!--/ action button component -->
        <div><x-modal-home-create-button data-bs-target="#onboardingSlideModal">Create Category</x-modal-home-create-button></div>
        <hr class="my-2">
        <div class="card">
            @php
            /*
            abandoned in favour of toastr Notifications
            <x-input-success-message />

            <x-custom-error-message />
            */
            @endphp
            <div class="table-responsive text-nowrap">
                <table id="myTable" class="table">
                    <thead class="table-light">
                        <tr>
                            <th>SN</th>
                            <th>Category</th>
                            <th>Image thumbnail</th>
                            <th>Wifi</th>
                            <th>Breakfast</th>
                            <th>Lunch</th>
                            <th>Laundry</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($categories as  $index => $category )
                        <tr wire:key='{{$category->id}}'>
                            <td>{{$loop->index + 1}}</td>
                            <td>
                                {{$category->category}}
                            </td>
                            
                            <td>
    <div style="width: 120px; height: 120px; overflow: hidden;">
        <div class="swiper swiper-container" id="swiper-{{ $index }}" style="width: 100%; height: 100%;">
            <div class="swiper-wrapper" style="width: 100%; height: 100%;">
                @php
                    $files = \App\Models\CategoryImage::where('category', $category->category)->get();
                @endphp
                @foreach ($files as $file)
                    <div class="swiper-slide" style="width: 100%; height: 100%;">
                        <img src="{{ asset('public/storage/category-images/'.$file->random_name) }}"
                             alt="Hotel Category Image"
                             style="width: 100%; height: 100%; object-fit: cover; border-radius: 6px;" />
                    </div>
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
</td>

                          <td>
  @if($category->wifi == 1)
    <span class="badge bg-primary">Yes</span>
  @else
    <span class="badge bg-secondary"></span>
  @endif
</td>
                           <td>
  @if($category->breakfast == 1)
    <span class="badge bg-primary">Yes</span>
  @else
    <span class="badge bg-secondary"> </span>
  @endif
</td>
                            <td>
  @if($category->lunch == 1)
    <span class="badge bg-primary">Yes</span>
  @else
    <span class="badge bg-secondary"></span>
  @endif
</td>
                            <td>
  @if($category->laundry == 1)
    <span class="badge bg-primary">Yes</span>
  @else
    <span class="badge bg-secondary"></span>
  @endif
</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="ti ti-dots-vertical"></i></button>
                                    <div class="dropdown-menu">
                                        <a data-bs-toggle="modal" data-bs-target="#onboardingSlideModal" class="dropdown-item" href="javascript:void(0);" @click="$dispatch('modal-flag', { id: {{ $category->id }} })"><i class="ti ti-pencil me-1"></i> Edit</a>
                                        <a wire:click='destroyCategory({{ $category->id }})' class="dropdown-item" href="javascript:void(0);"><i class="ti ti-trash me-1"></i> Delete</a>
                                    </div>
                                </div>
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!--/ categories Rows -->

    </div>
    
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".swiper-container").forEach((swiperEl) => {
            new Swiper("#" + swiperEl.id, {
                loop: true,
                autoplay: {
                    delay: 3000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
            });
        });
    });
</script>

    <livewire:reservations.create-room-category>
</div> the swipper images are stretched out anyhow.i want them confined in a smaller box like dimension.  visible enough to be seen. its actually like a thumbnail. leave every other code and login intact  
