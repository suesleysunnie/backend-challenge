<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $hidden = ['created_at', 'updated_at'];

    public function pedidos(){
        return $this->hasMany(Pedido::class, 'cliente_id', 'id');
    }
}
