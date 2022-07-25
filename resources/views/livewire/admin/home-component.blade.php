<div>
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center mt-3" style="padding: 5px; ">
                <h4 style="font-size:30px;  color: gray; box-shadow: 0px 0px 2px rgba(0,0,0,0.4);border-radius: 10%;">¡Bienvenido al Panel Administrador del Sistema!</h4>
            </div>
            <div class="col-md-4">
                <div class="card mt-5" style="width: 18rem;">
                    <div class="card-header bg-blue" style="display:flex; justify-content:space-between">
                        <h5 class="card-title">Clientes</h5>
                        <span class="card-text">{{$clientes->count()}}</span>
                    </div>
                    <div class="card-body">
                      <p class="card-text">Número de clientes que han solicitado un prestamo o crédito.</p>
                    </div>
                  </div>
            </div>
            <div class="col-md-4">
                <div class="card mt-5" style="width: 18rem;">
                    <div class="card-header bg-blue" style="display:flex; justify-content:space-between">
                        <h5 class="card-title">Prestamos</h5>
                        <span class="card-text">{{$prestamos->count()}}</span>
                    </div>
                    <div class="card-body">
                      <p class="card-text">Número de prestamos o créditos solicitados.</p>
                    </div>
                  </div>
            </div>
            <div class="col-md-4">
                <div class="card mt-5" style="width: 18rem;">
                    <div class="card-header bg-blue" style="display:flex; justify-content:space-between">
                        <h5 class="card-title">Prestamos |Estado</h5>
                    </div>
                    <div class="card-body">
                        <ul>
                            <li>
                                Aprobados: {{ $paprobado->count() }}
                            </li>
                            <li>
                                Rechazados: {{ $pnoprobado->count() }}
                            </li>
                            <li>
                                Pendientes: {{ $ppendiente->count() }}
                            </li>
                            <li>
                                Pagados: {{ $ppagado->count() }}
                            </li>
                        </ul>
                    </div>
                  </div>
            </div>
        </div>
    </div>
</div>
