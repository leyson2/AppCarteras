<div>
   <div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card mt-4">
                <div class="card-header bg-secondary">
                    <h3 class="card-title">Cliente |{{$formTitle}}</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mt-1">
                                <label for="name" class="text-muted">Nombre</label>
                                <input type="text" class="form-control" wire:model="nombre">
                                @error('nombre')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                              </div>
                              <div class="form-group">
                                <label for="cedula" class="text-muted">Cédula</label>
                                <input type="text" class="form-control" wire:model="cedula">
                                @error('cedula')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                              </div>
                              <div class="form-group mt-1">
                                <label for="email" class="text-muted">Correo</label>
                                <input type="email" class="form-control" wire:model="correo">
                                @error('correo')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                              </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mt-1">
                                <label for="phone" class="text-muted">Teléfono</label>
                                <input type="text" class="form-control" wire:model="telefono">
                                @error('telefono')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                              </div>
                              <div class="form-group mt-1">
                                <label for="cupo" class="text-muted">Monto solicitado</label>
                                <input type="number" class="form-control" wire:model="cupo">
                                @error('cupo')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                              </div>
                              <div class="form-group mt-1">
                                <label for="direccion" class="text-muted">Dirección</label>
                                <input type="text" class="form-control" wire:model="direccion">
                                @error('direccion')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                              </div>
                        </div>
                    </div>
                    <div class="form-group mt-4">
                       @if($accion == 'Editar')
                            <button wire:click="actualizarCliente" class="btn btn-primary">Actualizar</button>
                       @else
                        <button wire:click="agregarCliente" class="btn btn-success">Guardar</button>
                        @endif
                    </div>
              
                </div>
                <div class="card-footer">

                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mt-4">
                <div class="card-header bg-secondary">
                    <h3 class="card-title">Cliente |Listado</h3>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                          <tr>
                            <th scope="col">Nombre</th>
                            <th scope="col">Teléfono</th>
                            <th scope="col">Cédula</th>
                            <th scope="col">Monto</th>
                            <th scope="col">Acciones</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($clientes as $cliente)
                                <tr>
                                    <td>{{ $cliente->nombre }}</td>
                                    <td>{{ $cliente->telefono }}</td>
                                    <td>{{ $cliente->cedula }}</td>
                                    <td>${{ $cliente->cupo }}</td>
                                    <td>
                                        <button wire:click="editarCliente({{ $cliente->id }})" class="btn btn-warning btn-sm">Editar</button>
                                        <button wire:click="eliminarCliente({{ $cliente->id }})" class="btn btn-danger btn-sm">Eliminar</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                      </table>
                </div>
                <div class="card-footer">
                    {{ $clientes->links() }}
                </div>
            </div>
        </div>
    </div>
   </div>
</div>
