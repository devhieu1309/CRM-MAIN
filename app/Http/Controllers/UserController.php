<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $withDeleted = null;

        if (request('deleted') === 'true') {
            $withDeleted = true;
        }

        $users = User::with('roles')->when($withDeleted, function ($query) {
            return $query->onlyTrashed();
        })->paginate(7);

        return view('users.index', [
            'users' => $users,
            'withDeleted' => $withDeleted
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('users.create', [
            'roles' => $roles
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->validated());

        if ($request->has('terms_accepted')) {
            $user->terms_accepted_at = now();
            $user->save();
        }

        if ($request->has('role')) {
            $user->syncRoles($request->role);
        }

        return redirect()->route('users.index')->with('status', 'Thêm mới người dùng thành công.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $user->load('roles');
        $roles = Role::all();
        return view('users.edit', [
            'user' => $user,
            'roles' => $roles
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $data = $request->validated();

        if ($request->has('password')) {
            $data['password'] = Hash::make($request->password);
        } else {
            unset($data['password']);
        }
        $user->update($data);

        if ($request->has('terms_accepted') && !$user->terms_accepted_at) {
            $user->terms_accepted_at = now();
            $user->save();
        }

        if ($request->has('role')) {
            $user->syncRoles($request->role);
        }

        return redirect()->route('users.index')->with('status', 'Cập nhật người dùng thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('status', 'Xóa người dùng thành công.');
    }

    public function restore(User $user)
    {
        $user->restore();
        return redirect()->back()->with('status', 'Khôi phục người dùng thành công.');
    }

    public function forceDelete(User $user)
    {
        $user->forceDelete();
        return redirect()->back()->with('status', 'Xóa vĩnh viễn người dùng thành công.');
    }
}
