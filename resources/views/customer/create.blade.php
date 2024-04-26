<x-admin-layout>
          <h1>Customer Create</h1>
          <a href="{{ route('customers.index') }}" class="bg-blue-500 float-right hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Back</a>
          <div class="mx-auto block max-w-lg rounded-lg bg-white p-6 shadow-4 dark:bg-surface-dark">
              @include('include/error')
      
              <form action="{{ route('customers.store') }}" method="POST">
                  @csrf
                  <div class="mb-4">
                      <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                          Name
                      </label>
                      <input
                          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                          id="name" type="text" name="name"  placeholder="name">
                  </div>
      
                  <div class="mb-4">
                      <label class="block text-gray-700 text-sm font-bold mb-2" for="first_name">
                          First Name
                      </label>
                      <input
                          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                          id="first_name" type="text" name="first_name"  placeholder="First name">
                  </div>
                  <div class="mb-4">
                      <label class="block text-gray-700 text-sm font-bold mb-2" for="last_name">
                          Last Name
                      </label>
                      <input
                          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                          id="last_name" type="text" name="last_name"  placeholder="Last name">
                  </div>
                  <div class="mb-4">
                      <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                          Email
                      </label>
                      <input
                          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                          id="email" type="text" name="email"  placeholder="email">
                  </div>
                  <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                        Password
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="email" type="password" name="password"  placeholder="Passeword">
                </div>
                <div class="mb-4">
                  <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                    Confimed  Password
                  </label>
                  <input
                      class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                      id="password_confirmation" type="password" name="password_confirmation"  placeholder="Passeword">
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
