<?php

namespace Middleware;

use Mizi\Middleware\InterfaceMiddleware;
use Mizi\Response\InstanceResponse;
use Mizi\Response\InstanceResponsePage;

/** Middleware page */
abstract class MidPage implements InterfaceMiddleware
{
    static function run(callable $next): mixed
    {
        $return = $next();

        if (!is_class($return, InstanceResponse::class))
            $return = new InstanceResponsePage($return);

        return $return;
    }
}