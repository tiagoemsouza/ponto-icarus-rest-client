<?php

declare(strict_types=1);

namespace tiagoemsouza\PontoIcarusAPI\Tests\Service;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use tiagoemsouza\PontoIcarusAPI\Adapter\Adapter;
use tiagoemsouza\PontoIcarusAPI\Entity\UsuarioLogar;
use tiagoemsouza\PontoIcarusAPI\Service\UsuarioService;
use tiagoemsouza\PontoIcarusAPI\Tests\PontoIcarusAPITest;

final class UsuarioServiceTest extends PontoIcarusAPITest
{

    public MockHandler $mock;
    public UsuarioService $usuarioService;

    public function setUp(): void
    {
        parent::setUp();
        $this->mock = new MockHandler();
        $handlerStack = HandlerStack::create($this->mock);
        $this->usuarioService = new UsuarioService(new Adapter(new Client(['handler' => $handlerStack])));
    }

    public function testLogar(): void
    {
        $this->mock->append(new Response(200, [], json_encode(['token' => 'sdf', 'idUser' => 465])));

        $username = 'xxxx';
        $password = 'abcde';
        $web = true;
        $usuarioLogar = $this->usuarioService->logar($username, $password, $web);

        $this->assertInstanceOf(UsuarioLogar::class, $usuarioLogar);
    }
}
