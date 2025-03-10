<?php
namespace App\Services;

use User\GetUserRequest;
use User\LoginUserRequest;
use User\LogoutUserRequest;
use User\RegisterUserRequest;
use User\UserServiceClient;

class UserService
{
    private $userServiceClient;

    public function __construct(UserServiceClient $userServiceClient)
    {
        $this->userServiceClient = $userServiceClient;
    }

    public function registerUser(array $userData): array
    {
        $request = new RegisterUserRequest();
        $request->setName($userData['name']);
        $request->setPassword($userData['password']);
        list($response, $status) = $this->userServiceClient->RegisterUser($request)->wait();

        if ($status->code !== 0) { //\Grpc\STATUS_OK
            return [
                'code'    => 500,
                'message' => 'Register user error: ' . $status->details,
            ];
        }

        return [
            'userId'  => $response->getUserId(),
            'message' => $response->getMessage(),
        ];
    }

    public function loginUser(array $userData): array
    {
        $request = new LoginUserRequest();
        $request->setEmail($userData['email']);
        $request->setPassword($userData['password']);
        list($response, $status) = $this->userServiceClient->LoginUser($request)->wait();

        if ($status->code !== 0) {
            return [
                'code'    => 500,
                'message' => 'Login error: ' . $status->details,
            ];
        }

        return [
            'token'   => $response->getToken(),
            'message' => $response->getMessage(),
        ];
    }

    public function logoutUser(array $userData): array
    {
        $request = new LogoutUserRequest();
        $request->setUserId($userData['token']);
        list($response, $status) = $this->userServiceClient->LogoutUser($request)->wait();

        if ($status->code !== 0) {
            return [
                'code'    => 500,
                'message' => 'Logout error: ' . $status->details,
            ];
        }

        return [
            'message' => $response->getMessage(),
        ];
    }

    public function getUser(int $userId): array
    {
        $request = new GetUserRequest();
        $request->setUserId($userId);
        list($response, $status) = $this->userServiceClient->GetUser($request)->wait();

        if ($status->code !== 0) {
            return [
                'code'    => 500,
                'message' => 'Fetch user data error: ' . $status->details,
            ];
        }

        return [
            'userId'   => $response->getUserId(),
            'username' => $response->getUsername(),
            'email'    => $response->getEmail(),
        ];
    }
}
