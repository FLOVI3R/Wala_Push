@extends('layouts.app')
 
@section('title', 'Page Title')
<title>WalaPush</title>
 
@section('content')
    <div class="card" margin-left="10">
        <div class="card-header">
            <h3 class="card-title">MENÚ DE CREACIÓN DE ANUNCIOS</h3>
        </div>
        <div>
        <div class="card-body">
            <form action="{{ url('ad_create')}}" method="POST">
                {{ csrf_field() }}
                @method('GET')
                <div class="form-group">Nombre del producto:
                    <input name="name" type="text" class="form-control">
                </div>
                <div class="form-group">Descripción:
                    <input name="description" type="text" class="form-control">
                </div>
                <div class="form-group">Precio de venta:
                    <input name="price" type="text" class="form-control">
                </div>
                <div class="form-group">Categoría:
                    <select name="category" class="form-control">
                        @foreach($categoria as $cat)  
                        <option value="{{ $cat->id }}">{{ $cat->nombre }}</option>  
                        @endforeach  
                    </select>   
                </div>
                <div class="form-group">Producto de seguda mano:
                    <input type="checkbox" id="cbox1" value="first_checkbox"></label>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary">Crear anuncio</button>
                </div>
            </form>
        <div>
        <h3 class="card-title">PRODUCTOS A LA VENTA</h3>
        <table class="table">
        <thead>
            <tr>
            <th scope="cat">Nombre</th>
            <th scope="name">Categoría</th>
            <th scope="price">Precio</th>
            <th scope="state">Estado</th>
            <th scope="desc">Descripción</th>
            </tr>
        </thead>
        <tbody>
        @if (session('status'))
            <div class="alert alert-success" role="alert">
            {{ session('status') }}
            </div>
        @endif  
        @foreach($ads as $ad)
            <tr>
            <input type="hidden" class="serdelete_val_id" value="{{ $ad->id }}">
            <td>{{ $ad->producto }}</td>
            <td>{{ $ad->id_categoria }}</td>
            <td>{{ $ad->precio }}</td>
            <td>{{ $ad->nuevo }}</td>
            <td>{{ $ad->descripcion }}</td>
            <td><a href="" class="btn btn-info">EDITAR</a></td>
            <td>
                <form method="POST" action="{{ route('ad.delete', $ad->id) }}">
                @csrf
                <input name="_method" type="hidden" value="DELETE">
                <button type="submit" class="btn btn-danger show_confirm" data-toggle="tooltip" title='Delete'>ELIMINAR</button>
                </form>
            </td>
            </tr>
            @endforeach
        </tbody>
        </table> 
        </div>
    </div>
@endsection