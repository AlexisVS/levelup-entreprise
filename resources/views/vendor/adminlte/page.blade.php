@extends('adminlte::master')

@inject('layoutHelper', 'JeroenNoten\LaravelAdminLte\Helpers\LayoutHelper')

@section('adminlte_css')
@stack('css')
@yield('css')
@stop

@section('classes_body', $layoutHelper->makeBodyClasses())

@section('body_data', $layoutHelper->makeBodyData())

@section('body')
{{-- Notification --}}
<script src="{{ mix('js/app.js') }}"></script>
<div id="notification-container" style="position:fixed; top: 10px; right: 10px; z-index: 99999">
  {{-- <livewire:notification /> --}}
</div>
<script defer>
  function makeAlert(object) {
    const htmlString = `<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>${object.message != null ? 'You have received a new message' : 'You have received a new task'}</strong>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>`;
    document.querySelector('#notification-container').innerHTML = htmlString;
    setTimeout(() => {
      document.querySelector('#notification-container').children[0].remove()
    }, 3000);
  };
  window.Echo.private('App.Models.User.1')
    .listen('MessageReceivedEvent', (e) => {
      console.log(['bonjour  notification', e]);
      makeAlert(e.data)
    })

</script>
<div class="wrapper">

  {{-- Top Navbar --}}
  @if($layoutHelper->isLayoutTopnavEnabled())
  @include('adminlte::partials.navbar.navbar-layout-topnav')
  @else
  @include('adminlte::partials.navbar.navbar')
  @endif

  {{-- Left Main Sidebar --}}
  @if(!$layoutHelper->isLayoutTopnavEnabled())
  @include('adminlte::partials.sidebar.left-sidebar')
  @endif

  {{-- Content Wrapper --}}
  @empty($iFrameEnabled)
  @include('adminlte::partials.cwrapper.cwrapper-default')
  @else
  @include('adminlte::partials.cwrapper.cwrapper-iframe')
  @endempty

  {{-- Footer --}}
  @hasSection('footer')
  @include('adminlte::partials.footer.footer')
  @endif

  {{-- Right Control Sidebar --}}
  @if(config('adminlte.right_sidebar'))
  @include('adminlte::partials.sidebar.right-sidebar')
  @endif

</div>
@stop

@section('adminlte_js')
@stack('js')
@yield('js')
@stop
