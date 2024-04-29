<x-admin-layout>
    <div class="">
        <h1>Customer index </h1>
        <a href="{{ route('customers.create') }}"
            class="bg-blue-500 float-right hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Create
            a Customer</a>
    </div>

    <div class="flex flex-col my-10">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <form action="{{ route('customers.index') }}" method="GET">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Customer Name</label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="name" type="text" name="name" value="{{ request('name') }}" placeholder="Customer Name">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="date">Email</label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="date" type="text" name="email" value="{{ request('email') }}" placeholder="Email">
                </div>
                <div class="inline-block relative">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="status">Role</label>
                    <select
                        class="block appearance-none w-96 my-2 bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline"
                        name="role">
                        <option value="">All</option>
                        @foreach ($role as $item)
                            
                        <option value="{{ $item->name }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                        </svg>
                    </div>
                </div>
                <div class="flex items-center justify-between">
                    <button
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                        type="submit">Filter</button>
                </div>
            </form>
            <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <table
                        class="min-w-full border-2 border-gray-500 text-left text-sm font-light text-surface dark:text-white">
                        <thead class="border-b border-2 border-neutral-200 font-medium dark:border-white/10">
                            <tr>
                                <th>
                                    <a class="ml-4"
                                        href="{{ route('customers.index', array_merge(request()->query(), ['sort' => 'name', 'direction' => request('direction', 'asc') == 'asc' ? 'desc' : 'asc'])) }}">Name</a>
                                        @if (request('sort') == 'name')
                                        <i class="fas {{ $direction === 'asc' ? 'fa-arrow-down' : 'fa-arrow-up' }}"></i>
                                        @endif
                                </th>
                                <th>
                                    <a class="ml-4"
                                        href="{{ route('customers.index', array_merge(request()->query(), ['sort' => 'first_name', 'direction' => request('direction', 'asc') == 'asc' ? 'desc' : 'asc'])) }}">First Name</a>
                                        @if (request('sort') == 'first_name')
                                        <i class="fas {{ $direction === 'asc' ? 'fa-arrow-down' : 'fa-arrow-up' }}"></i>
                                        @endif
                                </th>
                                <th>
                                    <a class="ml-4"
                                        href="{{ route('customers.index', array_merge(request()->query(), ['sort' => 'last_name', 'direction' => request('direction', 'asc') == 'asc' ? 'desc' : 'asc'])) }}">Last Name</a>
                                        @if (request('sort') == 'last_name')
                                        <i class="fas {{ $direction === 'asc' ? 'fa-arrow-down' : 'fa-arrow-up' }}"></i>
                                        @endif
                                </th>
                                <th>
                                    <a class="ml-4"
                                        href="{{ route('customers.index', array_merge(request()->query(), ['sort' => 'email', 'direction' => request('direction', 'asc') == 'asc' ? 'desc' : 'asc'])) }}">Email</a>
                                        @if (request('sort') == 'email')
                                        <i class="fas {{ $direction === 'asc' ? 'fa-arrow-down' : 'fa-arrow-up' }}"></i>
                                        @endif
                                </th>
                                <th>
                                    <a class="ml-4"
                                        href="{{ route('customers.index', array_merge(request()->query(), ['sort' => 'role', 'direction' => request('direction', 'asc') == 'asc' ? 'desc' : 'asc'])) }}">Role</a>
                                        @if (request('sort') == 'role')
                                        <i class="fas {{ $direction === 'asc' ? 'fa-arrow-down' : 'fa-arrow-up' }}"></i>
                                        @endif
                                </th>

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
                                    <td class="whitespace-nowrap px-6 py-4 font-medium">
                                    @foreach ($item->roles as $role)
                                        <h6>{{ $role->name }}</h6>
                                        @endforeach
                                    </td>
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
