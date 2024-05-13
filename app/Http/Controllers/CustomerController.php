<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Models\CustomerAddress;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sort = $request->input('sort', 'id');
        $direction = $request->input('direction', 'asc');
        $query = User::query();
        $query->when($request->name, fn ($query) => $query->where('name', $request->name));
        $query->when($request->email, fn ($query) => $query->where('email', $request->email));
        $query->when($request->role)->whereHas('roles', fn ($query) => $query->where('name', $request->role));
        $query->orderBy($sort, $direction);
        $customer = $query->simplePaginate(10);
        $role = Role::all();
        return view('customer.index', compact('customer', 'role', 'direction'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CustomerRequest $request)
    {
        $data = $request->all();
        $user =  User::create($data);
        return to_route('customers.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $customer = User::find($id);
        $role = Role::all();
        $permission = Permission::all();
        return view('customer.role', compact('customer', 'role', 'permission'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $customer = User::find($id);
        return view('customer.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CustomerRequest $request, string $id)
    {
        $data = $request->all();
        $user =  User::find($id);
        $user->update($data);
        return to_route('customers.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user =  User::find($id);
        $user->delete();
        return back();
    }

    /**
     * Display a listing of the resource customer profile. 
     */
    public function customer_profile()
    {
        $user = Auth::user();
        $customerAddress = CustomerAddress::where('user_id', $user->id)->get();
        return view('customer.profile', compact('customerAddress'));
    }

    /**
     * Show the form for editing the specified resource for customer profile.
     */
    public function customer_profile_edit()
    {
        $user = Auth::user();
        $customer = User::find($user->id);
        return view('customer.profile_edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage for customer profile.
     */
    public function customer_profile_update(CustomerRequest $request, string $id)
    {
        $data = $request->only('first_name', 'last_name');
        $user = User::find($id);
        $user->update($data);
        return to_route('your.profile');
    }

    /**
     * Show the form for editing the specified resource for customer address.
     */
    public function customer_address_edit(string $id)
    {
        $customerAddress = CustomerAddress::find($id);
        return view('customer.address', compact('customerAddress'));
    }

    /**
     * Update the specified resource in storage for customer address.
     */
    public function customer_address_update(Request $request, string $id)
    {
        $data = $request->all();
        $customerAddress = CustomerAddress::find($id);
        $customerAddress->update($data);
        return to_route('your.profile');
    }




    // admin side
    public function assignRole(Request $request, User $user)
    {
        if ($user->hasRole($request->role)) {
            return back()->with('message', 'Role exists');
        }

        $user->assignRole($request->role);
        return back()->with('message', 'role assign');
    }

    public function removeRole(User $user, Role $role)
    {
        if ($user->hasRole($role)) {
            $user->removeRole($role);
            return back()->with('message', 'permission revoke');
        }

        return back()->with('message', 'Permission not exists');
    }

    public function givePermission(Request $request, User $user)
    {
        if ($user->hasPermissionTo($request->permission)) {
            dd('permission exists');
            return back()->with('message', 'permission exists');
        }

        $user->givePermissionTo($request->permission);
        return back()->with('message', 'Permission add');
    }

    public function revokePermission(User $user, Permission $permission)
    {
        if ($user->hasPermissionTo($permission)) {
            $user->revokePermissionTo($permission);
            return back()->with('message', 'permission revoke');
        }

        return back()->with('message', 'Permission not exists');
    }


    //EoF
}
