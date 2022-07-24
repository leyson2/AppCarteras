<div>
    <div class="container">
     <div class="row">
         <div class="col-md-4">
             <div class="card mt-4">
                 <div class="card-header bg-secondary">
                     <h3 class="card-title">Prestamo |{{$formTitle}}</h3>
                 </div>
                 <div class="card-body">
                     <div class="row">
                         <div class="col-md-6">
                             <div class="form-group mt-1">
                                 <label for="monto" class="text-muted">Monto a pagar</label>
                                 <input type="number" class="form-control" wire:model="monto_pagar">
                                 @error('monto')
                                     <span class="text-danger">{{ $message }}</span>
                                 @enderror
                               </div>
                               <div class="form-group">
                                 <label for="interes" class="text-muted">Interes</label>
                                 <input type="number" class="form-control" wire:model="interes">
                                 @error('interes')
                                     <span class="text-danger">{{ $message }}</span>
                                 @enderror
                               </div>
                               <div class="form-group mt-1">
                                 <label for="email" class="text-muted">Cliente</label>
                                 <select wire:model="idCliente" class="form-control">
                                        @foreach($clientes as $cliente)
                                            <option value="{{$cliente->id}}">{{$cliente->nombre}}</option>
                                        @endforeach
                                 </select>
                                 @error('correo')
                                     <span class="text-danger">{{ $message }}</span>
                                 @enderror
                               </div>
                         </div>
                     </div>
                     <div class="form-group mt-4">
                        @if($accion == 'Editar')
                             <button wire:click="actualizarprestamo" class="btn btn-primary">Actualizar</button>
                        @else
                         <button wire:click="agregarprestamo" class="btn btn-success">Guardar</button>
                         @endif
                     </div>
               
                 </div>
                 <div class="card-footer">
 
                 </div>
             </div>
         </div>
         <div class="col-md-8">
             <div class="card mt-4">
                 <div class="card-header bg-secondary">
                     <h3 class="card-title">prestamo |Listado</h3>
                 </div>
                 <div class="card-body">
                     <table class="table table-striped">
                         <thead>
                           <tr>
                             <th scope="col">Cliente</th>
                             <th scope="col">Monto Prestado</th>
                             <th scope="col">N° Meses</th>
                             <th scope="col">Fecha Inicio</th>
                             <th scope="col">Acciones</th>
                           </tr>
                         </thead>
                         <tbody>
                             @foreach ($prestamos as $prestamo)
                                 <tr>
                                     <td>{{ $prestamo->cliente_id }}</td>
                                     <td>{{ $prestamo->montoprestamo }}</td>
                                     <td>{{ $prestamo->nmeses }}</td>
                                     <td>${{ $prestamo->fecha_inicio }}</td>
                                     <td>
                                         <button wire:click="editarprestamo({{ $prestamo->id }})" class="btn btn-warning btn-sm">Editar</button>
                                         <button wire:click="eliminarprestamo({{ $prestamo->id }})" class="btn btn-danger btn-sm">Eliminar</button>
                                     </td>
                                 </tr>
                             @endforeach
                         </tbody>
                       </table>
                 </div>
                 <div class="card-footer">
                     
                 </div>
             </div>
         </div>
     </div>
    </div>
 </div>
 