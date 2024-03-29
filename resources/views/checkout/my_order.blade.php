<x-app-layout>
    <section class="py-24 relative">
        <div class="w-full max-w-7xl px-4 md:px-5 lg-6 mx-auto">
            <h2 class="font-manrope font-bold text-4xl leading-10 text-black text-center">
                Payment Successful
            </h2>
            <p class="mt-4 font-normal text-lg leading-8 text-gray-500 mb-11 text-center">Thanks for making a purchase
                you can
                check our order summary frm below</p>
            <div class="main-box border border-gray-200 rounded-xl pt-6 max-w-xl max-lg:mx-auto lg:max-w-full">
                @foreach ($orders as $item)
                <div class="w-full px-3 min-[400px]:px-6">
                    <div class="flex flex-col lg:flex-row items-center py-6 gap-6 w-full">
                        <div class="flex flex-row items-center w-full ">
                            <div class="grid grid-cols-1 lg:grid-cols-1 w-full">
                                <div class="grid grid-cols-7">
                                    <div class="col-span-5 lg:col-span-1 flex items-center mx-3 max-lg:mt-3">
                                        <p class="font-semibold text-base leading-7 text-black">Order Id: <span class="text-indigo-600 font-medium">#10234987</span></p>
                                    </div>
                                    <div class="col-span-5 lg:col-span-1 flex items-center max-lg:mt-3">
                                        <div class="flex gap-3 lg:block">
                                            <p class="font-medium text-sm leading-7 text-black">price</p>
                                            <p class="lg:mt-4 font-medium text-sm leading-7 text-indigo-600">Rs: {{ $item->order_total->total }}</p>
                                        </div>
                                    </div>
                                    <div class="col-span-5 lg:col-span-2 flex items-center max-lg:mt-3 ">
                                        <div class="flex gap-3 lg:block">
                                            <p class="font-medium text-sm leading-7 text-black">Status
                                            </p>
                                            <p
                                                class="font-medium text-sm leading-6 py-0.5 px-3 whitespace-nowrap rounded-full lg:mt-3 bg-indigo-50 text-indigo-600">{{$item->status}}</p>
                                        </div>

                                    </div>
                                    <div class="col-span-5 lg:col-span-2 flex items-center max-lg:mt-3">
                                        <div class="flex gap-3 lg:block">
                                            <p class="font-medium text-sm whitespace-nowrap leading-6 text-black">
                                                Expected Delivery Time</p>
                                            <p class="font-medium text-base whitespace-nowrap leading-7 lg:mt-3 text-emerald-500">
                                                23rd March 2021</p>
                                        </div>

                                    </div>
                                    <div class="col-span-5 lg:col-span-1 flex items-center max-lg:mt-3">
                                        <div class="flex gap-3 lg:block">
                                            <a href="{{ route('order.detail', $item->id) }}" class="font-medium text-sm leading-7 text-blue-500">view detail</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                @endforeach
                <div class="w-full border-t border-gray-200 px-6 flex flex-col lg:flex-row items-center justify-between ">
                    <div class="flex flex-col sm:flex-row items-center max-lg:border-b border-gray-200">
                        <button
                            class="flex outline-0 py-6 sm:pr-6  sm:border-r border-gray-200 whitespace-nowrap gap-2 items-center justify-center font-semibold group text-lg text-black bg-white transition-all duration-500 hover:text-indigo-600">
                            <svg class="stroke-black transition-all duration-500 group-hover:stroke-indigo-600" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22"
                                fill="none">
                                <path d="M5.5 5.5L16.5 16.5M16.5 5.5L5.5 16.5" stroke="" stroke-width="1.6"
                                    stroke-linecap="round" />
                            </svg>
                            Cancel Order
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </section>
                                            
</x-app-layout>