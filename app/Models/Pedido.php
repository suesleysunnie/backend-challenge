<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    /* Scopos */
    public function scopeCancelado($query){
        return $query->where('status', 'cancelado');
    }

    public function scopeEntregue($query){
        return $query->where('status', 'entregue');
    }

    public function scopeAtivos($query){
        return $query->where([
            ['status', '<>', 'cancelado'],
            ['status', '<>', 'entregue'],
        ]);
    }

    /* //Scopos */

    public function cliente(){
        return $this->belongsTo(Cliente::class, 'cliente_id', 'id');
    }

    public function produtos(){
        return $this->belongsToMany(Produto::class, 'pedidos_produtos', 'pedido_id', 'produto_id');
    }
}
