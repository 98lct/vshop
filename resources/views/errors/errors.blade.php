@if ($errors->any()) 
    
        <div aria-live="polite" aria-atomic="true" style="position: relative;">
        <div data-delay='3000' class="toast" style="position: absolute; top: 0; right: 0; z-index: 100">
            <div class="toast-header">
            <img src="{{asset('img/dot_error.png')}}" style="height:10px" class="rounded mr-2" alt="...">
            <strong class="mr-auto">Thông Báo</strong>
            <small>{{date('H:i:s')}}</small>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="toast-body">
            @foreach ($errors->all() as $error) 
                - {{ $error }} <br>
            @endforeach 
            </div>
        </div>
        </div>
    
@endif