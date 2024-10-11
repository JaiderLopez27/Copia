<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['nombre','cedula','email','telefono'];

    public function ventas(){
        return $this -> hasMany(Venta :: class, 'id');
    }
}