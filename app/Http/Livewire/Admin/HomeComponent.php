<?php

namespace App\Http\Livewire\Admin;

use App\Models\admin\Cliente;
use App\Models\admin\Prestamo;
use Livewire\Component;

class HomeComponent extends Component
{
    public function render()
    {
        $clientes = Cliente::all();
        $prestamos = Prestamo::all();
        $paprobado = Prestamo::where('estado', '=', 'Aprobado')->get();
        $pnoaprobado = Prestamo::where('estado', '=', 'No Aprobado')->get();
        $ppendiente = Prestamo::where('estado', '=', 'Pendiente')->get();
        $ppagado = Prestamo::where('estado', '=', 'Pagado')->get();
        return view('livewire.admin.home-component',[
            'clientes' => $clientes,
            'prestamos' => $prestamos,
            'paprobado' => $paprobado,
            'pnoprobado' => $pnoaprobado,
            'ppendiente' => $ppendiente,
            'ppagado' => $ppagado
        ]);
    }
}
