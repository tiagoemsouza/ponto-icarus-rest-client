<?php

declare(strict_types=1);

namespace tiagoemsouza\PontoIcarusAPI\Tests\Service;

use GuzzleHttp\Client;
use Reflection;
use ReflectionClass;
use tiagoemsouza\PontoIcarusAPI\Adapter\Adapter;
use tiagoemsouza\PontoIcarusAPI\Service\AbstractService;
use tiagoemsouza\PontoIcarusAPI\Tests\PontoIcarusAPITest;

final class AbstractServiceTest extends PontoIcarusAPITest
{

    public function setUp(): void
    {
        parent::setUp();
    }

    public function testConstructor(): void
    {
        $service = $this->getMockForAbstractClass(AbstractService::class, [new Adapter()]);

        $serviceReflection = new ReflectionClass(AbstractService::class);
        $adapterReflection = $serviceReflection->getProperty('adapter');
        $adapterReflection->setAccessible(true);

        $this->assertInstanceOf( Adapter::class, $adapterReflection->getValue($service));

    }
}
