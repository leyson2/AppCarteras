<?php

namespace App\Http\Livewire\Admin;

use App\Models\admin\Cliente;
use Livewire\Component;
use Livewire\WithPagination;

class ClienteComponent extends Component
{
    public $nombre, $correo, $telefono, $direccion, $cupo, $cedula;

    public $clienteId, $accion = 'Agregar', $formTitle = 'Nuevo';
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $clientes = Cliente::paginate(5);
        return view('livewire.admin.cliente-component', compact('clientes'));
    }

    protected $rules = [
        'nombre' => 'required|max:60',
        'correo' => 'email',
        'telefono' => 'required|numeric',
        'direccion' => 'required',
        'cupo' => 'required|numeric',
        'cedula' => 'required|numeric',
    ];

    protected $messages = [
        'nombre.required' => 'El campo nombre es requerido',
        'correo.email' => 'El campo correo debe ser un correo valido',
        'telefono.required' => 'El campo telefono es requerido',
        'telefono.numeric' => 'El campo telefono debe ser numerico',
        'direccion.required' => 'El campo direccion es requerido',
        'cupo.required' => 'El campo cupo es requerido',
        'cupo.numeric' => 'El campo cupo debe ser numerico',
        'cedula.required' => 'El campo cedula es requerido',
        'cedula.numeric' => 'El campo cedula debe ser numerico',
    ];

    protected function updated($field)
    {

        $this->validateOnly($field, $this->rules, $this->messages);
    }

    public function agregarCliente()
    {
        $this->validate();

        Cliente::create([
            'nombre' => $this->nombre,
            'cedula' => $this->cedula,
            'telefono' => $this->telefono,
            'direccion' => $this->direccion,
            'email' => $this->correo,
            'cupo' => $this->cupo,

        ]);

        $this->reset();
    }

    public function editarCliente($id)
    {
        $this->accion = 'Editar';
        $this->formTitle = 'Editar';

        $cliente =  Cliente::find($id);
        $this->nombre = $cliente->nombre;
        $this->cedula = $cliente->cedula;
        $this->telefono = $cliente->telefono;
        $this->direccion = $cliente->direccion;
        $this->correo = $cliente->email;
        $this->cupo = $cliente->cupo;
        $this->clienteId = $cliente->id;
    }
    public function actualizarCliente()
    {
        $this->validate();
        $cliente = Cliente::find($this->clienteId);
        $cliente->update([
            'nombre' => $this->nombre,
            'cedula' => $this->cedula,
            'telefono' => $this->telefono,
            'direccion' => $this->direccion,
            'email' => $this->correo,
            'cupo' => $this->cupo,
        ]);
        $this->reset();
    }

    public function eliminarCliente($id)
    {
        Cliente::find($id)->delete();
    }
}
