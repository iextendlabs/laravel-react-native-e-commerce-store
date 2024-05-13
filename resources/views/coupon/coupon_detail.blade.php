<x-admin-layout>
    <a href="{{ route('coupons.index') }}" class="border-2 border-black rounded p-3">Back</a>
    <section class="py-24 relative ">
        <div class="w-full max-w-7xl px-4 md:px-5 lg-6 mx-auto ">

            <h2 class="font-manrope font-bold text-3xl sm:text-4xl leading-10 text-black mb-11">
                Coupon history ({{ $coupon_history->coupon->code ?? '' }})
            </h2>
            <div class="flex items-center justify-center sm:justify-end w-full my-6">
                <div class=" w-full">
                    <div class="flex items-center justify-between mb-6">
                        <p class="font-normal text-xl leading-8 text-gray-500">Customer Name</p>
                        <p class="font-semibold text-xl leading-8 text-gray-900">
                            {{ $coupon_history->order->user->name }}</p>
                    </div>
                    <div class="flex items-center justify-between mb-6">
                        <p class="font-normal text-xl leading-8 text-gray-500">Order</p>
                        @foreach ($coupon_history->order->order_products as $item)
                            <p class="font-semibold text-xl leading-8 text-gray-900"> {{ $item->name }}
                            </p>
                        @endforeach
                    </div>
                    <div class="flex items-center justify-between mb-6">
                        <p class="font-normal text-xl leading-8 text-gray-500">Coupon Name</p>
                        <p class="font-semibold text-xl leading-8 text-gray-900">{{ $coupon_history->coupon->name }}
                        </p>
                    </div>
                    <div class="flex items-center justify-between mb-6">
                        <p class="font-normal text-xl leading-8 text-gray-500">Discount amount</p>
                        <p class="font-semibold text-xl leading-8 text-gray-900">Rs:
                            {{ $coupon_history->discount_amount }}
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </section>

</x-admin-layout>
