<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Abono extends Model
{
    use HasFactory;

    protected $table = 'abonos';
    protected $fillable = ['monto', 'fecha', 'prestamo_id'];


    public function prestamo()
    {
        return $this->belongsTo(Prestamo::class);
    }
}
