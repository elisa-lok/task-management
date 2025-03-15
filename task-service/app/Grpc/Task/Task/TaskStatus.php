<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# NO CHECKED-IN PROTOBUF GENCODE
# source: task.proto

namespace Task\Task;

use UnexpectedValueException;

/**
 * Protobuf type <code>task.Task.TaskStatus</code>
 */
class TaskStatus
{
    /**
     * Generated from protobuf enum <code>PENDING = 0;</code>
     */
    const PENDING = 0;
    /**
     * Generated from protobuf enum <code>IN_PROGRESS = 1;</code>
     */
    const IN_PROGRESS = 1;
    /**
     * Generated from protobuf enum <code>COMPLETED = 2;</code>
     */
    const COMPLETED = 2;

    private static $valueToName = [
        self::PENDING => 'PENDING',
        self::IN_PROGRESS => 'IN_PROGRESS',
        self::COMPLETED => 'COMPLETED',
    ];

    public static function name($value)
    {
        if (!isset(self::$valueToName[$value])) {
            throw new UnexpectedValueException(sprintf(
                    'Enum %s has no name defined for value %s', __CLASS__, $value));
        }
        return self::$valueToName[$value];
    }


    public static function value($name)
    {
        $const = __CLASS__ . '::' . strtoupper($name);
        if (!defined($const)) {
            throw new UnexpectedValueException(sprintf(
                    'Enum %s has no value defined for name %s', __CLASS__, $name));
        }
        return constant($const);
    }
}

