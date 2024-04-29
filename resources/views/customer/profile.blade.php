<x-app-layout>
    <section class="py-24 relative">
        <div class="w-full max-w-7xl px-4 md:px-5 lg-6 mx-auto">
            <h2 class="font-manrope font-bold text-4xl leading-10 text-black text-center">
                Your Profile
            </h2>

            <div class="main-box border border-gray-200 rounded-xl pt-6 max-w-xl max-lg:mx-auto lg:max-w-full mb-6">
                <table
                    class="min-w-full border-2 border-gray-500 text-left text-sm font-light text-surface dark:text-white">
                    <thead class="border-b border-2 border-neutral-200 font-medium dark:border-white/10">
                        <tr>
                            <th scope="col" class="px-6 py-4">Username</th>
                            <th scope="col" class="px-6 py-4">First Name</th>
                            <th scope="col" class="px-6 py-4">Last Name</th>
                            <th scope="col" class="px-6 py-4">Email</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr class="border-2 border-neutral-200 dark:border-white/10">
                            <td class="whitespace-nowrap px-6 py-4 font-medium">{{ auth()->user()->name }}</td>
                            <td class="whitespace-nowrap px-6 py-4 font-medium">{{ auth()->user()->first_name }}</td>
                            <td class="whitespace-nowrap px-6 py-4 font-medium">{{ auth()->user()->last_name }}</td>
                            <td class="whitespace-nowrap px-6 py-4 font-medium">{{ auth()->user()->email }}</td>
                            <td>
                                <a href="/your-profile-edit"
                                    class="text-blue-500 hover:bg-white-700 font-bold py-2 px-4 rounded "><i
                                        class="fas fa-regular fa-pencil"></i></a>
                            </td>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <section class="py-24 relative">
        <div class=" max-w-7xl px-4 md:px-5 lg-6 mx-auto">
            <h2 class="font-manrope font-bold text-4xl leading-10 text-black text-center">
                Address
            </h2>

            <div
                class="main-box border border-gray-200 rounded-xl pt-6 max-w-xl max-lg:mx-auto lg:max-w-full mb-6 flex">
                @foreach ($customerAddress as $item)
                    <div
                        class="mb-6 ml-3 max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                        <div class="flex">
                            <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">
                                {{ auth()->user()->name }}</h5>
                            <a href="{{ route('customer.address', $item->id) }}"
                                class="text-blue-500 hover:bg-white-700 font-bold py-2 px-4 rounded ml-20"><i
                                    class="fas fa-regular fa-pencil"></i></a>
                        </div>
                        <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">
                            +{{ $item->phone }}</h5>
                        <p class="mb-3 font-normal text-gray-500 dark:text-gray-400">
                            {{ $item->country }},{{ $item->state }}, {{ $item->city }}, {{ $item->street }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

</x-app-layout>
