<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Services\UserServiceInterface;

/**
 * Class UserController
 *
 * @package App\Http\Controllers
 * @author Vinícius Siqueira
 * @link https://github.com/ViniciusSCS
 * @date 2024-08-23 21:48:54
 * @copyright UniEVANGÉLICA
 */
class UserController extends Controller
{
    private $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        return [
            'status' => 200,
            'message' => 'Usuários encontrados!',
            'user' => $this->userService->getAllUsers()
        ];
    }

    public function me()
    {
        return [
            'status' => 200,
            'message' => 'Usuário logado!',
            'usuario' => $this->userService->getAuthenticatedUser()
        ];
    }

    public function store(UserCreateRequest $request)
    {
        $user = $this->userService->createUser($request);

        return [
            'status' => 200,
            'message' => 'Usuário cadastrado com sucesso!',
            'user' => $user
        ];
    }

    public function show(string $id)
    {
        $user = $this->userService->getUserById($id);

        return $user
            ? ['status' => 200, 'message' => 'Usuário encontrado com sucesso!', 'user' => $user]
            : ['status' => 404, 'message' => 'Usuário não encontrado!'];
    }

    public function update(UserUpdateRequest $request, string $id)
    {
        $user = $this->userService->updateUser($request, $id);

        return $user
            ? ['status' => 200, 'message' => 'Usuário atualizado com sucesso!', 'user' => $user]
            : ['status' => 404, 'message' => 'Usuário não encontrado!'];
    }

    public function destroy(string $id)
    {
        $deleted = $this->userService->deleteUser($id);

        return $deleted
            ? ['status' => 200, 'message' => 'Usuário deletado com sucesso!']
            : ['status' => 404, 'message' => 'Usuário não encontrado!'];
    }
}