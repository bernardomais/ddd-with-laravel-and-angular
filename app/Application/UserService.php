<?php

namespace App\Application;

use App\Domain\User\User;
use App\Domain\User\UserRepositoryInterface;
use App\Infrastructure\Validation\UserValidator;
use Illuminate\Validation\ValidationException;

class UserService
{
    private UserRepositoryInterface $userRepository;
    private UserValidator $userValidator;

    public function __construct(
        UserRepositoryInterface $userRepository,
        UserValidator $userValidator
    )
    {
        $this->userRepository = $userRepository;
        $this->userValidator = $userValidator;
    }

    public function createUser(array $data): User
    {
        if (!$this->userValidator->validate($data)) {
            throw ValidationException::withMessages($this->userValidator->getErrors());
        }

        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = bcrypt($data['password']);
        $user->save();

        return $user;
    }
}
