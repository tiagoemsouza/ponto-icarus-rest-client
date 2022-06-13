<?php

declare(strict_types=1);

namespace tiagoemsouza\PontoIcarusAPI\Tests\Entity;

use DateTime;
use tiagoemsouza\PontoIcarusAPI\Entity\RegistroMarcacao;
use tiagoemsouza\PontoIcarusAPI\Entity\RelatorioArquivoReguladoPorLei;
use tiagoemsouza\PontoIcarusAPI\Tests\PontoIcarusAPITest;

class RegistroMarcacaoTest extends PontoIcarusAPITest
{

    public function setUp(): void
    {
        parent::setUp();
    }

    public function testProperties(): void
    {
        $data = [
            'nsr' => "003147826",
            'marcacao' => new DateTime("2022-05-26T14:50:00.000Z"),
            'pis' => "073887745615",
        ];
        $registroMarcacao = new RegistroMarcacao($data);
        $this->assertEquals($registroMarcacao->nsr, $data['nsr']);
        $this->assertEquals($registroMarcacao->marcacao, $data['marcacao']);
        $this->assertEquals($registroMarcacao->pis, $data['pis']);
    }
}
