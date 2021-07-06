<?php

namespace PhpMicroframework\Framework\Controller;

use PhpMicroframework\Framework\Controller\Response\JsonResponse;
use PhpMicroframework\Framework\Controller\Response\ResponseInterface;

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