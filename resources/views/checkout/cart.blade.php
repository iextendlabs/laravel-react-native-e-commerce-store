<x-app-layout>
    <div class="ml-24 mx-auto mt-10">
        <div class="flex shadow-md my-10">
            <div class="w-3/4 bg-white px-10 py-10">
                <div class="flex justify-between border-b pb-8">
                    <h1 class="font-semibold text-2xl">Shopping Cart</h1>
                    <h2 class="font-semibold text-2xl">{{ count(session('cart') ?? []) }} Items</h2>
                </div>
                <div class="flex mt-10 mb-5">
                    <h3 class="font-semibold text-gray-600 text-xs uppercase w-2/5">Product Details</h3>
                    <h3 class="font-semibold  text-gray-600 text-xs uppercase w-1/5 text-center">Quantity</h3>
                    <h3 class="font-semibold  text-gray-600 text-xs uppercase w-1/5 text-center">Price</h3>
                    <h3 class="font-semibold  text-gray-600 text-xs uppercase w-1/5 text-center">Total</h3>
                </div>
                @php
                    $total = 0;
                    $subtotal = 0
                @endphp
                @if (is_array($products) && count($products) > 0)
                    @foreach ($products as $item)
                        <div class="flex items-center hover:bg-gray-100 -mx-8 px-6 py-5">
                            <div class="flex w-2/5"> <!-- product -->
                                <div class="w-20">
                                    <img class="h-24" src="{{ $item->image }}" alt="">
                                </div>
                                <div class="flex flex-col justify-between ml-4 flex-grow">
                                    <span
                                        class="font-bold text-sm">{{ Str::limit($item->description ?? '', 20) }}</span>
                                    <span class="text-red-500 text-xs">{{ $item->name }}</span>
                                    <a href="{{ route('remove', $item->id) }}"
                                        class="font-semibold hover:text-red-500 text-gray-500 text-xs">Remove</a>
                                </div>
                            </div>
                            <div class="flex justify-center w-1/5">
                                <form action="{{ route('quantity.update', ['id' => $item->id]) }}" method="POST">
                                    @csrf
                                    <input class="mx-2 border text-center w-8" type="text"
                                        value="{{ $item->quantity }}" name="quantity">
                                    <button>update</button>
                                </form>
                            </div>
                            @if (isset($item->price))
                                <span class="text-center w-1/5 font-semibold text-sm">{{ $item->price }}</span>
                                <span
                                    class="text-center w-1/5 font-semibold text-sm">{{ $item->quantity * $item->price }}</span>
                            @else
                                <span class="text-center w-1/5 font-semibold text-sm">N/A</span>
                                <span class="text-center w-1/5 font-semibold text-sm">N/A</span>
                            @endif
                        </div>
                        @php
                            // Calculate total
                            if (isset($item->price)) {
                                $subtotal += $item->price * $item->quantity;
                                $total += $item->price * $item->quantity;
                            }
                        @endphp
                    @endforeach
                @endif


                @if (is_array($products) && count($products) > 0)
                    <div class="border-t mt-8">
                        <h1 class="mt-6 text-gray-800 font-semibold">Enter your coupon here</h1>
                        <form action="{{ route('cart') }}">
                            <div class="relative mb-4 flex items-stretch mt-4">
                                <input type="text" name="code"
                                    class="relative m-0 -me-px block flex-auto rounded-s border border-solid border-neutral-200 bg-transparent  bg-clip-padding px-3 py-4 text-base font-normal leading-[1.6] text-surface outline-none transition duration-200 ease-in-out placeholder:text-neutral-500 focus:z-[3] focus:border-primary focus:shadow-inset focus:outline-none motion-reduce:transition-none dark:border-white/10 dark:text-white dark:placeholder:text-neutral-200 dark:autofill:shadow-autofill dark:focus:border-primary"
                                    placeholder="Coupon code" aria-label="Recipient's username"
                                    value="{{ request('code') }}" aria-describedby="button-addon2" />
                                <button
                                    class="z-[2] inline-block rounded-e border-2 border-primary-100 px-6 pb-[6px] pt-2 font-medium uppercase leading-normal text-primary-700 transition duration-150 ease-in-out hover:border-primary-accent-200 hover:bg-black-600 bg-indigo-500 text-white text-lg focus:border-primary-accent-200 focus:bg-secondary-50/50 focus:outline-none focus:ring-0 active:border-primary-accent-200 dark:border-primary-400 dark:text-primary-300 dark:hover:bg-blue-950 dark:focus:bg-blue-950"
                                    data-twe-ripple-init type="submit" id="button-addon2">
                                    Apply coupon
                                </button>
                            </div>
                        </form>
                        @if ($coupon_data)
                            <div class="flex font-semibold justify-between py-6 text-sm uppercase">
                                <span>Coupon</span>
                                <span>-{{ $coupon_data->discount }}</span>
                            </div>
                        @endif
                        <div class="flex font-semibold justify-between py-6 text-sm uppercase">
                            <span>Subtotal</span>
                            <span>{{ $subtotal }}</span>
                        </div>
                        <div class="flex font-semibold justify-between py-6 text-sm uppercase">
                            <span>Total cost</span>
                            @if (!empty($coupon_data) && is_object($coupon_data))
                                @if ($coupon_data->category_product_coupon)
                                    <span>{{ $total - $coupon_data->category_product_coupon}}</span>
                                @elseif ($coupon_data->category_product_coupon == 0)
                                    @if ($coupon_data->type === 'percentage')
                                        <span>{{ $subtotal - (($coupon_data->discount * $subtotal) / 100) }}</span>
                                    @else
                                        <span>{{ $total - $coupon_data->discount }}</span>
                                    @endif
                                @else
                                    <span>{{ $subtotal }}</span>
                                @endif
                            @else
                                <span>{{ $subtotal }}</span>
                            @endif


                        </div>
                        
                        <form action="{{ route('checkout') }}" method="GET">
                            @csrf
                            <button
                                class="bg-indigo-500 font-semibold  hover:bg-indigo-600 py-3 text-sm text-white uppercase w-full mb-6">
                                Checkout</button>
                        </form>

                        <form action="/" method="GET">
                            @csrf
                            <button
                                class="bg-indigo-500 font-semibold  hover:bg-indigo-600 py-3 text-sm text-white uppercase w-full mb-6">
                                Continue Shopping</button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
