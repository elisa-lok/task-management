<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# NO CHECKED-IN PROTOBUF GENCODE
# source: task.proto

namespace Task;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>task.GetTaskRequest</code>
 */
class GetTaskRequest extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>int32 task_id = 1;</code>
     */
    protected $task_id = 0;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type int $task_id
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Task::initOnce();
        parent::__construct($data);
    }

    /**
     * Generated from protobuf field <code>int32 task_id = 1;</code>
     * @return int
     */
    public function getTaskId()
    {
        return $this->task_id;
    }

    /**
     * Generated from protobuf field <code>int32 task_id = 1;</code>
     * @param int $var
     * @return $this
     */
    public function setTaskId($var)
    {
        GPBUtil::checkInt32($var);
        $this->task_id = $var;

        return $this;
    }

}

