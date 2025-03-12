<?php
namespace App\Http\Controllers;

use Grpc\ChannelCredentials;
use Illuminate\Http\Request;
use User\GetUserRequest;
use User\LoginUserRequest;
use User\LogoutUserRequest;
use User\RegisterUserRequest;
use User\UserServiceClient;

class UserController extends Controller
{
    private $client;

    public function __construct()
    {
        $this->client = new UserServiceClient('localhost:50051', [
            'credentials' => ChannelCredentials::createInsecure(),
        ]);
    }

    /**
     * Register a new user.
     */
    public function register(Request $request)
    {
        $grpcRequest = new RegisterUserRequest();
        $grpcRequest->setName($request->name);
        $grpcRequest->setEmail($request->email);
        $grpcRequest->setPassword($request->password);

        list($response, $status) = $this->client->RegisterUser($grpcRequest)->wait();
        return response()->json([
            'user_id'       => $response->getUserId(),
            'message'       => $response->getMessage(),
            'error_details' => $response->getErrorDetails(),
        ], $status->code);
    }

    /**
     * Login a user.
     */
    public function login(Request $request)
    {
        $grpcRequest = new LoginUserRequest();
        $grpcRequest->setEmail($request->email);
        $grpcRequest->setPassword($request->password);

        list($response, $status) = $this->client->LoginUser($grpcRequest)->wait();
        return response()->json([
            'user_id'        => $response->getUserId(),
            'message'        => $response->getMessage(),
            'remember_token' => $response->getRememberToken(),
        ], $status->code);
    }

    /**
     * Logout a user.
     */
    public function logout(Request $request)
    {
        $grpcRequest = new LogoutUserRequest();
        $grpcRequest->setUserId($request->user_id);

        list($response, $status) = $this->client->LogoutUser($grpcRequest)->wait();
        return response()->json(['message' => $response->getMessage()], $status->code);
    }

    /**
     * Get user details.
     */
    public function getUser($id)
    {
        $grpcRequest = new GetUserRequest();
        $grpcRequest->setUserId($id);

        list($response, $status) = $this->client->GetUser($grpcRequest)->wait();
        return response()->json([
            'user_id'    => $response->getUserId(),
            'name'       => $response->getName(),
            'email'      => $response->getEmail(),
            'created_at' => $response->getCreatedAt(),
            'updated_at' => $response->getUpdatedAt(),
            'message'    => $response->getMessage(),
        ], $status->code);
    }
}
