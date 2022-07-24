<?php

namespace App\Http\Livewire\Admin;

use App\Models\admin\Cliente;
use App\Models\admin\Prestamo;
use Livewire\Component;
use Livewire\WithPagination;

class PrestamoComponent extends Component
{
    public $monto_pagar, $interes, $clientes;

    public $idCliente, $accion = 'Agregar', $formTitle = 'Nuevo';
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $this->clientes = Cliente::all();
        $prestamos = Prestamo::all();
        return view('livewire.admin.prestamo-component', [
            'clientes' => $this->clientes,
            'prestamos' => $prestamos
        ]);
    }
}
