<?php
namespace User;

use App\Models\User;
use Grpc\ServerContext;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use User\GetUserRequest;
use User\GetUserResponse;
use User\LoginUserRequest;
use User\LoginUserResponse;
use User\LogoutUserRequest;
use User\LogoutUserResponse;
use User\RegisterUserRequest;
use User\RegisterUserResponse;

class UserServiceImpl extends UserServiceStub
{
    public function RegisterUser(RegisterUserRequest $request, ServerContext $context): RegisterUserResponse
    {
        $response = new RegisterUserResponse();
        try {
            $user = User::create([
                'name'     => $request->getName(),
                'email'    => $request->getEmail(),
                'password' => $request->getPassword(), // Laravel will hash it automatically
            ]);

            $response->setUserId($user->id);
            $response->setMessage("User registered successfully");
        } catch (\Exception $e) {
            $response->setMessage("Registration failed: " . $e->getMessage());
        }

        return $response;
    }

    public function LoginUser(LoginUserRequest $request, ServerContext $context): LoginUserResponse
    {
        // implement login logic
        $response = new LoginUserResponse();
        $user     = User::where('email', $request->getEmail())->first();

        if ($user && Hash::check($request->getPassword(), $user->password)) {
            $token                = Str::random(60);
            $user->remember_token = $token;
            $user->save();

            $response->setRememberToken($token);
            $response->setMessage("User logged in successfully");
        } else {
            $response->setMessage("Invalid email or password");
        }
        return $response;
    }

    public function LogoutUser(LogoutUserRequest $request, ServerContext $context): LogoutUserResponse
    {
        $response = new LogoutUserResponse();
        $user     = User::where('remember_token', $request->getRememberToken())->first();

        if ($user) {
            $user->remember_token = null;
            $user->save();
            $response->setMessage("User logged out successfully");
        } else {
            $response->setMessage("Invalid token");
        }

        return $response;
    }

    public function GetUser(GetUserRequest $request, ServerContext $context): GetUserResponse
    {
        $response = new GetUserResponse();
        $user     = User::find($request->getUserId());

        if ($user) {
            $response->setUserId($user->id);
            $response->setName($user->name);
            $response->setEmail($user->email);
        } else {
            $response->setMessage("User not found");
        }

        return $response;
    }
}
