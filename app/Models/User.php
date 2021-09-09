<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Define a relacao com as cidades atendidas pelo(a) diarista(s)
     * @return BelongsToMany
     */
    public function cidadeAtendidas(): BelongsToMany
    {
        return $this->belongsToMany(Cidade::class, 'cidade_diarista');
    }

    /**
     * Escopo que filtra diaristas
     * @param Builder $query
     * @return Builder
     */
    public function scopeDiarista(Builder $query): Builder
    {
        return $query->where('tipo_usuario', '=', 2);
    }

    /**
     *  escopo que filtra as diaristas
     * @param Builder $query
     * @return Builder
     */
    public function scopeDiaristasAtendeCidade(
        Builder $query,
        int $codigo_ibge
    ): Builder {
        return $query->diarista()
            ->whereHas(
                'cidadeAtendidas',
                function ($q) use ($codigo_ibge) {
                    $q->where('codigo_ibge', '=', $codigo_ibge);
                }
            );
    }

    /**
     * buscar 6 diaristas por codigo ibge
     * @param int $codigo_ibge
     * @return Collection
     */
    public static function diaristas_disponivel_cidade(
        int $codigo_ibge,
        int $limit = 6
    ): Collection {
        return User::diaristasAtendeCidade($codigo_ibge)
            ->limit($limit)
            ->get();
    }

    /**
     * retorna a quantidade de diaristas por ibge
     * @param int $codigo_ibge
     * @return int
     */
    public static function diaristas_disponivel_cidade_total(
        int $codigo_ibge
    ): int {
        return User::diaristasAtendeCidade($codigo_ibge)
            ->count();
    }
}
