<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Cidade extends Model
{
    use HasFactory;

    /**
     * Define a relacao com os diaristas
     * @return BelongsToMany
     */
    public function diaristas(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'cidade_diarista');
    }
}
