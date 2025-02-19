<?php

namespace App\Services;

use App\Repository\AuthRepository;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    protected $authRepository;

    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function login(array $credentials): bool
    {
        return Auth::attempt($credentials);
    }

    public function register(array $data)
    {
        return $this->authRepository->createUser($data);
    }

    public function logout()
    {
        Auth::logout();
    }
}