@extends('adminlte::page')

@section('title', 'WalaPush')

@section('content_header')
    <h1>Panel Administrador</h1>
@stop

@section('content')
<div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <form action="{{ url('user_update/'.$user->id) }}" method="POST">
                {{ csrf_field() }}
                @method('PUT')
                <div class="form-group">Nombre
                    <input name="name" type="text" class="form-control" value="{{ $user->name }}">
                </div>
                <div class="form-group">Email
                    <input name="email" type="text" class="form-control" value="{{ $user->email }}">
                </div>
                <div class="form-group">Rol
                    <select name="role" class="form-control">
                    <option value="user">Usuario</option>    
                    <option value="admin">Administrador</option>
                    </select>   
                </div>
                <div class="form-group">Localidad
                    <input name="localidad" type="text" class="form-control" value="{{ $user->localidad }}">
                </div>
                <div class="form-group">
                    <button class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
@stop