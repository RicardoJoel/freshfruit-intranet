@extends('layouts.app')
@section('content')
<div class="fila">
	<div class="columna columna-1">
		<div class="title2">
			<h6>{{ __('Información personal') }}</h6>
		</div>
	</div>
</div>
<div class="fila">
	<div class="columna columna-1">
		<div class="formulario-inscripcion">
			<form method="POST" action="{{ url('updateAccount') }}" role="form">
				@csrf
				<div class="fila">
					<div class="columna columna-3">
						<label>Nombre*</label>
						<input type="text" name="name" id="name" maxlength="50" value="{{ old('name', Auth::user()->name) }}" onkeypress="return checkName(event)" required>
					</div>
					<div class="columna columna-3">
						<label>Apellidos*</label>
						<input type="text" name="lastname" id="lastname" maxlength="50" value="{{ old('lastname', Auth::user()->lastname) }}" onkeypress="return checkName(event)" required>
					</div>
					<div class="columna columna-3">
						<label>Correo electrónico</label>
						<input type="email" name="email" id="email" maxlength="50" value="{{ old('email', Auth::user()->email) }}" onkeypress="return checkEmail(event)" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2, 4}$" disabled>
					</div>
				</div>
				<div class="fila">
					<div class="columna columna-3">
						<label>Documento de identidad*</label>
						<input type="text" name="document" id="document" maxlength="8" value="{{ old('document', Auth::user()->document) }}" onkeypress="return checkNumber(event)" required>
					</div>
					<div class="columna columna-3">
						<label>Celular</label>
						<input type="tel" name="telephone" id="telephone" maxlength="9" value="{{ old('telephone', Auth::user()->telephone) }}" onkeypress="return checkNumber(event)">
					</div>
					<div class="columna columna-3">
						<label>Empresa</label>
						<input type="text" name="organization" id="organization" maxlength="50" value="{{ old('organization', Auth::user()->organization) }}" onkeypress="return checkText(event)">
					</div>
				</div>
				<div class="fila">
					<div class="columna columna-1">
						<p>
							<i class="fa fa-info-circle fa-icon" aria-hidden="true"></i>&nbsp;
							<b>Importante</b>
							<ul>
								<li>(*) Campos obligatorios.</li>
								<li>El tamaño máximo del nombre, apellidos y empresa es cincuenta (50) caracteres.</li>
								@if (Auth::user()->is_admin)
								<li>Para modificar su correo electrónico, vaya al módulo de gestión de usuarios en el menú principal.</li>
								@else
								<li>Por seguridad, se le impide modificar su correo electrónico. De ser necesario, contacte al administrador del sistema.</li>
								@endif
								<li>El documento de identidad debe estar compuesto por ocho (8) dígitos.</li>
								<li>El celular debe estar compuesto por un nueve (9) seguido de ocho (8) dígitos.</li>
							</ul>
						</p>
					</div>
				</div>
				<div class="fila">
					<div class="space"></div>
					<div class="columna columna-1">
						<center>
						<button type="submit" class="btn-effie">Guardar</button>
						<a href="{{ route('home') }}" class="btn-effie-inv">Regresar</a>	
						</center>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection