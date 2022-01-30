@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Messenger</h1>
@stop

@section('content')
<script type="text/javascript" src="{{ mix('js/app.js') }}"></script>
@foreach ($users as $user)
<x-messenger :user="$user"></x-messenger>
<script>
  console.log(window);
  Echo.channel(`messages.${{!! $user->id !!}}`)
    .listen('.SendMessageEvent', (e) => {
      console.log(['bonjour broadcasdt', e]);
    });

</script>
@endforeach
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>
</script>
@stop
