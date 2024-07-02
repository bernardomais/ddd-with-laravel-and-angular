<?php

namespace App\Application\Services;

use App\Domain\User\User;
use App\Domain\User\UserRepositoryInterface;
use App\Application\Requests\UserCreateRequest;
use Illuminate\Validation\ValidationException;

class UserService
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function createUser(UserCreateRequest $request): User
    {
        $this->validateRequest($request);

        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ];

        return $this->userRepository->create($userData);
    }

    public function validateRequest(UserCreateRequest $request): void
    {
        $validator = validator($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8'
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }
}
