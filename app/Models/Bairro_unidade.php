<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bairro_unidade extends Model
{
    use HasFactory;
    protected $table = "bairro_unidade";
    protected $fillable = [
        'id_bairro',
        'bairro',
        'id_unidade',
        'unidade'
    ];
}
