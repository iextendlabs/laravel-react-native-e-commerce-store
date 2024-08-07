<div id="sideBar"
    class="relative flex flex-col flex-wrap bg-white border-r border-gray-300 p-6 flex-none w-64 md:-ml-64 md:fixed md:top-0 md:z-30 md:h-screen md:shadow-xl animated faster">

    <H1><Strong>Admin Dashboard</Strong></H1>

    <!-- sidebar content -->
    <div class="flex flex-col my-3">

        <!-- sidebar toggle -->
        <div class="text-right hidden md:block mb-4">
            <button id="sideBarHideBtn">
                <i class="fad fa-times-circle"></i>
            </button>
        </div>
        <!-- end sidebar toggle -->

        <p class="uppercase text-xs text-gray-600 mb-4 tracking-wider">homes</p>

        <!-- link -->
        <a href="admin"
            class="mb-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500">
            <i class="fad fa-shopping-cart text-xs mr-2"></i>
            ecommerce dashboard
        </a>
        <!-- end link -->

        <p class="uppercase text-xs text-gray-600 mb-4 mt-4 tracking-wider">apps</p>
        <!-- link -->
        <a href="/customers"
            class="mb-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500">
            <i class="fad fa-regular fa-user"></i>
            Customer
        </a>
        <!-- end link -->

        <!-- link -->
        <a href="/categories"
            class="mb-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500">
            <i class="fad fa-sharp fa-regular fa-layer-group"></i>
            Category
        </a>

        <a href="/products"
            class="mb-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500">

            <i class="fad fa-solid fa-shapes"></i>
            Products
        </a>

        <a href="/product-images"
            class="mb-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500">

            <i class="fad fa-solid fa-shapes"></i>
            Products Image
        </a>

        <!-- link -->
        <a href="{{ route('orders') }}"
            class="mb-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500">

            <i class="fad fa-solid fa-shapes"></i>
            Orders
        </a>

        <!-- link -->
        <a href="/roles"
            class="mb-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500">
            <i class="fad fa-regular fa-user"></i>
            Roles
        </a>
        <!-- end link -->

        <!-- link -->
        <a href="/permissions"
            class="mb-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500">
            <i class="fad fa-regular fa-user"></i>
            Permission
        </a>
        <!-- end link -->

        <!-- link -->
        <a href="{{ route('coupons.index') }}"
            class="mb-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500">
            <i class="fad fa-box-open text-xs mr-2"></i>
            Coupons
        </a>
        <!-- end link -->

        <!-- link -->
        <a href="{{ route('customer-group.index') }}"
            class="mb-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500">
            <i class="fad fa-box-open text-xs mr-2"></i>
            Customer Groups
        </a>

        <a href="{{ route('product-discount.index') }}"
            class="mb-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500">
            <i class="fad fa-box-open text-xs mr-2"></i>
            Product Discount 
        </a>
        <!-- end link -->
        {{-- <p class="uppercase text-xs text-gray-600 mb-4 mt-4 tracking-wider">UI Elements</p>

        <!-- link -->
        <a href="#"
            class="mb-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500">
            <i class="fad fa-swatchbook text-xs mr-2"></i>
            colors
        </a>
        <!-- end link -->

        <!-- link -->
        <a href="#"
            class="mb-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500">
            <i class="fad fa-atom-alt text-xs mr-2"></i>
            icons
        </a>
        <!-- end link -->

        <!-- link -->
        <a href="#"
            class="mb-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500">
            <i class="fad fa-club text-xs mr-2"></i>
            card
        </a>
        <!-- end link -->

        <!-- link -->
        <a href="#"
            class="mb-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500">
            <i class="fad fa-cheese-swiss text-xs mr-2"></i>
            Widgets
        </a>
        <!-- end link -->

        <!-- link -->
        <a href="#"
            class="mb-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500">
            <i class="fad fa-computer-classic text-xs mr-2"></i>
            Components
        </a>
        <!-- end link -->
 --}}


    </div>
    <!-- end sidebar content -->

</div>
