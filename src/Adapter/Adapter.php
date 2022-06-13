<?php

declare(strict_types=1);

namespace tiagoemsouza\PontoIcarusAPI\Adapter;

class Adapter extends AbstractAdapter
{   
    /**
     * @inheritDoc
     *
     * @param string $path
     * @param array $queryParams
     * @return array
     */
    public function post(string $path, array $queryParams = []): array
    {
        return $this->request('POST', $path, $queryParams);
    }
}
