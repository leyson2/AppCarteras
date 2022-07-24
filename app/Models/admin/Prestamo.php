<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model
{
    use HasFactory;

    protected $table = 'prestamos';
    protected $fillable = ['cliente_id', 'montoprestamo', 'interes', 'nmeses', 'montopagar', 'fecha_inicio', 'fecha_fin', 'proximo_pago', 'estado'];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function abonos()
    {
        return $this->hasMany(Abono::class);
    }

}
