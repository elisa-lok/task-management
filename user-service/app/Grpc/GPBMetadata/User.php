<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# NO CHECKED-IN PROTOBUF GENCODE
# source: user.proto

namespace GPBMetadata;

class User
{
    public static $is_initialized = false;

    public static function initOnce() {
        $pool = \Google\Protobuf\Internal\DescriptorPool::getGeneratedPool();

        if (static::$is_initialized == true) {
          return;
        }
        $pool->internalAddGeneratedFile(
            "\x0A\xAD\x06\x0A\x0Auser.proto\x12\x04user\"D\x0A\x13RegisterUserRequest\x12\x0C\x0A\x04name\x18\x01 \x01(\x09\x12\x0D\x0A\x05email\x18\x02 \x01(\x09\x12\x10\x0A\x08password\x18\x03 \x01(\x09\"O\x0A\x14RegisterUserResponse\x12\x0F\x0A\x07user_id\x18\x01 \x01(\x09\x12\x0F\x0A\x07message\x18\x02 \x01(\x09\x12\x15\x0A\x0Derror_details\x18\x03 \x01(\x09\"3\x0A\x10LoginUserRequest\x12\x0D\x0A\x05email\x18\x01 \x01(\x09\x12\x10\x0A\x08password\x18\x02 \x01(\x09\"M\x0A\x11LoginUserResponse\x12\x0F\x0A\x07user_id\x18\x01 \x01(\x09\x12\x0F\x0A\x07message\x18\x02 \x01(\x09\x12\x16\x0A\x0Eremember_token\x18\x03 \x01(\x09\"\$\x0A\x11LogoutUserRequest\x12\x0F\x0A\x07user_id\x18\x01 \x01(\x09\"%\x0A\x12LogoutUserResponse\x12\x0F\x0A\x07message\x18\x01 \x01(\x09\"!\x0A\x0EGetUserRequest\x12\x0F\x0A\x07user_id\x18\x01 \x01(\x09\"x\x0A\x0FGetUserResponse\x12\x0F\x0A\x07user_id\x18\x01 \x01(\x09\x12\x0C\x0A\x04name\x18\x02 \x01(\x09\x12\x0D\x0A\x05email\x18\x03 \x01(\x09\x12\x12\x0A\x0Acreated_at\x18\x04 \x01(\x09\x12\x12\x0A\x0Aupdated_at\x18\x05 \x01(\x09\x12\x0F\x0A\x07message\x18\x06 \x01(\x092\x8B\x02\x0A\x0BUserService\x12E\x0A\x0CRegisterUser\x12\x19.user.RegisterUserRequest\x1A\x1A.user.RegisterUserResponse\x12<\x0A\x09LoginUser\x12\x16.user.LoginUserRequest\x1A\x17.user.LoginUserResponse\x12?\x0A\x0ALogoutUser\x12\x17.user.LogoutUserRequest\x1A\x18.user.LogoutUserResponse\x126\x0A\x07GetUser\x12\x14.user.GetUserRequest\x1A\x15.user.GetUserResponseb\x06proto3"
        , true);

        static::$is_initialized = true;
    }
}

