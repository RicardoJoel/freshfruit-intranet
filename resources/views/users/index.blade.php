@extends('layouts.app')
@section('content')
<div class="fila">
    <div class="columna columna-1">
        <div class="title2">
            <h6>{{ __('Listado de usuarios') }}</h6>
        </div>
    </div>
</div>
<div class="fila">
    <div class="columna columna-1">
        <table id="tbl-index" class="tablealumno">
            <thead>
                <th width="50">N°</th>    
                <th width="270">Nombre completo</th>
                <th width="270">Correo electrónico</th>
                <th width="270">Empresa</th>
                <th width="120">Estado</th>
                <th>Editar</th>
                <th>Borrar</th>
            </thead>
            <tbody>
                @if ($users->count())
                    @foreach ($users as $user)
                    <tr>
                        <td></td>
                        <td>{{ $user->name.' '.$user->lastname }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->company }}</td>
                        <td><center>{{ $user->deleted_at ? 'Eliminado' : ($user->is_blocked ? 'Bloqueado' : ($user->email_verified_at ? 'Verificado' : 'Registrado')) }}</center></td>
                        <td><center><a class="btn btn-secondary btn-xs" href="{{ action('UserController@edit', $user->id) }}" ><span class="glyphicon glyphicon-pencil"></span></a></center></td>
                        <td>
                            <center>
                            <form action="{{ action('UserController@destroy', $user->id) }}" method="post">
                                {{csrf_field()}}
                                <input name="_method" type="hidden" value="DELETE">
                                <button class="btn btn-danger btn-xs" type="submit" onclick="return confirm('¿Realmente desea eliminar el usuario seleccionado?')"><span class="glyphicon glyphicon-trash"></span></button>
                            </form>
                            </center>
                        </td>
                    </tr>
                    @endforeach 
                @else
                <tr>
                    <td colspan="8">No hay registros.</td>
                </tr>
                @endif
            </tbody>
        </table>
        {{$users->links()}}
    </div>
</div>
<div class="fila">
    <div class="space2"></div>
    <div class="columna columna-1">
        <center>
        <a href="{{ route('users.create') }}" class="btn-effie" style="margin-bottom:30px">Nuevo</a>
        <a href="{{ route('home') }}" class="btn-effie-inv">Regresar</a>
        </center>
    </div>
</div>
@endsection