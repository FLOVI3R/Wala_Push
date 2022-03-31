@extends('adminlte::page')

@section('title', 'WalaPush')

@section('content_header')
    <h1>Panel Administrador</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
        <h3 class="card-title">Cuentas de usuarios:</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
            <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
            <i class="fas fa-times"></i>
            </button>
        </div>
        </div>
        <div class="card-body">
        <table class="table">
        <thead>
            <tr>
            <th scope="col">ID</th>
            <th scope="col">NOMBRE</th>
            <th scope="col">EMAIL</th>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
        @if (session('status'))
            <div class="alert alert-success" role="alert">
            {{ session('status') }}
            </div>
        @endif  
        @foreach($users as $user)
            <tr>
            <input type="hidden" class="serdelete_val_id" value="{{ $user->id }}">
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td><a href="user_edit/{{ $user->id }}" class="btn btn-info">EDITAR</a></td>
            @if ($user->actived == 0)
            <td><a href="user_activate/{{ $user->id }}" class="btn btn-info">Activar Usuario</a></td>
            @endif
            @if ($user->actived == 1)
            <td><a href="user_deactivate/{{ $user->id }}" class="btn btn-info">Desactivar Usuario</a></td>
            @endif
            <td>
                <form method="POST" action="{{ route('user.delete', $user->id) }}">
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
    <script type="text/javascript">
  $('.show_confirm').click(function(event) {
          var form =  $(this).closest("form");
          var name = $(this).data("name");
          event.preventDefault();
          swal({
              title: '¿Está seguro de querer borrar este usuario?',
              text: 'No podrá revertir el cambio.',
              icon: "warning",
              buttons: true,
              dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              form.submit();
            }
          });
      });
</script>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_extra.css">
@stop

