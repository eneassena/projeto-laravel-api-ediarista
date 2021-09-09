<?php

namespace App\Services\ConsultaCEP\Providers;

use Illuminate\Support\Facades\Http;
use App\Services\ConsultaCEP\EnderecoResponse;
use App\Services\ConsultaCEP\ConsultaCEPInterface;


class ViaCep implements ConsultaCEPInterface
{
  /**
   * Buscar o endereço utilizando a api do viacep
   * @param string $cep
   * @return false|EnderecoResponse
   */
  public function buscar(string $cep): false|EnderecoResponse
  {
    $responsta = Http::get("https://viacep.com.br/ws/$cep/json/");

    if ($responsta->failed()) {
      return false;
    }

    // transforma o cep no código do IBGE
    $dados = $responsta->json();

    if (isset($dados['erro']) && $dados['erro'] === true) {
      return false;
    }

    return $this->popula_endereco_response($dados);
  }

  /**
   * Formata a saida para endereço response
   * @return EnderecoResponse
   */
  private function popula_endereco_response(array $dados): EnderecoResponse
  {
    return new EnderecoResponse(
      cep: $dados['cep'],
      logradouro: $dados['logradouro'],
      complemento: $dados['complemento'],
      bairro: $dados['bairro'],
      localidade: $dados['localidade'],
      uf: $dados['uf'],
      ibge: $dados['ibge']
    );
  }
}
