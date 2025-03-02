<?php
// GENERATED CODE -- DO NOT EDIT!

namespace User;

/**
 */
class UserServiceClient extends \Grpc\BaseStub {

    /**
     * @param string $hostname hostname
     * @param array $opts channel options
     * @param \Grpc\Channel $channel (optional) re-use channel object
     */
    public function __construct($hostname, $opts, $channel = null) {
        parent::__construct($hostname, $opts, $channel);
    }

    /**
     * @param \User\RegisterUserRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function RegisterUser(\User\RegisterUserRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/user.UserService/RegisterUser',
        $argument,
        ['\User\RegisterUserResponse', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \User\LoginUserRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function LoginUser(\User\LoginUserRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/user.UserService/LoginUser',
        $argument,
        ['\User\LoginUserResponse', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \User\LogoutUserRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function LogoutUser(\User\LogoutUserRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/user.UserService/LogoutUser',
        $argument,
        ['\User\LogoutUserResponse', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \User\GetUserRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function GetUser(\User\GetUserRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/user.UserService/GetUser',
        $argument,
        ['\User\GetUserResponse', 'decode'],
        $metadata, $options);
    }

}
