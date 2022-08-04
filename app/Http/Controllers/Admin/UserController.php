<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\Admin\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) {
            return view('admin.users.index');
        }

        $users = User::query();

        if ($request->role !== null) {
            $users->whereHas('roles', function($q) use ($request){
                $q->where('roles.id', $request->role);
            });
        }

        return User::dataTable($users);
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(UserRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);
        $user->roles()->attach($data['roles']);

        return $this->jsonSuccess('User created successfully', [
            'redirect' => route('admin.users.index')
        ]);
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(UserRequest $request, User $user)
    {
        $data = $request->validated();

        if ($data['password']) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);
        $user->roles()->sync($data['roles']);

        return $this->jsonSuccess('User updated successfully');
    }

    public function destroy(User $user)
    {
        if ($user->id == auth()->id()) {
            return $this->jsonError('Can not delete current user', [], 200);
        }

        $user->delete();

        return $this->jsonSuccess('User deleted successfully');
    }
}
