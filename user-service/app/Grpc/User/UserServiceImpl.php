<?php

// app/Grpc/UserServiceImpl.php

namespace App\Grpc;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use User\LoginUserRequest;
use User\LoginUserResponse;
use User\LogoutUserRequest;
use User\LogoutUserResponse;
use User\RegisterUserRequest;
use User\RegisterUserResponse;
use User\GetUserRequest;
use User\GetUserResponse;

class UserServiceImpl implements UserService
{
    public function RegisterUser(RegisterUserRequest $request): RegisterUserResponse
    {
        $name     = $request->getName();
        $email    = $request->getEmail();
        $password = $request->getPassword();

        $validator = Validator::make(
            ['name' => $name, 'email' => $email, 'password' => $password],
            [
                'name'     => 'required|string|max:255',
                'email'    => 'required|email|unique:users,email',
                'password' => 'required|string|min:8',
            ]
        );

        if ($validator->fails()) {
            $response = new RegisterUserResponse();
            $response->setMessage('Validation failed');
            $response->setErrorDetails($validator->errors()->first());
            return $response;
        }

        $existingUser = User::where('email', $email)->first();
        if ($existingUser) {
            $response = new RegisterUserResponse();
            $response->setMessage('Email already registered');
            return $response;
        }

        $user = User::create([
            'name'     => $name,
            'email'    => $email,
            'password' => Hash::make($password),
        ]);

        // $user->sendEmailVerificationNotification();

        $response = new RegisterUserResponse();
        $response->setUserId($user->id);
        $response->setMessage('User registered successfully');

        return $response;
    }

    public function LoginUser(LoginUserRequest $request): LoginUserResponse
    {
        $response = new LoginUserResponse();
        $email    = $request->getEmail();
        $password = $request->getPassword();

        $user = User::where('email', $email)->first();

        if (! $user || ! Hash::check($password, $user->password)) {
            $response->setMessage('Invalid email or password');
            return $response;
        }

        $rememberToken        = Str::random(60);
        $user->remember_token = $rememberToken;
        $user->save();

        $response->setUserId($user->id);
        $response->setMessage('Login successful');
        $response->setRememberToken($rememberToken);
        return $response;
    }

    public function LogoutUser(LogoutUserRequest $request): LogoutUserResponse
    {
        $response = new LogoutUserResponse();
        $userId   = $request->getUserId();

        $user = User::find($userId);
        if (! $user) {
            $response->setMessage('User not found');
            return $response;
        }

        $user->remember_token = null;
        $user->save();

        $response->setMessage('Logout successful');
        return $response;
    }

    public function GetUser(GetUserRequest $request): GetUserResponse
    {
        $response = new GetUserResponse();
        $userId   = $request->getUserId();

        $user = User::find($userId);
        if (! $user) {
            $response->setMessage('User not found');
            return $response;
        }

        $response->setUserId($user->id);
        $response->setName($user->name);
        $response->setEmail($user->email);
        $response->setMessage('User retrieved successfully');
        return $response;
    }

}
