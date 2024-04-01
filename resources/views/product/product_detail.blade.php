<x-app-layout>
    <div class="font-[sans-serif] bg-white">
        <div class="p-6 lg:max-w-7xl max-w-4xl mx-auto">
            <div
                class="grid items-start grid-cols-1 lg:grid-cols-5 gap-12 shadow-[0_2px_10px_-3px_rgba(6,81,237,0.3)] p-6">
                <div class="lg:col-span-3 w-full lg:sticky top-0 text-center">
                    <div class="px-4 py-10 rounded-xl shadow-[0_2px_10px_-3px_rgba(6,81,237,0.3)] relative">
                        <img src="{{ $product->image }}" alt="Product"
                            class="w-4/5 rounded object-cover" />
                      
                    </div>
                    <div class="mt-6 flex flex-wrap justify-center gap-6 mx-auto">
                        @foreach ($product->productImages as $item)
                        <div class="rounded-xl p-4 shadow-[0_2px_10px_-3px_rgba(6,81,237,0.3)]">
                            <img src="{{ '/storage/ProductImages/thumb/'.$item->image }}" alt="Product2"
                                class="w-24 cursor-pointer" />
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="lg:col-span-2 mt-32">
                    <h2 class="text-2xl font-extrabold text-[#333]">{{ $product->name }}</h2>
                    <p class="text-[#333]">{{ $product->description }}</p>
                    <div class="flex flex-wrap gap-4 mt-6">
                        <p class="text-[#333] text-4xl font-bold">Rs: {{ $product->price }}</p>
                        <p class="text-gray-400 text-xl"><strike>1500</strike> <span class="text-sm ml-1">Tax
                                included</span></p>
                    </div>
                    <div class="flex flex-wrap gap-4 mt-10">
                        <a href="{{ route('buy.now', $product->id) }}"
                            class="min-w-[200px] px-4 py-3 bg-red-500 hover:bg-[#000000] text-sm font-bold rounded">Buy
                            now</a>
                        <a href="{{ route('add.to.cart', $product->id) }}"
                            class="min-w-[200px] px-4 py-2.5 border border-[#333] bg-transparent hover:bg-gray-50 text-[#333] text-sm font-bold rounded">Add
                            to cart</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
