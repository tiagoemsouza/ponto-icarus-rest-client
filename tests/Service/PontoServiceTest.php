<?php

declare(strict_types=1);

namespace tiagoemsouza\PontoIcarusAPI\Tests\Service;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use tiagoemsouza\PontoIcarusAPI\Adapter\Adapter;
use tiagoemsouza\PontoIcarusAPI\Entity\RegistroMarcacao;
use tiagoemsouza\PontoIcarusAPI\Entity\RelatorioArquivoReguladoPorLei;
use tiagoemsouza\PontoIcarusAPI\Exception\ForbiddenException;
use tiagoemsouza\PontoIcarusAPI\Service\PontoService;
use tiagoemsouza\PontoIcarusAPI\Service\UsuarioService;
use tiagoemsouza\PontoIcarusAPI\Tests\PontoIcarusAPITest;

final class PontoServiceTest extends PontoIcarusAPITest
{

    public MockHandler $mock;
    public PontoService $pontoService;

    public function setUp(): void
    {
        parent::setUp();
        $this->mock = new MockHandler();
        $handlerStack = HandlerStack::create($this->mock);
        $this->pontoService = new PontoService(new Adapter(new Client(['handler' => $handlerStack])));
    }

    public function test(): void
    {
        $body = 'data:text/plain;base64,MDAwMDAwMDAwMTEwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMCAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIDBCUjUxMjAyMDAwMTIwMi03MjYwNTIwMjIyNjA1MjAyMjA5MDYyMDIyMTQ1MAowMDMxNDc4MjYzMjYwNTIwMjIxNDUwMDczODg3NzQ1NjE1CjAwMzE1MTMxOTMyNjA1MjAyMjE3NTYwNzM4ODc3NDU2MTUKOTk5OTk5OTk5MDAwMDAwMDAwMDAwMDAwMDAyMDAwMDAwMDAwMDAwMDAwMDAwOQo=';
        $this->mock->append(new Response(200, [], $body));

        $dataFim = "2022-05-26T23:59:59.999Z";
        $dataInicio = "2022-05-26T07:00:00.000Z";
        $somenteAtivos = false;
        $tipo = "AFD";
        $relatorioArquivoReguladoPorLei = $this->pontoService->relatorioReguladorPorlei($dataInicio, $dataFim, $somenteAtivos, $tipo);
        $this->assertInstanceOf(RelatorioArquivoReguladoPorLei::class, $relatorioArquivoReguladoPorLei);
    }
}
