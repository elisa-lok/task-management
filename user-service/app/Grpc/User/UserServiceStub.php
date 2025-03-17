<?php
// GENERATED CODE -- DO NOT EDIT!

namespace User;

/**
 */
class UserServiceStub
{

    /**
     * @param \User\RegisterUserRequest $request client request
     * @param \Grpc\ServerContext $context server request context
     * @return \User\RegisterUserResponse for response data, null if if error occured
     *     initial metadata (if any) and status (if not ok) should be set to $context
     */
    public function RegisterUser(
        \User\RegisterUserRequest $request,
        \Grpc\ServerContext $context
    ): ?\User\RegisterUserResponse {
        $context->setStatus(\Grpc\Status::unimplemented());
        return null;
    }

    /**
     * @param \User\LoginUserRequest $request client request
     * @param \Grpc\ServerContext $context server request context
     * @return \User\LoginUserResponse for response data, null if if error occured
     *     initial metadata (if any) and status (if not ok) should be set to $context
     */
    public function LoginUser(
        \User\LoginUserRequest $request,
        \Grpc\ServerContext $context
    ): ?\User\LoginUserResponse {
        $context->setStatus(\Grpc\Status::unimplemented());
        return null;
    }

    /**
     * @param \User\LogoutUserRequest $request client request
     * @param \Grpc\ServerContext $context server request context
     * @return \User\LogoutUserResponse for response data, null if if error occured
     *     initial metadata (if any) and status (if not ok) should be set to $context
     */
    public function LogoutUser(
        \User\LogoutUserRequest $request,
        \Grpc\ServerContext $context
    ): ?\User\LogoutUserResponse {
        $context->setStatus(\Grpc\Status::unimplemented());
        return null;
    }

    /**
     * @param \User\GetUserRequest $request client request
     * @param \Grpc\ServerContext $context server request context
     * @return \User\GetUserResponse for response data, null if if error occured
     *     initial metadata (if any) and status (if not ok) should be set to $context
     */
    public function GetUser(
        \User\GetUserRequest $request,
        \Grpc\ServerContext $context
    ): ?\User\GetUserResponse {
        $context->setStatus(\Grpc\Status::unimplemented());
        return null;
    }

    /**
     * Get the method descriptors of the service for server registration
     *
     * @return array of \Grpc\MethodDescriptor for the service methods
     */
    final public function getMethodDescriptors() : array
    {
        return [
            '/user.UserService/RegisterUser' => new \Grpc\MethodDescriptor(
                $this,
                'RegisterUser',
                '\User\RegisterUserRequest',
                \Grpc\MethodDescriptor::UNARY_CALL
            ),
            '/user.UserService/LoginUser'    => new \Grpc\MethodDescriptor(
                $this,
                'LoginUser',
                '\User\LoginUserRequest',
                \Grpc\MethodDescriptor::UNARY_CALL
            ),
            '/user.UserService/LogoutUser'   => new \Grpc\MethodDescriptor(
                $this,
                'LogoutUser',
                '\User\LogoutUserRequest',
                \Grpc\MethodDescriptor::UNARY_CALL
            ),
            '/user.UserService/GetUser'      => new \Grpc\MethodDescriptor(
                $this,
                'GetUser',
                '\User\GetUserRequest',
                \Grpc\MethodDescriptor::UNARY_CALL
            ),
        ];
    }

}
