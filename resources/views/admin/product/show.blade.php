
<div class="modal fade" id="ModalShow{{$products->id}}" tabindex="-1" role="dialog" aria-labelledby="ModalShowTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="ModalShowTitle">Chi Tiết : {{$products->name}}
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </h3>
            </div>
            <div class="modal-body">
                <h4>ID: {{$products->id}}</h4>
                <h4>Tên Sản Phẩm : {{$products->name}}</h4>
                <h4>Hình Ảnh: <br/><img src="{{asset('product/'.$product->img)}}" height="100px"></h4>
                <h4>Liên Kết: {{$products->slug}} </h4>


                <h4>Trạng Thái: @if($products->status==1) Hiện @else Nổi Bật @endif </h4>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
