<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\SoftDeletes;



class Venta extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['descripcion','stock','clientes_id', 'productos_id'];

    //protected $guarded = [];

    public function clientes(){
        return $this -> belongsTo(Cliente :: class, 'clientes_id');
    }

    public function productos(){
        return $this -> belongsTo(Producto :: class, 'productos_id');
    }

    protected static function booted()
    {
        static::created(function ($venta) { 
            Log::info('Venta creada', ['venta' => $venta]);
    
            // Encuentra el producto y actualiza el stock
            $producto = Producto::find($venta->productos_id);
            if ($producto) {
                Log::info('Producto encontrado', ['producto' => $producto]);
    
                // Verifica si hay suficiente stock para la venta
                if ($producto->stock >= $venta->stock) {
                    $producto->stock -= $venta->stock; 
                    $producto->save();
                    Log::info('Stock actualizado tras la venta', ['producto' => $producto]);
                } else {
                    Log::warning('Stock insuficiente para el producto', ['producto' => $producto]);
                }
            } else {
                Log::warning('Producto no encontrado', ['productos_id' => $venta->productos_id]);
            }
        });
    }
}
