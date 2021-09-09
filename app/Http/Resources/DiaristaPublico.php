<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DiaristaPublico extends JsonResource
{
    /**
     * Define os dados para cada diarista
     * @param Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request): array
    {
        return [
            'nome_completo' => $this->nome_completo,
            'reputacao' => $this->reputacao,
            'foto_usuario' => $this->foto_usuario,
            'cidade' => 'Feira de Santana'
        ];
    }
}
