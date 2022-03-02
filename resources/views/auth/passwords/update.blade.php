@extends('layouts.app')
@section('content')
<div class="fila">
	<div class="columna columna-1">
		<div class="title2">
			<h6>{{ __('Cambiar contraseña') }}</h6>
		</div>
	</div>
</div>
<div class="fila">
	<div class="columna columna-1">
		<div class="formulario-inscripcion">
			<form method="POST" action="{{ url('changePassword') }}" role="form">
				@csrf
				<input type="hidden" name="email" value="{{ Auth::user()->email }}">

				<div class="fila">
					<div class="columna columna-3">
						<label>Contraseña actual*</label>
						<input type="password" name="current_password" id="current_password" maxlength="50" required>
					</div>
					<div class="columna columna-3">
						<label>Nueva contraseña*</label>
						<input type="password" name="new_password" id="new_password" maxlength="50" required>
					</div>
					<div class="columna columna-3">
						<label>Confirmar contraseña*</label>
						<input type="password" name="new_confirm_password" id="new_confirm_password" maxlength="50" required>
					</div>
				</div>
				<div class="fila">
					<div class="columna columna-1">
						<p>
							<i class="fa fa-info-circle fa-icon" aria-hidden="true"></i>&nbsp;
							<b>Importante</b>
							<ul>
								<li>(*) Campos obligatorios.</li>
								<li>La nueva contraseña debe estar compuesta por entre ocho (8) y cincuenta (50) caracteres con, al menos, una letra y un dígito.</li>
								<li>La nueva contraseña debe ser diferente a su correo electrónico.</li>
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