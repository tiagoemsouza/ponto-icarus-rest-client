<?php

declare(strict_types=1);

namespace tiagoemsouza\PontoIcarusAPI\Tests\Adapter;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\MockObject\MockObject;
use ReflectionClass;
use tiagoemsouza\PontoIcarusAPI\Adapter\AbstractAdapter;
use tiagoemsouza\PontoIcarusAPI\Exception\AccessDeniedException;
use tiagoemsouza\PontoIcarusAPI\Exception\ForbiddenException;
use tiagoemsouza\PontoIcarusAPI\Exception\InternalServerErrorException;
use tiagoemsouza\PontoIcarusAPI\Exception\NotFoundException;
use tiagoemsouza\PontoIcarusAPI\Exception\UnauthorizedException;
use tiagoemsouza\PontoIcarusAPI\Tests\PontoIcarusAPITest;

final class AbstractAdapterTest extends PontoIcarusAPITest
{

    private MockObject $adapter;
    private ReflectionClass $adapterReflection;

    public function setUp(): void
    {
        parent::setUp();
        
        $this->adapter = $this->getMockForAbstractClass(AbstractAdapter::class);
        $this->adapterReflection =  new ReflectionClass(AbstractAdapter::class);
    }

    public function testConstructor(): void
    {
        $clientProperty = $this->adapterReflection->getProperty('client');
        $clientProperty->setAccessible(true);

        /**
         * @var Client
         */
        $client = $clientProperty->getValue($this->adapter);
        $this->assertInstanceOf(Client::class, $client);

        $clientReflection = new ReflectionClass($client);
        $clientConfigReflection = $clientReflection->getProperty('config');
        $clientConfigReflection->setAccessible(true);
        $clientConfig = $clientConfigReflection->getValue($client);
        $this->assertEquals('backendicarus.pontoicarus.com.br', $clientConfig['base_uri']->getHost());
    }

    public function testRequestBearerToken(){
        $token = 'x54sd6f1sa6df51x';
        
        $container = [];
        $history = Middleware::history($container);

        $mock = new MockHandler();
        $handlerStack = HandlerStack::create($mock);
        $handlerStack->push($history);
        $adapterMock = $this->getMockForAbstractClass(AbstractAdapter::class, [new Client(['handler' => $handlerStack,])]);

        $mock->append(new Response(200, []));
        $adapterMock->loadBearerToken($token);

        $requestReflection = $this->adapterReflection->getMethod('request');
        $requestReflection->setAccessible(true);
        $requestReflection->invoke($adapterMock, 'POST', '/', []);

        foreach ($container as $transaction) {
            $requestReflection = new ReflectionClass(Request::class);
            
            $headersReflection = $requestReflection->getProperty('headers');
            $headersReflection->setAccessible(true);

            $headers = $headersReflection->getValue($transaction['request']);
            $this->assertEquals('Bearer ' . $token, $headers['Authorization'][0]);
        }

    }

    public function testLoadBearerToken(){

        $token = 'x54sd6f1sa6df51x';
        $method = $this->adapterReflection->getMethod('loadBearerToken');
        $method->invoke($this->adapter, $token);

        $property = $this->adapterReflection->getProperty('bearerToken');
        $property->setAccessible(true);
        
        $this->assertEquals($token, $property->getValue($this->adapter));

    }

    public function testHandleErrorsAccessDenied()
    {
        $handleErrorsMethod = $this->adapterReflection->getMethod('handleErrors');
        $handleErrorsMethod->setAccessible(true);

        $this->expectException(AccessDeniedException::class);
        $handleErrorsMethod->invoke($this->adapter, new Response(400));
    }

    public function testHandleUnauthorized()
    {

        $handleErrorsMethod = $this->adapterReflection->getMethod('handleErrors');
        $handleErrorsMethod->setAccessible(true);

        $this->expectException(UnauthorizedException::class);
        $handleErrorsMethod->invoke($this->adapter, new Response(401));
    }

    public function testHandleErrorsForbidden()
    {
        $handleErrorsMethod = $this->adapterReflection->getMethod('handleErrors');
        $handleErrorsMethod->setAccessible(true);

        $this->expectException(ForbiddenException::class);
        $handleErrorsMethod->invoke($this->adapter, new Response(403));
    }

    public function testHandleNotFound()
    {
        $handleErrorsMethod = $this->adapterReflection->getMethod('handleErrors');
        $handleErrorsMethod->setAccessible(true);

        $this->expectException(NotFoundException::class);
        $handleErrorsMethod->invoke($this->adapter, new Response(404));
    }

    public function testHandleInternalServerError()
    {
        $handleErrorsMethod = $this->adapterReflection->getMethod('handleErrors');
        $handleErrorsMethod->setAccessible(true);

        $this->expectException(InternalServerErrorException::class);
        $handleErrorsMethod->invoke($this->adapter, new Response(500));
    }
}
