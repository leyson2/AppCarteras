<div>
    <div class="container">
     <div class="row">
        <div class="col-md-2">
            <div class="card mt-4">
                <div class="card-header bg-gray">
                    <span class="text-white">Actualizar</span>
                </div>
                <div class="card-body">
                    <div class="form-group mt-1">
                        <label for="estado">Estado</label>
                        <select class="form-control" wire:model="estadoId">
                            <option value="1">Aprobado</option>
                            <option value="2">Rechazado</option>
                            <option value="3">Pagado</option>
                        </select>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-info btn-sm" wire:click="$emit('update')">Actualizar</button>
                </div>
            
        </div> 
        </div>
         <div class="col-md-10">
             <div class="card mt-4">
                 <div class="card-header bg-secondary">
                     <h3 class="card-title">Prestamo |Listado</h3>
              
                 </div>
                 <div class="card-body">
                     <table class="table table-striped text-center">
                         <thead>
                           <tr>
                             <th scope="col">Cliente</th>
                             <th scope="col">Monto Prestado</th>
                             <th scope="col">Monto A Pagar</th>
                             <th scope="col">N° Meses</th>
                             <th scope="col">Fecha</th>
                             <th scope="col">Próximo Pago</th>
                             <th scope="col">Estado</th>
                             <th scope="col">Acciones</th>
                           </tr>
                         </thead>
                         <tbody>
                             @forelse($prestamos as $prestamo)
                                 <tr>
                                     <td>{{ $prestamo->cliente->nombre}}</td>
                                     <td>${{ $prestamo->montoprestamo }}</td>
                                     <td>${{ $prestamo->montopagar }}</td>
                                     <td>{{ $prestamo->nmeses }}</td>
                                     <td>{{ $prestamo->fecha_inicio }}</td>
                                     <td>{{ $prestamo->proximo_pago }}</td>
                                     <td>

                                        @if($prestamo->estado == 'Pendiente')
                                        <span class="badge badge-info">{{ $prestamo->estado }}</span>
                                        @elseif($prestamo->estado == 'Aprobado')
                                        <span class="badge badge-success">{{ $prestamo->estado }}</span>
                                        @elseif($prestamo->estado == 'No Aprobado')
                                        <span class="badge badge-danger">{{ $prestamo->estado }}</span>
                                        @else
                                        <span class="badge badge-warning">{{ $prestamo->estado }}</span>
                                        @endif
                                     </td>
                                     <td>
                                         <button wire:click="editarEstado({{ $prestamo->id }})" class="btn btn-secondary btn-sm">Editar</button>
                                         @if($showAbonos == 1)
                                         <button wire:click="showAbono({{ $prestamo->id }})" class="btn btn-primary btn-sm">Abonos</button>
                                         @else
                                         <button wire:click="hideAbono({{ $prestamo->id }})" class="btn btn-secondary btn-sm">Ocultar</button>
                                            @endif
                                     </td>
                                 </tr>
                                 @empty
                                 <td>
                                    <span class="badge badge-info">No hay datos agregados en la base de datos</span>
                                 </td>
                             @endforelse
                         </tbody>
                       </table>
                 </div>
                 <div class="card-footer">
                     
                 </div>
             </div>
         </div>
     </div>
@if($showAbonos == 0)
     <div class="row">
        <div class="col-md-12">
            @if (count($abonos) > 0)
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Monto</th>
                            <th scope="col">Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($abonos as $abono)
                            <tr>
                                <td>${{ $abono->monto }}
                                </td>
                                <td>{{ $abono->fecha }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot style="background-color:gray;">
                        <tr>
                            <td>Total Abonado</td>
                            <td>${{ $totalAbonos }}</td>
                        </tr>
                        <tr>
                            <td>Monto Restante</td>
                            <td>${{ $totalRestante }}</td>
                        </tr>
                    </tfoot>
                </table>
            @else
            @endif
        </div>
    </div>
@endif

    </div>
 </div>
 