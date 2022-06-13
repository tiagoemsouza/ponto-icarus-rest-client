<?php

declare(strict_types=1);

namespace tiagoemsouza\PontoIcarusAPI\Tests\Entity;

use tiagoemsouza\PontoIcarusAPI\Entity\RegistroMarcacao;
use tiagoemsouza\PontoIcarusAPI\Entity\RelatorioArquivoReguladoPorLei;
use tiagoemsouza\PontoIcarusAPI\Entity\UsuarioLogar;
use tiagoemsouza\PontoIcarusAPI\Tests\PontoIcarusAPITest;

class RelatorioArquivoReguladoPorLeiTest extends PontoIcarusAPITest
{

    public function setUp(): void
    {
        parent::setUp();
    }

    public function testProperties(): void
    {
        $data = $this->loadFixtures('Entity/RelatorioArquivoReguladoPorLei');
        $relatorioReguladoPorLei = new RelatorioArquivoReguladoPorLei($data);

        $this->assertEquals($relatorioReguladoPorLei->data, base64_decode($data['data']));
        $registrosMarcacoes = $relatorioReguladoPorLei->getRegistrosMarcacoes();
        $this->assertIsArray($registrosMarcacoes);
        $this->assertInstanceOf(RegistroMarcacao::class, $registrosMarcacoes[0]);
    }
}
