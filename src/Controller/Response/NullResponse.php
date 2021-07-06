<?php

namespace PhpMicroframework\Controller\Response;

class NullResponse implements ResponseInterface
{
    public function render(): void
    {
        // no-op.
    }
}