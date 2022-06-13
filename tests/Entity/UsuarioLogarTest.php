<?php
declare(strict_types=1);

namespace tiagoemsouza\PontoIcarusAPI\Tests\Entity;

use tiagoemsouza\PontoIcarusAPI\Entity\UsuarioLogar;
use tiagoemsouza\PontoIcarusAPI\Tests\PontoIcarusAPITest;

class UsuarioLogarTest extends PontoIcarusAPITest {

    public function setUp(): void{
        parent::setUp();
    }

    public function testProperties(): void{
        $data = $this->loadFixtures('Entity/UsuarioLogar');
        $usuarioLogar = new UsuarioLogar($data);
        $this->assertEquals($usuarioLogar->token, $data['token']);
        $this->assertEquals($usuarioLogar->idUser, $data['idUser']);
    }

}