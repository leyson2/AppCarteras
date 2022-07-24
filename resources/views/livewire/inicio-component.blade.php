<div>
    <head>
         @livewireStyles
         <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">¡PRESTA YÁ!</a>
        <div class="collapse navbar-collapse justify-content-end m-3">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="#">Inicio</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ url('/panel') }}">Administrador</a>
            </li>
            <li class="nav-item">
                @if($showPrestamo == 1)
              <button class="nav-link nav-btn" wire:click="$emit('mostrar')">Pedir mi crédito</button>
                @else
                <button class="nav-link nav-btn" wire:click="$emit('ocultar')">Pedir mi crédito</button>
                @endif
            </li>
          </ul>
        </div>
      </nav>
        <div class="hero-header">
            <div class="row">
            <div class="col-md-6 hero-content" id="hero">
                    <h1 class="card-title">¡Bienvenido!</h1>
                    <p class="card-text">
                    ¡Bienvenido a nuestra plataforma de créditos!
                    </p>
                    <p class="card-text">
                    Aquí podrás solicitar un crédito y obtener  
                    </p>
                    <p class="card-text">
                        una gran cantidad de dinero.
                        </p>
                    <p class="card-text text-two">
                        Créditos hasta de $1.200.000. <br>
                        Aprobados en 15 minutos. <br>
                        Entregados en 1 día hábil.
                    </p>
                    <div class="form-group">
                        <button class="btn btn-primary">Consultar crédito</button>
                        @if($showCuotas == 1)
                        <button class="btn btn-primary" wire:click="$emit('showcuotas')">Pagar cuota</button>
                        @else
                        <button class="btn btn-primary" wire:click="$emit('hidecuotas')">Pagar cuota</button>
                        @endif
                    </div>
                </div>
                <div class="col-md-6 formularios">
                    @if($showPrestamo == 0)
    <div class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card" style="border:0px; border-radius:2px; box-shadow: 0px 0px 5px rgba(0,0,0.2); padding:10px">
                            <div class="card-header" style="background-color:white;">
                                <h5 class="card-title">Solicitud |Prestamo</h5>
                            </div>
                            <div class="card-body">
                                    <div class="container"> 
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group mt-1">
                                                    <label for="nombre" class="text-muted">Nombre {{$nombre}}</label>
                                                    <input type="text" class="form-control" wire:model="nombre">
                                                  </div>
                                                  <div class="form-group">
                                                    <label for="cedula" class="text-muted">Cédula</label>
                                                    <input type="text" class="form-control" wire:model="cedula">
                                                  </div>
                                                  <div class="form-group mt-1">
                                                    <label class="text-muted" for="correo">Correo</label>
                                                    <input type="email" class="form-control" wire:model="correo">
                                                  </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group mt-1">
                                                    <label for="telefono" class="text-muted">Teléfono</label>
                                                    <input type="tel" class="form-control" wire:model="telefono">
                                                  </div>
                                                  <div class="form-group mt-1">
                                                    <label for="monto" class="text-muted">Monto</label>
                                                    <input type="number" class="form-control" wire:model="monto">
                                                  </div>
                                                  <div class="form-group mt-1">
                                                    <label class="text-muted" for="direccion">Dirección</label>
                                                    <input type="text" class="form-control" wire:model="direccion">
                                                  </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                  <div class="form-group mt-2">
                                                    <label class="text-muted" for="cuotas">¿A cuántas cuotas?</label>
                                                    <input type="number" class="form-control" wire:model="cuotas">
                                                    <span class="text-muted">Elije un plazo desde 24 y hasta 48 meses</span>  
                                                  </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group mt-2">
                                                    <label class="text-muted">Pagarías {{$cuotas}} cuotas mensuales por un valor aproximado: </label>
                                                    <span  class="text-muted">${{ $totalCuotas }}</span>
                                                  </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group mt-2">
                                                    <label for="tasa" class="text-muted">Tasa</label>
                                                    <span  class="text-muted">{{ $porcentajeIntereses }}%</span>
                                                  </div>
                                            </div>
                                        </div>
                                        <div class="form-group mt-4">
                                            <button wire:click="$emit('enviarSolicitud')" class="btn btn-success">Solicitar crédito</button>
                                        </div>
                                    </div>
                            </div>
                          </div>
                    </div>
                  
             
                </div>
            </div>
        </div>
    </div>
