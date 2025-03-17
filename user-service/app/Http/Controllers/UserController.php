<?php
namespace App\Http\Controllers;

use Grpc\ChannelCredentials;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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
        $this->client = new UserServiceClient('127.0.0.1:50051', [
            'credentials' => ChannelCredentials::createInsecure(),
        ]);
    }

    /**
     * Register a new user.
     */
    public function register(Request $request)
    {
        Log::info('Register user request:', $request->all());

        $grpcRequest = new RegisterUserRequest();
        $grpcRequest->setName($request->name);
        $grpcRequest->setEmail($request->email);
        $grpcRequest->setPassword($request->password);

        $result = $this->callGrpcMethod('RegisterUser', $grpcRequest);

        if (isset($result['error'])) {
            return response()->json($result, 500);
        }

        Log::info('Register user response:', [
            'user_id' => $result->getUserId(),
            'message' => $result->getMessage(),
        ]);

        return response()->json([
            'user_id' => $result->getUserId(),
            'message' => $result->getMessage(),
        ]);
    }

    /**
     * Login a user.
     */
    public function login(Request $request)
    {
        Log::info('Login user request:', $request->all());

        $grpcRequest = new LoginUserRequest();
        $grpcRequest->setEmail($request->email);
        $grpcRequest->setPassword($request->password);

        $result = $this->callGrpcMethod('LoginUser', $grpcRequest);

        if (isset($result['error'])) {
            return response()->json($result, 500);
        }

        Log::info('Login user response:', [
            'user_id' => $result->getUserId(),
            'message' => $result->getMessage(),
            'token'   => $result->getRememberToken(),
        ]);

        return response()->json([
            'user_id' => $result->getUserId(),
            'message' => $result->getMessage(),
            'token'   => $result->getRememberToken(),
        ]);
    }

    /**
     * Logout a user.
     */
    public function logout(Request $request)
    {
        Log::info('Logout user request:', $request->all());

        $grpcRequest = new LogoutUserRequest();
        $grpcRequest->setUserId($request->user_id);

        $result = $this->callGrpcMethod('LogoutUser', $grpcRequest);

        if (isset($result['error'])) {
            return response()->json($result, 500);
        }

        Log::info('Logout user response:', [
            'message' => $result->getMessage(),
        ]);

        return response()->json([
            'message' => $result->getMessage(),
        ]);
    }

    /**
     * Get user details.
     */
    public function getUser($id)
    {
        Log::info('Get user request:', ['user_id' => $id]);

        $grpcRequest = new GetUserRequest();
        $grpcRequest->setUserId($id);

        $result = $this->callGrpcMethod('GetUser', $grpcRequest);

        if (isset($result['error'])) {
            return response()->json($result, 500);
        }

        Log::info('Get user response:', [
            'user_id' => $result->getUserId(),
            'name'    => $result->getName(),
            'email'   => $result->getEmail(),
        ]);

        return response()->json([
            'user_id'    => $result->getUserId(),
            'name'       => $result->getName(),
            'email'      => $result->getEmail(),
            'created_at' => $result->getCreatedAt(),
            'updated_at' => $result->getUpdatedAt(),
            'message'    => $result->getMessage(),
        ]);
    }

    private function callGrpcMethod($method, $request)
    {
        var_dump($this->client);
        list($response, $status) = $this->client->$method($request)->wait();

        if ($status->code !== \Grpc\STATUS_OK) {
            return [
                'error'   => 'gRPC call failed',
                'details' => $status->details,
                'code'    => $status->code,
            ];
        }

        return $response;
    }

}
