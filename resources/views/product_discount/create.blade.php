<x-admin-layout>
    <h1>Customer Group Create</h1>
    <a href="{{ route('product-discount.index') }}" class="bg-blue-500 float-right hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Back</a>
    <div class="mx-auto block max-w-lg rounded-lg bg-white p-6 shadow-4 dark:bg-surface-dark">
        @include('include/error')

        <form action="{{ route('product-discount.store') }}" method="POST">
            @csrf
            
            <div class="mt-4 mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="customer_groups_id">
                    Product
                </label>
                <select name="products_id" id="customer_groups_id" class="shadow appearance-none border bg-white rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <option value=""></option>
                    @foreach ($products as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mt-4 mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="customer_groups_id">
                    Customer Group 
                </label>
                <select name="customer_group" id="customer_groups_id" class="shadow appearance-none border bg-white rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <option value="whole sale">Whole Sale</option>
                    <option value="retail">Retail</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                    Quantity
                </label>
                <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="quantity" type="text" name="quantity" value="{{ old('quantity') }}" placeholder="Quantity">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                    Discount 
                </label>
                <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="discount" type="text" name="discount_price"  value="{{ old('discount_price') }}" placeholder="Discount Amount">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                    Start Date
                </label>
                <input
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                id="start_date" type="date" name="start_date" value="{{ old('start_date') }}" placeholder="start date">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                    End Date
                </label>
                <input
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                id="end_date" type="date" name="end_date" value="{{ old('end_date') }}" placeholder="end date">
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
