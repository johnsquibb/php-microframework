<?php declare(strict_types=1);

namespace PhpMicroframework\Framework\Controller;

use PhpMicroframework\Framework\Controller\Response\JsonResponse;
use PhpMicroframework\Framework\Controller\Response\ResponseInterface;

class CoreController extends AbstractController
{
    public function json(): ResponseInterface
    {
        return new JsonResponse(
            [
                'controller' => self::class,
                'method' => __FUNCTION__,
                'message' => 'PHP Microframework'
            ]
        );
    }
}