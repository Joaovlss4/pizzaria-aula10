<?php

namespace App\Services;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserService implements UserServiceInterface
{
    public function getAllUsers()
    {
        return User::paginate(10, ['id', 'name', 'email', 'created_at']);
    }

    public function getAuthenticatedUser()
    {
        return Auth::user();
    }

    public function createUser(UserCreateRequest $request)
    {
        $data = $request->all();
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function getUserById(string $id)
    {
        return User::find($id);
    }

    public function updateUser(UserUpdateRequest $request, string $id)
    {
        $user = User::find($id);
        if ($user) {
            $data = $request->all();
            if (isset($data['password'])) {
                $data['password'] = bcrypt($data['password']);
            }
            $user->update($data);
        }
        return $user;
    }

    public function deleteUser(string $id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
        }
        return $user;
    }
}
