<?php
namespace App\Grpc;

require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/User/UserServiceImpl.php';

use Grpc\Server;
use User\UserServiceImpl;

/**
 * Automatically generates a method mapping table from a service implementation class
 *
 * @param object $serviceImpl The service implementation instance
 * @param string $serviceNamespace The protobuf package name
 * @param string $serviceName The service name as defined in proto file
 * @return array Method mapping table
 */
function generateMethodMap($serviceImpl, $serviceNamespace, $serviceName)
{
    $map     = [];
    $methods = get_class_methods($serviceImpl);

    foreach ($methods as $method) {
        // Skip constructor and private/protected methods
        if ($method === '__construct' || strpos($method, '_') === 0) {
            continue;
        }

        // Convert camelCase to PascalCase for the method name in the mapping
        $pascalMethod = ucfirst($method);

        // Build the full method name as it appears in gRPC requests
        $fullMethodName       = '/' . $serviceNamespace . '.' . $serviceName . '/' . $pascalMethod;
        $map[$fullMethodName] = $method;
    }

    return $map;
}

try {
    // Create gRPC server
    $server = new Server();
    $server->addHttp2Port('0.0.0.0:50051');

    // Create service implementation instance
    $serviceImpl = new UserServiceImpl();

    // Generate method mapping table automatically
    $methodMap = generateMethodMap($serviceImpl, 'user', 'UserService');

    // Log available methods
    echo "Server starting with the following mapped methods:\n";
    foreach ($methodMap as $fullMethod => $implMethod) {
        echo "- $fullMethod => $implMethod()\n";
    }

    // Start the server
    $server->start();
    echo "gRPC PHP Server started at 0.0.0.0:50051\n";
} catch (\Grpc\Exception\ServerException $e) {
    echo "gRPC Server Exception: " . $e->getMessage() . "\n";
    echo "Details: " . $e->getDetails() . "\n";
    echo "Code: " . $e->getCode() . "\n";
    exit(1);
} catch (\Exception $e) {
    echo "Error starting gRPC server: " . $e->getMessage() . "\n";
    exit(1);
}
