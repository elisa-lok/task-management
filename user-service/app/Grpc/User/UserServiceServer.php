<?php
namespace User;

use Grpc\ServerContext;
use User\GetUserRequest;
use User\GetUserResponse;
use User\LoginUserRequest;
use User\LoginUserResponse;
use User\LogoutUserRequest;
use User\LogoutUserResponse;
use User\RegisterUserRequest;
use User\RegisterUserResponse;

abstract class UserServiceServer
{
    abstract public function RegisterUser(RegisterUserRequest $request, ServerContext $context): RegisterUserResponse;

    abstract public function LoginUser(LoginUserRequest $request, ServerContext $context): LoginUserResponse;

    abstract public function LogoutUser(LogoutUserRequest $request, ServerContext $context): LogoutUserResponse;

    abstract public function GetUser(GetUserRequest $request, ServerContext $context): GetUserResponse;
}
