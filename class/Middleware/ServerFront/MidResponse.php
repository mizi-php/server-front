<?php

namespace Middleware\ServerFront;

use Mizi\Middleware\InterfaceMiddleware;
use Mizi\Response\InstanceResponse;
use Mizi\Response\InstanceResponsePage;

/** Middleware ServerFront.response */
abstract class MidResponse implements InterfaceMiddleware
{
    static function run(callable $next): mixed
    {
        $response = $next();

        if (!is_class($response, InstanceResponse::class))
            $response = new InstanceResponsePage($response);

        return $response;
    }
}