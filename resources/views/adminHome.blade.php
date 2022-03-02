@extends('layouts.app')
@section('content')
<div class="fila">
    <div class="columna columna-1">
        <div class="title2">
            <h6>{{ __('Menú principal') }}</h6>
        </div>
    </div>
</div>
<div class="fila">
    <div class="columna columna-1">
    <h6 class="title3">{{ __('Seleccione una opción') }}</h6>
    </div>
</div>
<div class="fila">
    <div class="columna columna-5">
        <div class="scene">
            <div class="card">
                <a href="{{ route('users.index') }}">
                    <div class="card__face card__face--front">
                        <div class="content">
                            <i class='fa fa-users fa-4x fa-icon'></i>
                            <h6>{{ __('Usuarios') }}</h6>
                            <p>{{ __('Visualiza y actualiza la lista de usuarios.') }}</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="columna columna-5">
        <div class="scene">
            <div class="card">
                <a href="{{ route('manifests.report') }}">
                    <div class="card__face card__face--front">
                        <div class="content">
                            <i class='fa fa-ship fa-4x fa-icon'></i>                            
                            <h6>{{ __('Reportes') }}</h6>
                            <p>{{ __('Accede al generador clásico de reportes.') }}</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="columna columna-5">
        <div class="scene">
            <div class="card">
                <a href="{{ route('manifests.charts') }}">
                    <div class="card__face card__face--front">
                        <div class="content">
                            <i class='fa fa-pie-chart fa-4x fa-icon'></i>                            
                            <h6>{{ __('Gráficos') }}</h6>
                            <p>{{ __('Accede al generador gráfico de reportes.') }}</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="columna columna-5">
        <div class="scene">    
            <div class="card">
                <a href="{{ route('profile') }}">
                    <div class="card__face card__face--front">
                        <div class="content">
                            <i class='fa fa-user fa-4x fa-icon'></i>                            
                            <h6>{{ __('Mis datos') }}</h6>
                            <p>{{ __('Actualiza tus datos personales.') }}</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="columna columna-5">
        <div class="scene">
            <div class="card">
                <a href="{{ route('password') }}">
                    <div class="card__face card__face--front">
                        <div class="content">
                            <i class='fa fa-lock fa-4x fa-icon'></i>                            
                            <h6>{{ __('Seguridad') }}</h6>
                            <p>{{ __('Actualiza regularmente tu contraseña.') }}</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<style>
h6 {color:#5AB248}
.content i {margin-bottom:10px}
</style>
@endsection