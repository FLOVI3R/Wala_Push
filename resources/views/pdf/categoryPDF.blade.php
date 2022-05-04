@extends('adminlte::page')

@section('title', 'WalaPush')

@section('content')
<table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">NOMBRE</th>
                <th scope="col">PRECIO</th>
            </tr>
        </thead>
        <tbody>
            @foreach($anuncio as $a)
                <tr>
                    <td>{{ $a->producto }}</td>
                    <td>{{ $a->id_categoria }}</td>
                    <td>{{ $a->precio }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@stop