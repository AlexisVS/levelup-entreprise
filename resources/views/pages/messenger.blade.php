@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Messenger</h1>
@stop

@section('content')
<script type="text/javascript" src="{{ mix('js/app.js') }}"></script>

<script>
  Echo.channel(`messages`)
    .listen('SendMessageEvent', (e) => {
      console.log(['bonjour broadcasdt', e]);
      Livewire.emit('updateMessages', e.data.message)
    })

</script>
<livewire:messenger :users="$users" />
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>
</script>
@stop
