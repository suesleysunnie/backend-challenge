<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido_Produto extends Model
{
    use HasFactory;

    protected $table = 'pedidos_produtos';
    public $timestamps = false;
    protected $fillable = ['pedido_id', 'produto_id'];
}
