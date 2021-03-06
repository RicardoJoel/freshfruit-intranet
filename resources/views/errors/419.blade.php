@extends('layouts.app')
@section('content')
<div class="error-404 not-found">		
    <div class="space3"></div>
    <div class="fila">
        <div class="columna columna-1">
            <center><h1 class="title-404">419</h1></center>
        </div>
    </div>
    <div class="space1"></div>
    <div class="fila">
        <div class="columna columna-1">
            <center><h4>¡Uy! El token ha expirado. Por favor, regrese a la página anterior.</h4></center>					
        </div>
    </div>
    <div class="space2"></div>
    <div class="fila">
        <div class="columna columna-1">
            <center><a href="{{ url('/') }}" class="btn-effie">Regresar</a></center>
        </div>
    </div>				
</div>
@endsection