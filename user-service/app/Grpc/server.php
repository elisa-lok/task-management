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

// Request handling loop
while (true) {
    try {
        // Wait for incoming request
        $request = $server->requestCall();

        if ($request) {
            $method = $request->method ?? '';
            echo "Received call for method: " . $method . "\n";

            // Check if method exists in our mapping
            if (isset($methodMap[$method])) {
                $handlerMethod = $methodMap[$method];

                try {
                    // Call the appropriate method on the service implementation
                    // Note: The exact parameters may need adjustment based on your actual request structure
                    $result = $serviceImpl->$handlerMethod($request->decoded, $request->context);

                    // Send response
                    // Note: The exact response handling will depend on your gRPC PHP version
                    $request->context->send($result);

                    echo "Successfully processed method: $method\n";
                } catch (\Exception $e) {
                    echo "Error in method handler: " . $e->getMessage() . "\n";
                    // Send error response if possible
                    if (method_exists($request->context, 'sendError')) {
                        $request->context->sendError($e->getCode(), $e->getMessage());
                    }
                }
            } else {
                echo "Unknown method: " . $method . "\n";
                // Handle unknown method
                if (method_exists($request->context, 'sendError')) {
                    $request->context->sendError(4, 'Unknown method');
                }
            }
        }
    } catch (\Exception $e) {
        echo "Error processing request: " . $e->getMessage() . "\n";
    }
}
