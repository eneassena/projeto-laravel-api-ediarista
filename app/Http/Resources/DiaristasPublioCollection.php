<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class DiaristasPublioCollection extends ResourceCollection
{
    /**
     * esta propriedade remove a propriedade data no retorno do metodo toArray()
     */
    public static $wrap = 'diaristas';

    /**
     * @attrs int $quantidade_diaristas
     */
    private int $quantidade_diaristas;

    /**
     * metodo responsavel por receber a quantidade de diarista e gera o novo atributo.
     * @param $resource
     * @param int $quantidade_diaristas
     */
    public function __construct($resource, int $quantidade_diaristas)
    {
        parent::__construct($resource);

        $this->quantidade_diaristas = $quantidade_diaristas - 6;
    }

    /**
     * quantidade diarista define a totalidade de diaristas em uma localidade
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'diaristas' => DiaristaPublico::collection($this->collection),
            'quantidade_diaristas' => ($this->quantidade_diaristas > 0) ?
                $this->quantidade_diaristas : 0
        ];
    }
}
