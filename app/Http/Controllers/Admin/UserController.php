<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = (string) $request->query('search', '');

        $usersQuery = User::with('role')->orderByDesc('id');

        if ($search !== '') {
            $usersQuery->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%');
            });
        }

        $users = $usersQuery->get();

        return view('admin.users.index', [
            'users' => $users,
            'search' => $search,
        ]);
    }

    public function edit(User $user)
    {
        $roles = Role::orderBy('name')->get();

        return view('admin.users.edit', [
            'user' => $user,
            'roles' => $roles,
        ]);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $validated = $request->validated();

        $user->update($validated);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User deleted successfully.');
    }
}

