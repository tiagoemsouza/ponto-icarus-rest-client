<?php

declare(strict_types=1);

namespace tiagoemsouza\PontoIcarusAPI\Exception;

use Psr\Http\Message\ResponseInterface;

class ForbiddenException extends AbstractHttpException
{
    public function __construct(ResponseInterface $response)
    {
        parent::__construct($response, 403);
    }
}
