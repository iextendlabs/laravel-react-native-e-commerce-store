<x-admin-layout>
    <div class="">
        <h1>Oders  index </h1>
        {{-- <a href="{{ route('categories.create') }}"
            class="bg-blue-500 float-right hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Create
            a Category</a> --}}
    </div>

    <div class="flex flex-col my-10">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <form action="{{ route('orders') }}" method="GET">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Customer Name</label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" type="text" name="name" placeholder="Customer Name">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="date">Date</label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="date" type="date" name="date" value="{{ request('date') }}" placeholder="Date">
                </div>
                <div class="inline-block relative">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="status">Status</label>
                    <select class="block appearance-none w-96 my-2 bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline" name="status">
                        <option value="">All</option>
                        <option value="Order placed" {{ request('status') === 'Order placed' ? 'selected' : '' }}>Order placed</option>
                        <option value="Pending" {{ request('status') === 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="Order confirmed" {{ request('status') === 'Order confirmed' ? 'selected' : '' }}>Order confirmed</option>
                        <option value="Order processing" {{ request('status') === 'Order processing' ? 'selected' : '' }}>Order processing</option>
                        <option value="Shipped" {{ request('status') === 'Shipped' ? 'selected' : '' }}>Shipped/Dispatched</option>
                        <option value="Delivered" {{ request('status') === 'Delivered' ? 'selected' : '' }}>Delivered</option>
                        <option value="Canceled" {{ request('status') === 'Canceled' ? 'selected' : '' }}>Canceled</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                        </svg>
                    </div>
                </div>
                <div class="flex items-center justify-between">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">Filter</button>
                </div>
            </form>
            <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                
                <div class="overflow-hidden">
                    <table
                        class="min-w-full border-2 border-gray-500 text-left text-sm font-light text-surface dark:text-white">
                        <thead class="border-b border-2 border-neutral-200 font-medium dark:border-white/10">
                            <tr>
                                <th scope="col" class="px-6 py-4">Id</th>
                                <th scope="col" class="px-6 py-4">Customer Name</th>
                                <th scope="col" class="px-6 py-4">Status</th>
                                <th scope="col" class="px-6 py-4">Total</th>
                                <th scope="col" class="px-6 py-4">Date</th>
                                <th scope="col" class="px-6 py-4">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($orderProduct->count() > 0)
                                @foreach ($orderProduct as $item)
                                    <tr class="border-2 border-neutral-200 dark:border-white/10">
                                        <td class="whitespace-nowrap px-6 py-4 font-medium">{{ $item->id }}</td>
                                        <td class="whitespace-nowrap px-6 py-4 font-medium">{{ $item->user->name }}</td>
                                        <td class="whitespace-nowrap px-6 py-4">{{ $item->status }}</td>
                                        <td class="whitespace-nowrap px-6 py-4">{{ $item->order_total->total }}</td>
                                        <td class="whitespace-nowrap px-6 py-4">{{ $item->created_at }}</td>
                                        <td class="whitespace-nowrap px-6 py-4 flex">
                                            <a href="{{ route('order.edit', $item->id) }}"
                                                class="text-blue-500 dark:text-gray-400">Edit</a>
                                            <form
                                                action="{{ route('order.destroy', $item->id) }}"
                                                method="POST">
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
                                    <td colspan="4">No Order found.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    {{ $orderProduct->links() }}
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
