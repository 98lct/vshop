@if (session('message'))
<div aria-live="polite" aria-atomic="true" style="position: relative; ">
  <div data-delay='3000' class="toast" style="position: absolute; top: 0; right: 0; z-index: 100">
    <div class="toast-header">
      <img src="{{asset('img/dot_success.png')}}" style="height: 10px" class="rounded mr-2" alt="...">
      <strong class="mr-auto">Thông Báo</strong>
      <small>{{now()}}</small>
      <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="toast-body">
       {{ session('message') }}
    </div>
  </div>
</div>
@endif