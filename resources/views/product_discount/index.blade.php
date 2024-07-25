<x-admin-layout>
    <div class="">
        <h1>Product Discount index </h1>
        <a href="{{ route('product-discount.create') }}"
            class="bg-blue-500 float-right hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Create
            a Product Discount</a>
    </div>

    <div class="flex flex-col my-10">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <table
                        class="min-w-full border-2 border-gray-500 text-left text-sm font-light text-surface dark:text-white">
                        <thead class="border-b border-2 border-neutral-200 font-medium dark:border-white/10">
                            <tr>
                                <th class="px-6 py-4">Product Name</th>
                                <th class="px-6 py-4">Customer Group</th>
                                <th class="px-6 py-4">Quantity</th>
                                <th class="px-6 py-4">Discount Price</th>
                                <th class="px-6 py-4">Start Date</th>
                                <th class="px-6 py-4">End Date</th>
                                <th scope="col" class="px-6 py-4">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($product_discount->count() > 0)
                                @foreach ($product_discount as $item)
                                    <tr class="border-2 border-neutral-200 dark:border-white/10">
                                        <td class="whitespace-nowrap px-6 py-4 font-medium">{{ $item->product->name }}</td>
                                        <td class="whitespace-nowrap px-6 py-4 font-medium">{{ $item->customer_group }}</td>
                                        <td class="whitespace-nowrap px-6 py-4 font-medium">{{ $item->quantity }}</td>
                                        <td class="whitespace-nowrap px-6 py-4 font-medium">{{ $item->discount_price }}</td>
                                        <td class="whitespace-nowrap px-6 py-4 font-medium">{{ $item->start_date }}</td>
                                        <td class="whitespace-nowrap px-6 py-4 font-medium">{{ $item->end_date }}</td>
                                        <td class="whitespace-nowrap px-6 py-4 flex">
                                            <a href="{{ route('product-discount.edit',  $item->id) }}"
                                                class="text-blue-500 dark:text-gray-400">Edit</a>
                                            <form action="{{ route('product-discount.destroy', $item->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="mx-2 text-red-500 dark:text-gray-400">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="4">No found.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