@endif
@if($showCuotas == 0)
<div class="antialiased" id="cuotasForm">
    <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="card" style="border:0px; border-radius:2px; padding:5px; box-shadow: 0px 0px 5px rgba(0,0,0.2)">
                        <div class="card-header" style="background-color:white;">
                            <h5 class="card-title">Cuota |Abonar</h5>
                           <div class="row">
                            <div class="col-md-12" style="display:inline-block">
                                <input type="text" class="form-control" wire:model="cedula" placeholder="Ingrese su número de cédula, para buscar su crédito...">
                                <button class="btn btn-secondary mt-2" wire:click="searchCredit">Buscar crédito</button>
                            </div>
                           </div>
                        </div>
                    
                        <div class="card-body">
                                <div class="container"> 
                                    <div class="row">
                                        <div class="col-md-12">
                                            @if(count($prestamos) > 0)
                                            <table class="table table-striped">
                                                <thead>
                                                  <tr>
                                                    <th scope="col">Cliente</th>
                                                    <th scope="col">Monto</th>
                                                    <th scope="col">Acciones</th>
                                                  </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($prestamos as $prestamo)
                                                        <tr>
                                                            <td>{{ $prestamo->cliente->nombre ?? '' }}</td>
                                                            <td>${{ $prestamo->montoprestamo }}</td>
                                                            <td>
                                                                <button wire:click.prevent="abonarCuota({{ $prestamo->id }})" class="btn btn-warning btn-sm">Abonar</button>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                              </table>
                                            @else
                                               
                                            @endif
                                        </div>
                                    </div>
                                    @if ($showAbonar == 0)
                                    <div class="row">
                                        <div class="col-md-6">
                                              <div class="form-group mt-2">
                                                <label class="text-muted" for="monto">Monto</label>
                                                <input type="number" class="form-control" wire:model="monto_cuota">
                                              </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mt-2">
                                                <label class="text-muted">Cliente</label><br>
                                                <input type="text" class="form-control" disabled wire:model="nombreCliente">
                                              </div>
                                        </div>
                                    </div>
                                    <div class="form-group mt-4">
                                        <button wire:click="$emit('saveCuota')" class="btn btn-success">Confirmar pago</button>
                                    </div>
                                    @endif

                                </div>
                        </div>
                       
                      </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
@endif
                </div>
            </div>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
        @livewireScripts
    

</div>


<style type="text/css">
    .navbar-brand{
        font-size: 2rem !important;
        font-weight: bold;
        margin-left: 20px;
 }
 .navbar-nav li{
        margin: 3px;
 }
    .nav-btn{
        border:none !important;
        border-radius: 2px;
        background-color: blue;
        color: white !important;
        font-size: 14px;
        box-shadow: 1px 1px 5px rgba(0,0,0, 0.2);
        text-transform: uppercase;
    }
    #hero{
        padding: 7% 0px 0px 5%;
    }
    .hero-header{
        padding: 10px;
        width: 100%;
        height: 100%;
        background-image: url("https://images.pexels.com/photos/6994168/pexels-photo-6994168.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1");
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }
    .hero-content{
        padding: 45px;
        width: 100%;
        color: rgb(0, 64, 107);
    }
    .hero-content .card-title{
        font-size: 65px !important;
        margin-bottom: 5px;
        text-transform: uppercase;
    }
    .hero-content .card-text{
        font-size: 35px;
        margin-bottom: 5px;
    }
    .hero-content  button{
        border: none !important;
        background-color: blue;
        color: white !important;
        font-size: 12px;
        box-shadow: 0px 0px 5px rgba(0,0,0, 0.5);
        text-transform: uppercase;
        font-weight: bold;
        margin-top: 14px;
        padding: 10px;
    }
    .formularios{
        position: relative;
        top: 100px !important;
    }

</style>
