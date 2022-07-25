<?php

namespace App\Http\Livewire;

use App\Models\admin\Abono;
use App\Models\admin\Cliente;
use App\Models\admin\Prestamo;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Termwind\Components\Dd;

class InicioComponent extends Component
{
    public $monto = 0, $nombre, $correo, $telefono, $direccion, $cuotas = 24, $cedula;

    // Intereses -> cuotas >= 24 -> 0.0139 si cuotas <= 48 -> 0.0174


    public $totalIntereses; // monto * intereses
    public $montoTotal; // monto + totalIntereses
    public $totalCuotas; // montoTotal / cuotas
    public $porcentajeIntereses; // intereses * 100
    public $intereses;
    public $showPrestamo = 1;
    public $showCuotas = 1;
    public $showAbonar = 1;
    public $showCreditos = 1;

    public $prestamos = [];
    public $nombreCliente, $monto_cuota, $idPrestamo, $minMonto, $minAmount;

    public $abonos = [];
    public $totalAbonos, $montoRestante, $prestamo, $totalRestante, $mensaje = '';

    protected $listeners = [
        'enviarSolicitud' => 'guardarSolicitud',
        'mostrar' => 'showComponentCliente',
        'ocultar' => 'hiddenComponentCliente',
        'showcuotas' => 'mostrarCuotas',
        'hidecuotas' => 'ocultarCuotas',
        'saveCuota' => 'guardarCuota',
        'showCredito' => 'mostrarCredito',
        'hideCredito' => 'ocultarCredito',
    ];

    public function render()
    {

        $this->calcularDatos();
        return view('livewire.inicio-component');
    }
    public function calcularDatos()
    {
        if ($this->cuotas <= 12) {

            $this->intereses = 0.0104 * $this->cuotas;
            $this->porcentajeIntereses = 0.0104 * 100;
        } elseif ($this->cuotas >= 13 && $this->cuotas <= 24) {

            $this->intereses = 0.0129 * $this->cuotas;
            $this->porcentajeIntereses = 0.0129 * 100;
        } elseif ($this->cuotas > 24 && $this->cuotas <= 36) {

            $this->intereses = 0.0156 * $this->cuotas;
            $this->porcentajeIntereses = 0.0156 * 100;
        } else {

            $this->intereses = 0.0174 * $this->cuotas;
            $this->porcentajeIntereses = 0.0174 * 100;
        }

        $this->totalIntereses = $this->monto * $this->intereses;
        $this->montoTotal = $this->monto + $this->totalIntereses;
        // Calculo de cuotas con 2 decimales
        $this->totalCuotas = number_format($this->montoTotal / $this->cuotas, 2);
    }

    protected $rules = [
        'monto' => 'required|numeric',
        'nombre' => 'required|max:60',
        'correo' => 'email',
        'telefono' => 'required|numeric',
        'direccion' => 'required',
        'cuotas' => 'required|numeric',
        'cedula' => 'required|numeric'
    ];

    protected $messages = [
        'monto.required' => 'El campo monto es requerido',
        'monto.numeric' => 'El campo monto debe ser numerico',
        'nombre.required' => 'El campo nombre es requerido',
        'nombre.max' => 'El campo nombre debe tener maximo 60 caracteres',
        'correo.email' => 'El campo correo debe ser un correo valido',
        'telefono.required' => 'El campo telefono es requerido',
        'telefono.numeric' => 'El campo telefono debe ser numerico',
        'direccion.required' => 'El campo direccion es requerido',
        'cuotas.required' => 'El campo cuotas es requerido',
        'cuotas.numeric' => 'El campo cuotas debe ser numerico',
        'cedula.required' => 'El campo cedula es requerido',
        'cedula.numeric' => 'El campo cedula debe ser numerico',
    ];

    protected function updated($field)
    {
        $this->validateOnly($field, $this->rules, $this->messages);
    }

    public function guardarSolicitud()
    {
        $this->validate();

        // Guardar el cliente

        Cliente::create([
            'nombre' => $this->nombre,
            'cedula' => $this->cedula,
            'telefono' => $this->telefono,
            'direccion' => $this->direccion,
            'email' => $this->correo,
            'cupo' => $this->monto,
        ]);

        // Consultar el cliente para obtener el id del último cliente registrado
        $cliente = Cliente::orderBy('id', 'desc')->first();

        // Obtener la fecha actual
        $fecha = date('Y-m-d');
        // Guardar en la tabla prestamo
        Prestamo::create([
            'montoprestamo' => $this->monto,
            'interes' => $this->porcentajeIntereses,
            'nmeses' => $this->cuotas,
            'montopagar' => $this->montoTotal,
            'fecha_inicio' => $fecha,
            'proximo_pago' => $fecha,
            'cliente_id' => $cliente->id,
        ]);
        $this->reset();
        return redirect()->back();
    }

