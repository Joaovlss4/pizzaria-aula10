<?php

namespace App\Services;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;

interface UserServiceInterface
{
    public function getAllUsers();
    public function getAuthenticatedUser();
    public function createUser(UserCreateRequest $request);
    public function getUserById(string $id);
    public function updateUser(UserUpdateRequest $request, string $id);
    public function deleteUser(string $id);
}
