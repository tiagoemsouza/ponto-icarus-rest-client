<?php

declare(strict_types=1);

namespace tiagoemsouza\PontoIcarusAPI\Service;

use tiagoemsouza\PontoIcarusAPI\Entity\UsuarioLogar;

class UsuarioService extends AbstractService
{
    
    /**
     * Undocumented function
     *
     * @param string $username
     * @param string $password
     * @param boolean $web
     * @return UsuarioLogar
     */
    public function logar(string $username, string $password, bool $web = true): UsuarioLogar
    {
        $data = $this->adapter->post('/usuario/logar', compact('username', 'password', 'web'));
        $usuarioLogar = new UsuarioLogar($data);
        return $usuarioLogar;
    }
}
