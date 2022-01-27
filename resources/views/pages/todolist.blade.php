@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Todo lists</h1>
@stop

@section('content')
@foreach ($users as $user)
<x-todolist :user="$user"></x-todolist>
@endforeach
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>

</script>
@stop
