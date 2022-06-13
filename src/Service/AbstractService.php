<?php

declare(strict_types=1);

namespace tiagoemsouza\PontoIcarusAPI\Service;

use tiagoemsouza\PontoIcarusAPI\Adapter\AdapterInterface;

abstract class AbstractService
{

    protected AdapterInterface $adapter;

    public function __construct(AdapterInterface $adapter)
    {
        $this->adapter = $adapter;
    }
}
