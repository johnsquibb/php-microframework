<?php

namespace PhpMicroframework\Framework\Controller\Response;

class HtmlResponse implements ResponseInterface
{
    public function __construct(private string $context)
    {
    }

    public function render(): void
    {
        header('Content-type:text/html');
        echo $this->context;
        exit;
    }
}
