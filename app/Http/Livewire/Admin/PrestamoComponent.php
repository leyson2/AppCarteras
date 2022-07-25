<?php

namespace App\Http\Livewire\Admin;

use App\Models\admin\Abono;
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
    public $prestar = 1;
    public $checked = [];
    public $prestamos = [], $abonos = [];
    public $prestamo, $showAbonos = 1;

    public $estadoId, $idPrestamo;

    protected $listeners = ['update' => 'updateEstado'];

    public function render()
    {
        $this->clientes = Cliente::all();
        $this->prestamos = Prestamo::all();
        return view('livewire.admin.prestamo-component', [
            'clientes' => $this->clientes,
            'prestamos' => $this->prestamos
        ]);
    }


    public function setPrestamo($id)
    {
        $this->prestar = 0;
        $this->prestamo = Prestamo::find($id);
        $this->prestamo->update(['estado' => 'Aprobado']);
    }
    public function cancelarPrestamo($id)
    {
        $this->prestar = 1;
        $this->prestamo = Prestamo::find($id);
        $this->prestamo->update(['estado' => 'Pendiente']);
    }


    public function showAbono($id)
    {
        $this->showAbonos = 0;
        $this->abonos = Abono::where('prestamo_id', $id)->get();
        // Consultar la suma de la columna monto de la tabla abono para el prestamo seleccionado
        $this->totalAbonos = Abono::where('prestamo_id', $id)->sum('monto');
        $this->prestamo = Prestamo::find($id);
        $totalPrestado = $this->prestamo->montopagar;
        $this->totalRestante = $totalPrestado - $this->totalAbonos;
        return view('livewire.inicio-component', ['abonos' => $this->abonos, $this->totalAbonos, $this->totalRestante]);
    }

    public function editarEstado($id)
    {
        $this->prestamo = Prestamo::find($id);
        $this->idPrestamo = $this->prestamo->id;
    }
    public function updateEstado()
    {
        $this->prestamo = Prestamo::find($this->idPrestamo);
        if ($this->estadoId == 1) {
            $this->prestamo->update(['estado' => 'Aprobado']);
        } elseif ($this->estadoId == 2) {
            $this->prestamo->update(['estado' => 'No Aprobado']);
        } else {
            $this->prestamo->update(['estado' => 'Pagado']);
        }
        return redirect()->back();
    }
    public function hideAbono()
    {
        $this->showAbonos = 1;
    }
}