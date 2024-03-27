<x-app-layout>
    <div class="font-[sans-serif] bg-white">
        <div class="max-lg:max-w-xl mx-auto w-full">
            <div class="grid lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2 max-lg:order-1 p-6 max-w-4xl mx-auto w-full">
                    <div class="text-center max-lg:hidden">
                        <h2 class="text-3xl font-extrabold text-[#333] inline-block border-b-4 border-[#333] pb-1">
                            Checkout</h2>
                    </div>
                    <h1 class="text-3xl font-extrabold text-[#333] inline-block border-b-4 border-[#333] pb-1">Address
                    </h1>
                    <form action="{{ route('place.order') }}">
                        <div class="lg:col-span-2 max-lg:order-1 p-2 max-w-4xl mx-auto w-full flex">

                            @foreach ($address as $id => $item)
                                <div class="card border-2 p-2 max-w-4xl w-full mx-2 hover:shadow-lg"
                                    class="{ 'border-blue-500': isSelected }">
                                    <div
                                        class="flex items-center ps-4 border border-gray-200 rounded dark:border-gray-700">

                                        <input id="bordered-radio-{{ $id }}" type="radio" value="{{ $item->id }}"
                                            name="address" 
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        <label for="bordered-radio-{{ $id }}"
                                            class="w-full py-4 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Address
                                            {{ $id }}</label>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text"><span class="font-bold">Address:</span>
                                            {{ $item->address }}
                                        </p>
                                        <p class="card-text"><span class="font-bold">Country:</span>{{ $item->country }}
                                        </p>
                                        <p class="card-text"><span class="font-bold">State:</span>{{ $item->state }}
                                        </p>
                                        <p class="card-text"><span class="font-bold">City:</span>{{ $item->city }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="flex flex-wrap gap-4 mt-8 " style="display: block;" id="placeButton">
                            <a href="/cart"
                                class="min-w-[150px] px-6 py-3.5 text-sm bg-gray-100 text-[#333] rounded-md hover:bg-gray-200">Back</a>
                            <button type="submit"
                                class="min-w-[150px] px-6 py-3.5 text-sm  bg-red-200 rounded-md hover:bg-[#111]">Place
                                Order</button>
                        </div>
                    </form>
                    <button id="toggleAddressFormBtn"
                        class="mt-4 px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300"
                        style="display: block;">Add New
                        Address</button>
                    @include('../include/error')
                    <form id="addressForm" style="display: none;" action="{{ route('place.order') }}"
                        class="lg:mt-12">
                        @csrf
                        <div>
                            <h2 class="text-2xl font-extrabold text-[#333]">Shipping info</h2>
                            <div class="grid grid-cols-2 gap-6 mt-8">
                                <input type="text" placeholder="Name" name="name"
                                    class="px-2 py-3.5 bg-white text-[#333] w-full text-sm border-b-2 focus:border-[#333] outline-none" />
                                <input type="email" placeholder="Email address" name="email"
                                    class="px-2 py-3.5 bg-white text-[#333] w-full text-sm border-b-2 focus:border-[#333] outline-none" />
                                <input type="text" placeholder="Country" name="country"
                                    class="px-2 py-3.5 bg-white text-[#333] w-full text-sm border-b-2 focus:border-[#333] outline-none" />
                                <input type="text" placeholder="Street address" name="address"
                                    class="px-2 py-3.5 bg-white text-[#333] w-full text-sm border-b-2 focus:border-[#333] outline-none" />
                                <input type="text" placeholder="City" name="city"
                                    class="px-2 py-3.5 bg-white text-[#333] w-full text-sm border-b-2 focus:border-[#333] outline-none" />
                                <input type="text" placeholder="State" name="state"
                                    class="px-2 py-3.5 bg-white text-[#333] w-full text-sm border-b-2 focus:border-[#333] outline-none" />
                                <input type="number" placeholder="Postal code" name="postal_code"
                                    class="px-2 py-3.5 bg-white text-[#333] w-full text-sm border-b-2 focus:border-[#333] outline-none" />
                                <input type="number" placeholder="Phone" name="phone"
                                    class="px-2 py-3.5 bg-white text-[#333] w-full text-sm border-b-2 focus:border-[#333] outline-none" />
                            </div>
                        </div>
                        {{-- <div class="mt-12">
                            <h2 class="text-2xl font-extrabold text-[#333]">Payment method</h2>
                            <div class="grid gap-4 sm:grid-cols-2 mt-8">
                                <div class="flex items-center">
                                    <input type="radio" class="w-5 h-5 cursor-pointer" id="card" checked />
                                    <label for="card" class="ml-4 flex gap-2 cursor-pointer">
                                        <img src="https://readymadeui.com/images/visa.webp" class="w-12"
                                            alt="card1" />
                                        <img src="https://readymadeui.com/images/american-express.webp" class="w-12"
                                            alt="card2" />
                                        <img src="https://readymadeui.com/images/master.webp" class="w-12"
                                            alt="card3" />
                                    </label>
                                </div>
                                <div class="flex items-center">
                                    <input type="radio" class="w-5 h-5 cursor-pointer" id="paypal" />
                                    <label for="paypal" class="ml-4 flex gap-2 cursor-pointer">
                                        <img src="https://readymadeui.com/images/paypal.webp" class="w-20"
                                            alt="paypalCard" />
                                    </label>
                                </div>
                            </div>
                            <div class="grid gap-6 mt-8">
                                <input type="text" placeholder="Cardholder's Name"
                                    class="px-2 py-3.5 bg-white text-[#333] w-full text-sm border-b-2 focus:border-[#333] outline-none" />
                                <div class="flex bg-white border-b-2 focus-within:border-[#333] overflow-hidden">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-12 ml-3"
                                        viewBox="0 0 291.764 291.764">
                                        <path fill="#2394bc"
                                            d="m119.259 100.23-14.643 91.122h23.405l14.634-91.122h-23.396zm70.598 37.118c-8.179-4.039-13.193-6.765-13.193-10.896.1-3.756 4.24-7.604 13.485-7.604 7.604-.191 13.193 1.596 17.433 3.374l2.124.948 3.182-19.065c-4.623-1.787-11.953-3.756-21.007-3.756-23.113 0-39.388 12.017-39.489 29.204-.191 12.683 11.652 19.721 20.515 23.943 9.054 4.331 12.136 7.139 12.136 10.987-.1 5.908-7.321 8.634-14.059 8.634-9.336 0-14.351-1.404-21.964-4.696l-3.082-1.404-3.273 19.813c5.498 2.444 15.609 4.595 26.104 4.705 24.563 0 40.546-11.835 40.747-30.152.08-10.048-6.165-17.744-19.659-24.035zm83.034-36.836h-18.108c-5.58 0-9.82 1.605-12.236 7.331l-34.766 83.509h24.563l6.765-18.08h27.481l3.51 18.153h21.664l-18.873-90.913zm-26.97 54.514c.474.046 9.428-29.514 9.428-29.514l7.13 29.514h-16.558zM85.059 100.23l-22.931 61.909-2.498-12.209c-4.24-14.087-17.533-29.395-32.368-36.999l20.998 78.33h24.764l36.799-91.021H85.059v-.01z"
                                            data-original="#2394bc" />
                                        <path fill="#efc75e"
                                            d="M51.916 111.982c-1.787-6.948-7.486-11.634-15.226-11.734H.374L0 101.934c28.329 6.984 52.107 28.474 59.821 48.688l-7.905-38.64z"
                                            data-original="#efc75e" />
                                    </svg>
                                    <input type="number" placeholder="Card Number"
                                        class="px-2 py-3.5 bg-white text-[#333] w-full text-sm outline-none" />
                                </div>
                                <div class="grid grid-cols-2 gap-6">
                                    <input type="number" placeholder="EXP."
                                        class="px-2 py-3.5 bg-white text-[#333] w-full text-sm border-b-2 focus:border-[#333] outline-none" />
                                    <input type="number" placeholder="CVV"
                                        class="px-2 py-3.5 bg-white text-[#333] w-full text-sm border-b-2 focus:border-[#333] outline-none" />
                                </div>
                                <div class="flex items-center">
                                    <input id="remember-me" name="remember-me" type="checkbox"
                                        class="h-4 w-4 shrink-0 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" />
                                    <label for="remember-me" class="ml-3 block text-sm">
                                        I accept the <a href="javascript:void(0);"
                                            class="text-blue-600 font-semibold hover:underline ml-1">Terms and
                                            Conditions</a>
                                    </label>
                                </div>
                            </div>
                        </div> --}}
                        <div class="flex flex-wrap gap-4 mt-8">
                            <a href="/cart"
                                class="min-w-[150px] px-6 py-3.5 text-sm bg-gray-100 text-[#333] rounded-md hover:bg-gray-200">Back</a>
                            <button type="submit"
                                class="min-w-[150px] px-6 py-3.5 text-sm  bg-red-200 rounded-md hover:bg-[#111]">Confirm
                                Place Order</button>
                        </div>
                    </form>
                </div>
                <div class="bg-gray-100 lg:sticky lg:top-0">
                    <div class="relative h-full">
                        <div class="p-8 lg:overflow-auto lg:h-[calc(100vh-60px)] max-lg:mb-8">
                            <h2 class="text-2xl font-extrabold text-[#333]">Order Summary</h2>
                            <div class="space-y-3 mt-10">
                                @php
                                    $cart = session('cart') ?? [];
                                    $total = 0;
                                    $discount = 0;
                                    foreach ($cart as $key => $value) {
                                        $total += $value['price'] * $value['quantity'];
                                    }
                                @endphp
                                @foreach ($cart as $item)
                                    <div class="grid sm:grid-cols-2">
                                        <div class="bg-gray-200 rounded-md w-24">
                                            <img src='{{ $item['image'] }}' class="object-contain" />
                                        </div>
                                        <div>
                                            <h3 class="text-base text-[#333]">{{ $item['name'] ?? '' }}</h3>
                                            <ul class="text-xs text-[#333] space-y-2 mt-2">
                                                {{-- <li class="flex flex-wrap gap-4">Size <span class="ml-auto">37</span></li> --}}
                                                <li class="flex flex-wrap gap-4">Quantity <span
                                                        class="ml-auto">{{ $item['quantity'] }}</span></li>
                                                <li class="flex flex-wrap gap-4">Total Price <span
                                                        class="ml-auto">{{ $item['quantity'] * $item['price'] }}</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                        <div class="absolute left-0 bottom-0 bg-gray-200 w-full p-4">
                            <h4 class="flex flex-wrap gap-4 text-base text-[#333] font-bold">SubTotal <span
                                    class="ml-auto">{{ $total }}</span></h4>
                            <h4 class="flex flex-wrap gap-4 text-base text-[#333] font-bold">Discount <span
                                    class="ml-auto">{{ $discount }}</span></h4>
                            <h4 class="flex flex-wrap gap-4 text-base text-[#333] font-bold">Total <span
                                    class="ml-auto">{{ $total + $discount }}</span></h4>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script>
      document.querySelectorAll('input[type="radio"]').forEach(function(radio) {
          radio.addEventListener('click', function() {
              var form = document.getElementById("addressForm");
              var button = document.getElementById('placeButton');
              var formButton = document.getElementById('toggleAddressFormBtn');
              
              form.style.display = "none";
              button.style.display = 'block';
              formButton.style.display = 'block';
          });
      });

      document.getElementById('toggleAddressFormBtn').addEventListener('click', function() {
          var form = document.getElementById("addressForm");
          var button = document.getElementById('placeButton');
          var formButton = document.getElementById('toggleAddressFormBtn');

          if (form.style.display === "none") {
              form.style.display = "block";
              button.style.display = 'none';
              formButton.style.display = 'none';
              var radioButtons = document.querySelectorAll('input[type="radio"]');
              radioButtons.forEach(function(button) {
                  button.checked = false;
              });
          } else {
              form.style.display = "none";
              button.style.display = 'block';
          }
      });
  </script>

</x-app-layout>
