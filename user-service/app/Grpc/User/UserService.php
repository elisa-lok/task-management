<?php

// app/Grpc/UserService.php

namespace App\Grpc;

use User\LoginUserRequest;
use User\LoginUserResponse;
use User\RegisterUserRequest;
use User\RegisterUserResponse;
use User\LogoutUserRequest;
use User\LogoutUserResponse;
use User\GetUserRequest;
use User\GetUserResponse;

interface UserService
{
    public function RegisterUser(RegisterUserRequest $request): RegisterUserResponse;
    public function LoginUser(LoginUserRequest $request): LoginUserResponse;
    public function LogoutUser(LogoutUserRequest $request): LogoutUserResponse;
    public function GetUser(GetUserRequest $request): GetUserResponse;
}
