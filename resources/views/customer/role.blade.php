<x-admin-layout>
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Role and Permissinon

                    </h2>
                    <hr>
                    <div class="float-end">
                        <a href="{{ route('customers.index') }}"
                            class="bg-blue-500 float-right hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Back</a>
                    </div>
                </div>
            </div>
        </div>

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div>
            <div><strong>Name:</strong> {{ $customer->name }}</div>
            <div><strong>Email:</strong> {{ $customer->email }}</div>
        </div>
        <div class="mx-auto block max-w-lg rounded-lg bg-white p-6 shadow-4 dark:bg-surface-dark">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h2>Roles
                            <div>
                                @foreach ($customer->roles as $user_role)
                                    <form class="mb-3" action="{{ route('customers.role.remove', [$customer->id, $user_role->id]) }}"
                                        method="POST" onsubmit="return confirm('Are you sure?');">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger ">{{ $user_role->name }}</button>
                                    </form>
                                @endforeach

                            </div>
                            <form action="{{ route('customers.role', $customer->id) }}" method="POST">
                                @csrf
                                <div class="col-xs-12 mb-3">
                                    <div class="form-group">
                                        <select class="form-select mt-3" aria-label="Default select example"
                                            name="role">
                                            @foreach ($role as $item)
                                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-12 mb-3 text-center">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </h2>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h2>Permission
                            <div class="">
                                @foreach ($customer->permissions as $user_permission)
                                    <form class="mb-3"
                                        action="{{ route('customers.permissions.revoke', [$customer->id, $user_permission->id]) }}"
                                        method="POST"
                                        onsubmit="return confirm('Are you sure? . $user_permission->name');">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit"
                                            class="btn btn-danger">{{ $user_permission->name }}</button>
                                    </form>
                                @endforeach
                            </div>
                            <form action="{{ route('customers.permissions', $customer->id) }}" method="POST">
                                @csrf
                                <div class="col-xs-12 mb-3 ">
                                    <div class="form-group ">
                                        <select class="form-select mt-3" aria-label="Default select example"
                                            name="permission">
                                            @foreach ($permission as $item)
                                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-12 mb-3 text-center">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </h2>
                    </div>
                </div>


            </div>
        </div>
    </div>
</x-admin-layout>
