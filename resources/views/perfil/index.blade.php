@extends('layouts.app')

@section('titulo')
  Editar perfil: {{ auth()->user()->username }}
@endsection

@section('contenido')
  Contenido
@endsection
