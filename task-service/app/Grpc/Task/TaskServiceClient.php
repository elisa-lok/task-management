<?php
// GENERATED CODE -- DO NOT EDIT!

namespace Task;

/**
 */
class TaskServiceClient extends \Grpc\BaseStub {

    /**
     * @param string $hostname hostname
     * @param array $opts channel options
     * @param \Grpc\Channel $channel (optional) re-use channel object
     */
    public function __construct($hostname, $opts, $channel = null) {
        parent::__construct($hostname, $opts, $channel);
    }

    /**
     * @param \Task\CreateTaskRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function CreateTask(\Task\CreateTaskRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/task.TaskService/CreateTask',
        $argument,
        ['\Task\Task', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \Task\GetTaskRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function GetTask(\Task\GetTaskRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/task.TaskService/GetTask',
        $argument,
        ['\Task\Task', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \Task\UpdateTaskStatusRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function UpdateTaskStatus(\Task\UpdateTaskStatusRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/task.TaskService/UpdateTaskStatus',
        $argument,
        ['\Task\Task', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \Task\ListUserTasksRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function ListUserTasks(\Task\ListUserTasksRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/task.TaskService/ListUserTasks',
        $argument,
        ['\Task\ListUserTasksResponse', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \Task\DeleteTaskRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function DeleteTask(\Task\DeleteTaskRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/task.TaskService/DeleteTask',
        $argument,
        ['\Task\DeleteTaskResponse', 'decode'],
        $metadata, $options);
    }

}
