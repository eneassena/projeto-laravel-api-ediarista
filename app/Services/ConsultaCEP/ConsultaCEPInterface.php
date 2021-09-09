<?php

namespace App\Services\ConsultaCEP;


interface ConsultaCEPInterface
{

  /**
   * buscar diarista pelo cep atravéz do serviço ViaCep
   * @return false|EnderecoResponse
   */
  public function buscar(string $cep): false|EnderecoResponse;
}
