<?php
declare(strict_types=1);

namespace tiagoemsouza\PontoIcarusAPI\Adapter;

interface AdapterInterface
{
    /**
     * Sends a POST request.
     *
     * @param string $path
     * @param array<string, bool|string> $queryParams
     * @return mixed[]
     */
    public function post(string $path, array $queryParams = []): array;

    /**
     * Load the bearer token
     *
     * @param string $token
     * @return void
     */
    public function loadBearerToken(string $token): void;
}
