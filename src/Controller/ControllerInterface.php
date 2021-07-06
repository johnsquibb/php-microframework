<?php declare(strict_types=1);

namespace PhpMicroframework\Controller;

use PhpMicroframework\Controller\Response\ResponseInterface;

interface ControllerInterface
{
    public function main(): ResponseInterface;
}