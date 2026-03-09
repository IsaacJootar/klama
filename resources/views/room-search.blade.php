<div class="container-xxl flex-grow-1 container-p-y">

    {{-- Search Form --}}
    <form id="wizard-checkout-form" onsubmit="return false" class="mb-5 row g-3 align-items-end">

        <div class="col-md-5">
            <label for="checkin" class="form-label fw-bold">Select Your Arrival Date</label>
            <input
                type="date"
                id="checkin"
                class="form-control form-control-lg"
                wire:model="checkin"
                required
                min="{{ now()->format('Y-m-d') }}"
            />
        </div>

        <div class="col-md-5">
            <label for="checkout" class="form-label fw-bold">Select Departure Date</label>
            <input
                type="date"
                id="checkout"
                class="form-control form-control-lg"
                wire:model="checkout"
                required
                min="{{ now()->addDay()->format('Y-m-d') }}"
            />
        </div>

        <div class="col-md-2 d-flex justify-content-center">
            <button
                type="button"
                wire:click="search"
                class="btn btn-primary w-100 py-3 fs-5 shadow-none rounded-0"
            >
                Search
            </button>
        </div>

    </form>

    {{-- Room Allocations List --}}
    <div class="row mb-12 g-6">
        @php
            use App\Http\Helpers\Helper;
        @endphp

        @if ($allocations->isEmpty())
            <div class="col-12 text-center text-muted fs-5">No rooms found for the selected dates.</div>
        @else
            @foreach ($allocations as $index => $allocation)
                <div class="col-md-12 mb-4">
                    <div class="card">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <div
                                    class="swiper-container swiper-card-advance-bg"
                                    id="swiper-{{ $index }}"
                                >
                                    <div class="swiper-wrapper">
                                        @php
                                            $files = \App\Models\CategoryImage::where('category', $allocation->category->category)->get();
                                        @endphp
                                        @foreach ($files as $file)
                                            <div class="swiper-slide text-center">
                                                <img
                                                    class="card-img"
                                                    src="{{ asset('public/storage/category-images/' . $file->random_name) }}"
                                                    alt="Hotel Category images"
                                                    height="200"
                                                />
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="swiper-pagination"></div>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="card-body">
                                    <h4 class="card-title">
                                        <span class="badge bg-label-primary">
                                            {{ $allocation->category->category }}
                                        </span>
                                    </h4>

                                    @php
                                        $count = \App\Models\Roomallocation::where('category_id', $allocation->category->id)
                                            ->whereNotBetween('checkin', [$checkin ?? session('checkin'), $checkout ?? session('checkout')])
                                            ->whereNotBetween('checkout', [$checkin ?? session('checkin'), $checkout ?? session('checkout')])
                                            ->count();
                                    @endphp

                                    <h6 class="card-title">{{ $count }} Available Room(s)</h6>
                                    <p class="card-text">{{ $allocation->category->details }}</p>
                                    <h6 class="mb-1">
                                        Price:
                                        {{ Helper::format_currency(
                                            \App\Models\Roomallocation::where('category_id', $allocation->category_id)->value('price')
                                        ) }}
                                    </h6>
                                    <h6 class="mb-1">Per Night (Inc. Tax)</h6>
                                    <br />
                                    <x-primary-button
                                        a
                                        href="{{ route('create-booking', [
                                            'category_id' => $allocation->category_id,
                                            'nor' => $count,
                                            'checkin' => $checkin ?? session('checkin'),
                                            'checkout' => $checkout ?? session('checkout'),
                                        ]) }}"
                                        wire:navigate
                                    >
                                        Reserve Now
                                        <i class="ti ti-arrow-right scaleX-n1-rtl ti-sm me-1_5"></i>
                                    </x-primary-button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>

</div>

<script>
    function initSwipers() {
        document.querySelectorAll(".swiper-container").forEach((swiperEl) => {
            if (swiperEl.swiper) {
                swiperEl.swiper.destroy(true, true);
            }

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
    }

    document.addEventListener("DOMContentLoaded", () => {
        initSwipers();
    });

    Livewire.hook('message.processed', () => {
        initSwipers();
    });
</script>
