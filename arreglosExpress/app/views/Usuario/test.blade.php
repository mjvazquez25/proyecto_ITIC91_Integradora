@extends('layouts.master2')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@stop

@section('content')
    <ul>
      @foreach($usuarios as $usuario)
        <li>
          {{ $usuario->dsNombre.' '.$usuario->dsApellidoPaterno }} 
        </li>
      @endforeach 
    </ul>
@stop