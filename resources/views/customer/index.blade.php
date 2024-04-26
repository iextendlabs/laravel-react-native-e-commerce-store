<x-admin-layout>
    <div class="">
        <h1>Customer index </h1>
        <a href="{{ route('customers.create') }}"
            class="bg-blue-500 float-right hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Create
            a Customer</a>
    </div>

    <div class="flex flex-col my-10">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <table
                        class="min-w-full border-2 border-gray-500 text-left text-sm font-light text-surface dark:text-white">
                        <thead class="border-b border-2 border-neutral-200 font-medium dark:border-white/10">
                            <tr>
                                <th scope="col" class="px-6 py-4">Name</th>
                                <th scope="col" class="px-6 py-4">First Name</th>
                                <th scope="col" class="px-6 py-4">Last Name</th>
                                <th scope="col" class="px-6 py-4">Email</th>
                                <th scope="col" class="px-6 py-4">Role</th>
                                <th scope="col" class="px-6 py-4">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($customer->count() > 0)
                            @foreach ($customer as $item)
                                <tr class="border-2 border-neutral-200 dark:border-white/10">
                                    <td class="whitespace-nowrap px-6 py-4 font-medium">{{ $item->name }}</td>
                                    <td class="whitespace-nowrap px-6 py-4 font-medium">{{ $item->first_name }}</td>
                                    <td class="whitespace-nowrap px-6 py-4 font-medium">{{ $item->last_name }}</td>
                                    <td class="whitespace-nowrap px-6 py-4 font-medium">{{ $item->email }}</td>
                                    <td class="whitespace-nowrap px-6 py-4 font-medium">{{ $item->role }}</td>
                                    <td class="whitespace-nowrap px-6 py-4 flex">
                                        <a href="{{ route('customers.edit', ['customer' => $item->id]) }}" class="text-blue-500 dark:text-gray-400">Edit</a>
                                        <form action="{{ route('customers.destroy', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="mx-2 text-red-500 dark:text-gray-400">Delete</button>
                                        </form>
                                        <a href="{{ route('customers.show', ['customer' => $item->id]) }}" class="text-green-500 dark:text-gray-400">Assing role & permissinon</a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4">No categories found.</td>
                            </tr>
                        @endif
                        


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
