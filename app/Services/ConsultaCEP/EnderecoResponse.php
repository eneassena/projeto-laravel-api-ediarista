<?php

namespace App\Services\ConsultaCEP;


class EnderecoResponse
{

  public function __construct(
    public string $cep,
    public string $logradouro,
    public string $bairro,
    public string $localidade,
    public string $uf,
    public string $complemento,
    public string $ibge
  ) {
  }
}
