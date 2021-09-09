<?php

namespace App\Http\Controllers\Diarista;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\DiaristasPublioCollection;
use App\Services\ConsultaCEP\ConsultaCEPInterface;

class ObtemDiaristasPorCep extends Controller
{
    /**
     * Busca diarista por CEP
     * @param Request $request
     * @param ConsultaCEPInterface $viaCepService
     * @return  JsonResponse|DiaristasPublioCollection
     */
    public function __invoke(
        Request $request,
        ConsultaCEPInterface $viaCepService
    ): JsonResponse|DiaristasPublioCollection {

        $dados = $viaCepService->buscar($request->query('cep') ?? '');

        if ($dados == false) {
            return response()->json(['erro' => 'CEP invalido'], 400);
        }

        return new DiaristasPublioCollection(
            User::diaristas_disponivel_cidade($dados->ibge),
            User::diaristas_disponivel_cidade_total($dados->ibge)
        );
    }
}
