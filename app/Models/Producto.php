<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Producto extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['nombre','descripcion','stock','precioCompra','precioVenta','estado'];

    public function ventas(){
        return $this -> hasMany(Venta :: class, 'id');
    }

    public function compras(){
        return $this -> hasMany(Compra :: class, 'id');
    }
}
