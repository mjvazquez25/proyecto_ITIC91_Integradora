
@extends('layouts.master') 
 
@section('content')
    <ul>
      @foreach($usuarios as $usuario)
        <li>
          {{ $usuario->dsNombre.' '.$usuario->dsApellidoPaterno }} 
        </li>
      @endforeach 
    </ul>
@stop
