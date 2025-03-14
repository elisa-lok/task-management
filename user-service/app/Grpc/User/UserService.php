<?php

namespace User;

use User\GetUserRequest;
use User\GetUserResponse;
use User\LoginUserRequest;
use User\LoginUserResponse;
use User\LogoutUserRequest;
use User\LogoutUserResponse;
use User\RegisterUserRequest;
use User\RegisterUserResponse;
use Grpc\ServerContext;

class UserService extends UserServiceServer
{
    public function RegisterUser(RegisterUserRequest $request, ServerContext $context): RegisterUserResponse
    {
        $response = new RegisterUserResponse();
        $response->setUserId(1); 
        $response->setMessage("User registered successfully");
        return $response;
    }

    public function LoginUser(LoginUserRequest $request, ServerContext $context): LoginUserResponse
    {
        // 实现登录逻辑
        $response = new LoginUserResponse();
        $response->setRememberToken("test-token"); 
        $response->setMessage("User logged in successfully");
        return $response;
    }

    public function LogoutUser(LogoutUserRequest $request, ServerContext $context): LogoutUserResponse
    {
        $response = new LogoutUserResponse();
        $response->setMessage("User logged out successfully");
        return $response;
    }

    public function GetUser(GetUserRequest $request, ServerContext $context): GetUserResponse
    {
        $response = new GetUserResponse();
        $response->setUserId($request->getUserId());
        $response->setName("Elisa"); 
        $response->setEmail("elisa@example.com"); 
        return $response;
    }
}