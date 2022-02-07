@if($notifications != null)
{{ dd($notifications) }}
@foreach ($notifications as $notification)
<div class="alert alert-warning alert-dismissible fade show my-1" role="alert" style="z-index: 999999">
  <strong>dsfdf</strong>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endforeach
@endif
