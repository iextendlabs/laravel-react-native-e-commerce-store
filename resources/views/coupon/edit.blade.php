<x-admin-layout>
    
    <h1>Coupon edit</h1>
    <a href="{{ route('coupons.index') }}"
        class="bg-blue-500 float-right hover:bg-blue-700 max-w-lg  text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Back</a>

    <div class="mx-auto block  rounded-lg bg-white p-6 shadow-4 dark:bg-surface-dark">
        @include('include/error')
        <form action="{{ route('coupons.update', $coupon->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block text-black text-sm font-bold mb-2" for="username">
                    Name
                </label>
                <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-black leading-tight focus:outline-none focus:shadow-outline"
                    id="name" type="text" name="name" value="{{ $coupon->name }}" placeholder="name">
            </div>

            <div class="mb-4">
                <label class="block text-black text-sm font-bold mb-2" for="username">
                    Code
                </label>
                <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-black leading-tight focus:outline-none focus:shadow-outline"
                    id="code" type="text" name="code"  value="{{ $coupon->code }}" placeholder="Code">
            </div>
            <div class="mb-4">
                <label class="block text-black text-sm font-bold mb-2" for="username">
                    Discount
                </label>
                <input
                class="shadow appearance-none border rounded w-full py-2 px-3 text-black leading-tight focus:outline-none focus:shadow-outline"
                id="discount" type="text" name="discount" value="{{ $coupon->discount }}" placeholder="Discount">
            </div>
            <div class="mb-4">
                <label class="block text-black text-sm font-bold mb-2" for="username">
                    Start Date
                </label>
                <input
                class="shadow appearance-none border rounded w-full py-2 px-3 text-black leading-tight focus:outline-none focus:shadow-outline"
                id="start_date" type="date" name="start_date" value="{{ $coupon->start_date }}" placeholder="start date">
            </div>
            <div class="mb-4">
                <label class="block text-black text-sm font-bold mb-2" for="username">
                    End Date
                </label>
                <input
                class="shadow appearance-none border rounded w-full py-2 px-3 text-black leading-tight focus:outline-none focus:shadow-outline"
                id="end_date" type="date" name="end_date" value="{{ $coupon->end_date }}" placeholder="end date">
            </div>
            <div class="mt-4 mb-4">
                <label class="block text-black text-sm font-bold mb-2" for="customer_groups_id">
                    Customer Group
                </label>
                <select name="customer_groups_id" id="customer_groups_id" class="shadow appearance-none border bg-white rounded w-full py-2 px-3 text-black leading-tight focus:outline-none focus:shadow-outline">
                    <option value=""></option>
                    @foreach ($customer_group as $item)
                        <option value="{{ $item->id }}" @if ($coupon->customer_groups_id === $item->id) selected @endif>{{ $item->name }}</option>
                    @endforeach
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-black">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                    </svg>
                </div>
            </div>
            <div class="inline-block relative ">
                <label class="block text-black text-sm font-bold mb-2" for="username">
                    Coupon type
                </label>
                <select
                    class="block appearance-none w-96 my-2 bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline"
                    name="type">
                    
                    <option value="fixed amount">Fixed amount</option>
                    <option value="percentage">Percentage</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-black">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                    </svg>
                </div>
            </div>
            <div class="inline-block relative ">
                <label class="block text-black text-sm font-bold mb-2" for="username">
                    Coupon Status
                </label>
                <select
                    class="block appearance-none w-96 my-2 bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline"
                    name="status">
                    
                    <option value="enable">Enable</option>
                    <option value="disable">Disable</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-black">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                    </svg>
                </div>
            </div>
            <div class="p-4">
                <div class="form-group">
                    <label class="block text-red-500"><strong>* Products:</strong></label>
                    <input type="text" name="categories-search" id="categories-search" class="form-control w-full mb-4 p-2 border border-gray-300 rounded" placeholder="Search Category By Name">
                    <div class="overflow-y-auto max-h-64 border border-gray-200 rounded">
                        <table class="table-auto w-full">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-4 py-2"></th>
                                    <th class="px-4 py-2">Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($product as $product)
                                <tr class="bg-white border-b hover:bg-gray-50">
                                    <td class="px-4 py-2">
                                        <input type="checkbox" name="product_id[]" value="{{ $product->id }}"  @if (in_array($product->id,$product_ids))  checked @endif>
                                    </td>
                                    <td class="px-4 py-2">{{ $product->name }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="p-4">
                <div class="form-group">
                    <label class="block text-red-500"><strong>* Category:</strong></label>
                    <input type="text" name="categories-search" id="categories-search" class="form-control w-full mb-4 p-2 border border-gray-300 rounded" placeholder="Search Category By Name">
                    <div class="overflow-y-auto max-h-64 border border-gray-200 rounded">
                        <table class="table-auto w-full">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-4 py-2"></th>
                                    <th class="px-4 py-2">Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($category as $category)
                                <tr class="bg-white border-b hover:bg-gray-50">
                                    <td class="px-4 py-2">
                                        <input type="checkbox" name="category_id[]" value="{{ $category->id }}"  @if (in_array($category->id,$category_ids))  checked @endif>
                                    </td>
                                    <td class="px-4 py-2">{{ $category->name }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
            <div class="flex items-center justify-between">
                <button
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                    type="submit">
                    Submit
                </button>
            </div>
        </form>
    </div>

</x-admin-layout>
