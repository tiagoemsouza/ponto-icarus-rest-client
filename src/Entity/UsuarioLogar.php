<?php

declare(strict_types=1);

namespace tiagoemsouza\PontoIcarusAPI\Entity;

use Spatie\DataTransferObject\FlexibleDataTransferObject;

class UsuarioLogar extends FlexibleDataTransferObject
{
    public ?string $token;
    public ?int $idUser;
}
