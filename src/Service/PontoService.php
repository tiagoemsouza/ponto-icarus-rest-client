<?php

declare(strict_types=1);

namespace tiagoemsouza\PontoIcarusAPI\Service;

use tiagoemsouza\PontoIcarusAPI\Entity\RelatorioArquivoReguladoPorLei;

class PontoService extends AbstractService
{

    /**
     * Search for a CNPJ
     *
     * @param string $usuario
     * @return RelatorioArquivoReguladoPorLei
     */
    public function relatorioReguladorPorlei(string $dataInicio, string $dataFim, bool $somenteAtivos = true, string $tipo = 'AFD'):RelatorioArquivoReguladoPorLei
    {
        $data = $this->adapter->post('/ponto/relatorioReguladoPorLei', compact('dataInicio', 'dataFim', 'somenteAtivos', 'tipo'));
        return new RelatorioArquivoReguladoPorLei($data);
    }
}
