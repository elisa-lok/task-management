<?php
namespace App\Grpc;

require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/User/UserService.php';

use Grpc\Server;
use User\UserService;

// start gRPC server
$server = new Server();
$server->addHttp2Port('0.0.0.0:50051');

// register UserService
$userService = new UserService();

echo "gRPC server running on 0.0.0.0:50051\n";
$server->start(); // Start the server
