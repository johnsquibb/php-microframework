<?php

namespace PhpMicroframework\Controller;

use PhpMicroframework\Controller\Response\JsonResponse;
use PhpMicroframework\Controller\Response\ResponseInterface;

abstract class AbstractController implements ControllerInterface
{
    public function main(): ResponseInterface
    {
        return new JsonResponse(
            [
                'controller' => self::class,
                'method' => __FUNCTION__,
                'message' => 'This is the default controller method.'
            ]
        );
    }
}