<?php

declare(strict_types=1);

namespace PhpMicroframework\Framework\Controller;

use PhpMicroframework\Framework\Controller\Response\HtmlResponse;
use PhpMicroframework\Framework\Controller\Response\ResponseInterface;
use stdClass;

/**
 * Class ErrorController handles the display of 500 Internal Server Error pages.
 * @package PhpMicroframework\Framework\Controller
 */
class ErrorController extends TemplateController
{
    public function __construct(private stdClass $debugger)
    {
    }

    public function main(): ResponseInterface
    {
        header('HTTP/1.1 500 Internal Server Error');

        $html = $this->render(
            'core/error.html.twig',
            [
                'displayErrors' => $this->debugger->displayErrors,
                'message' => $this->debugger->message ?? '',
                'fileName' => $this->debugger->file_name ?? '',
                'lineNumber' => $this->debugger->line_number ?? '',
                'errorType' => $this->debugger->error_type ?? '',
                'backtrace' => print_r($this->debugger->backtrace, true),
            ]
        );

        return new HtmlResponse($html);
    }
}
