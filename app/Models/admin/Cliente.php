<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'clientes';
    protected $fillable = ['nombre', 'cedula', 'telefono', 'direccion', 'email', 'cupo'];


    public function prestamos()
    {
        return $this->hasMany(Prestamo::class);
    }
}