    public function showComponentCliente()
    {
        $this->showPrestamo = 0;
        $this->showCuotas = 1;
        $this->showCreditos = 1;
    }
    public function hiddenComponentCliente()
    {
        $this->showPrestamo = 1;
    }

    // ----------------------------------------------------------------------------------------------
    public function mostrarCuotas()
    {
        $this->showCuotas = 0;
        $this->showPrestamo = 1;
        $this->showAbonar = 1;
        $this->showCreditos = 1;
    }
    public function ocultarCuotas()
    {
        $this->showCuotas = 1;
    }


    public function searchCredit()
    {
        $this->prestamos = Prestamo::orWhereHas('cliente', function ($query) {
            $query->where('cedula', $this->cedula)->where('estado', '=', 'Aprobado');
        })->get();

        if ($this->prestamos->isEmpty()) {
            $this->mensaje = 'No hay creditos por pagar';
        } else {
            $this->mensaje = '';
        }
        return view('livewire.inicio-component', ['prestamos' => $this->prestamos]);
    }

    public function searchAllCredit()
    {
        $this->prestamos = Prestamo::orWhereHas('cliente', function ($query) {
            $query->where('cedula', $this->cedula);
        })->get();

        return view('livewire.inicio-component', ['prestamos' => $this->prestamos]);
    }


    public function abonarCuota($id)
    {
        $this->totalAbonos = Abono::where('prestamo_id', $id)->sum('monto');
        $this->prestamo = Prestamo::find($id);

        $this->idPrestamo = $this->prestamo->id;
        $this->nombreCliente = $this->prestamo->cliente->nombre;
        $this->minMonto = number_format(($this->prestamo->montopagar / $this->prestamo->nmeses), 2, '.', '');

        $totalPrestado = $this->prestamo->montopagar;
        $this->totalRestante = $totalPrestado - $this->totalAbonos;

        $this->showAbonar = 0;

        return redirect()->back();
    }

    public function guardarCuota()
    {
        // Consultar la suma de la columna monto de la tabla abono para el prestamo seleccionado
        $this->totalAbonos = Abono::where('prestamo_id', $this->idPrestamo)->sum('monto');
        $this->prestamo = Prestamo::find($this->idPrestamo);
        $totalPrestado = $this->prestamo->montopagar;
        $this->totalRestante = $totalPrestado - $this->totalAbonos;

        // Validar que el monto a abonar no sea mayor al total restante
        if ($this->monto_cuota > $this->totalRestante) {
            return redirect()->back();
        } else {

            Abono::create([
                'monto' => $this->monto_cuota,
                'fecha' => date('Y-m-d'),
                'prestamo_id' => $this->idPrestamo,
            ]);

            Prestamo::find($this->idPrestamo)->update(['proximo_pago' => date('Y-m-d', strtotime('+1 month', strtotime($this->prestamo->proximo_pago)))]);

            $this->totalAbonos = Abono::where('prestamo_id', $this->idPrestamo)->sum('monto');
            if ($totalPrestado == $this->totalAbonos) {
                Prestamo::find($this->idPrestamo)->update(['estado' => 'Pagado']);
            }
        }


        $this->reset();
        $this->showAbonar = 1;
        return redirect()->back();
    }


    // Mostrar las cuotas del prestamo
    public function showCuotasPrestamo($id)
    {
        $this->abonos = Abono::where('prestamo_id', $id)->get();
        // Consultar la suma de la columna monto de la tabla abono para el prestamo seleccionado
        $this->totalAbonos = Abono::where('prestamo_id', $id)->sum('monto');
        $this->prestamo = Prestamo::find($id);
        $totalPrestado = $this->prestamo->montopagar;
        $this->totalRestante = $totalPrestado - $this->totalAbonos;

        return view('livewire.inicio-component', ['abonos' => $this->abonos, $this->totalAbonos, $this->totalRestante]);
    }

    public function mostrarCredito()
    {
        $this->showCreditos = 0;
        $this->showCuotas = 1;
    }
    public function ocultarCredito()
    {
        $this->showCreditos = 1;
    }
}
