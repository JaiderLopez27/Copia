<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\SoftDeletes;

class Compra extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['cantidad','soporteCompra','precioCompra','valorUnidad','proveedors_id', 'productos_id'];

    //protected $guarded = [];

    public function proveedors(){
        return $this -> belongsTo(Proveedor :: class, 'proveedors_id');
    }

    public function productos(){
        return $this -> belongsTo(Producto :: class, 'productos_id');
    }

    protected static function booted()
    {
        static::created(function ($compra) {
            Log::info('Compra creada', ['compra' => $compra]);
        
            // Encuentra el producto y actualiza el stock
            $producto = Producto::find($compra->productos_id);
            if ($producto) {
                Log::info('Producto encontrado', ['producto' => $producto]);
        
                // Sumar la cantidad comprada al stock
                $producto->stock += $compra->cantidad; // Sumar la cantidad comprada al stock
                $producto->save();
                Log::info('Stock actualizado', ['producto' => $producto]);
            } else {
                Log::warning('Producto no encontrado', ['productos_id' => $compra->productos_id]);
            }
        });
    }
}
