<x-app-layout>
    <div class="container mx-auto mt-10">
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
                                $total += $item->price * $item->quantity;
                            }
                        @endphp
                    @endforeach
                @endif

                <a href="/" class="flex font-semibold text-indigo-600 text-sm mt-10">

                    <svg class="fill-current mr-2 text-indigo-600 w-4" viewBox="0 0 448 512">
                        <path
                            d="M134.059 296H436c6.627 0 12-5.373 12-12v-56c0-6.627-5.373-12-12-12H134.059v-46.059c0-21.382-25.851-32.09-40.971-16.971L7.029 239.029c-9.373 9.373-9.373 24.569 0 33.941l86.059 86.059c15.119 15.119 40.971 4.411 40.971-16.971V296z" />
                    </svg>
                    Continue Shopping
                </a>
                @if (is_array($products) && count($products) > 0 ) 
                    <div class="border-t mt-8">
                        <div class="flex font-semibold justify-between py-6 text-sm uppercase">
                            <span>Total cost</span>
                            <span>{{ $total }}</span>
                        </div>
                        <form action="{{ route('checkout') }}" method="GET">
                            @csrf
                            <button
                                class="bg-indigo-500 font-semibold  hover:bg-indigo-600 py-3 text-sm text-white uppercase w-full">
                                Checkout</button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
