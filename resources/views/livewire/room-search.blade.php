<div class="container-xxl flex-grow-1 container-p-y">
    <livewire:search><br> <br>
    <form id="wizard-checkout-form" onSubmit="return false">
        @php
            use Carbon\Carbon;
            use Illuminate\Support\Facades\Storage;
             use App\Http\Helpers\Helper;

            if (session()->get('token') == 1) {
                $checkin = Carbon::now()->timezone('Africa/Lagos')->format('Y-m-d');
                $checkout = Carbon::now()->addDays(1)->timezone('Africa/Lagos')->format('Y-m-d');
            }
            if (session()->get('token') == 2) {
                $checkin = session('checkin');
                $checkout = session('checkout');
            }
        @endphp


        <div class="row mb-12 g-6">
            @foreach ($allocations as $index => $allocation)
                <div class="col-md-12 mb-4">
                    <div class="card">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <div class="swiper-container swiper-container-horizontal swiper swiper-card-advance-bg" id="swiper-{{ $index }}">
                                    <div class="swiper-wrapper">
                                        @php
                                            $files = \App\Models\CategoryImage::where('category', $allocation->category->category)->get();
                                        @endphp
                                        @foreach ($files as $file)
                                            <div class="swiper-slide text-center">
                                               <img class="card-img" src="{{ asset('public/storage/category-images/'.$file->random_name) }}" alt="Hotel Category images" height="200" />

                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="swiper-pagination"></div>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="card-body">
                                    <h4 class="card-title">
                                        <span class="badge bg-label-primary">{{ $allocation->category->category }}</span>
                                    </h4>
                                    <h6 class="card-title">
                                        {{$count = \App\Models\Roomallocation::where('category_id', $allocation->category->id)
                                        ->whereNotBetween('checkin', [session('checkin'), session('checkout')])
                                        ->whereNotBetween('checkout', [session('checkin'), session('checkout')])
                                        ->get()->count()}} Available Room(s)
                                    </h6>
                                    <p class="card-text">{{ $allocation->category->details }}</p>
                                    <h6 class="mb-1">Price: {{ Helper::format_currency(\App\Models\Roomallocation::where('category_id', $allocation->category_id)->value('price')) }}</h6>
                                    <h6 class="mb-1">Per Night (Inc. Tax)</h6>
                                    <br/>
                                    <x-primary-button a href="{{route('create-booking', ['category_id' => $allocation->category_id, 'nor'=> $count, 'checkin'=> $checkin, 'checkout'=> $checkout])}}" wire:navigate>
                                        Reserve Now <i class="ti ti-arrow-right scaleX-n1-rtl ti-sm me-1_5"></i>
                                    </x-primary-button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </form>
</div>


<script>
    let swiperInstances = [];

    function destroySwipers() {
        swiperInstances.forEach(swiper => {
            if (swiper && swiper.destroy) {
                swiper.destroy(true, true);
            }
        });
        swiperInstances = [];
    }

    function initSwipers() {
        destroySwipers();

        const swiperEls = document.querySelectorAll(".swiper-container");
        swiperEls.forEach((swiperEl) => {
            const paginationEl = swiperEl.querySelector(".swiper-pagination");
            if (!paginationEl) return;

            const newSwiper = new Swiper(swiperEl, {
                loop: true,
                autoplay: {
                    delay: 3000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: paginationEl,
                    clickable: true,
                },
            });

            swiperInstances.push(newSwiper);
        });
    }

    window.addEventListener('DOMContentLoaded', () => {
        initSwipers(); // Run on first load
    });

    // ✅ Listen for Livewire update to reinit swiper
    window.addEventListener('contentChanged', () => {
    setTimeout(() => {
        initSwipers();
    }, 800); // Try increasing to 500ms or even 800ms
});
</script>





