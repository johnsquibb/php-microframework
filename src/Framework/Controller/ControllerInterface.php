<?php declare(strict_types=1);

namespace PhpMicroframework\Framework\Controller;

use PhpMicroframework\Framework\Controller\Response\ResponseInterface;

interface ControllerInterface
{
    public function main(): ResponseInterface;
}