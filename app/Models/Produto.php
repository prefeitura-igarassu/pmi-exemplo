<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produto extends Model
{
    use SoftDeletes;            // softDelete é bom, porque não deleta a tupla (linha do banco de dados). Ele fica invisível para o usuário
    protected $guarded = [];    // para permitir salvar um produto usando a função create()
}
