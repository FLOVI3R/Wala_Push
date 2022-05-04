@extends('adminlte::page')

@section('title', 'WalaPush')

@section('content')
    <div class="card">
        <h3 class="card-title">Informes PDF:</h3>
        <div class="form-group">Seleccionar categoría:
                    <select name="category" class="form-control">
                        @foreach($categoria as $cat)  
                        <option value="{{ $cat->id }}">{{ $cat->nombre }}</option>  
                        @endforeach  
                    </select> 
                    <div>
                        <input type="date" name="date1">Seleccionar fecha inicio</input>  
                        <input type="date" name="date2">Seleccionar fecha fin</input> 
                    </div> 
                <a href="pdf2">Descargar PDF</a>
                </div>
        <div class="card-tools">
            <a href="pdf">Descargar PDF</a>
        </div>
    </div>
@stop