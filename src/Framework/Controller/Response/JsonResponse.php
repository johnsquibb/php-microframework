<?php

namespace PhpMicroframework\Framework\Controller\Response;

class JsonResponse implements ResponseInterface
{
    public function __construct(private array $context)
    {
    }

    public function render(): void
    {
        header('Content-type:application/json');
        echo json_encode($this->context);
        exit;
    }
}
