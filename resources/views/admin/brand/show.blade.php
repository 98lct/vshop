@php 
  use App\Models\Brand;
@endphp
<div class="modal fade" id="ModalShow{{$brand->id}}" tabindex="-1" role="dialog" aria-labelledby="ModalShowTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="ModalShowTitle">Chi Tiết : {{$brand->name}}
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </h3>
            </div>
            <div class="modal-body">
                <h4>ID: {{$brand->id}}</h4>
                <h4>Tên Thương Hiệu : {{$brand->name}}</h4>
                <h4>Hình Ảnh: <br/><img src="{{asset('upload/brand/'.$brand->img)}}" height="100px"></h4>
                <h4>Liên Kết: {{$brand->slug}} </h4>
                <h4>Cấp Cha: @if($brand->parentid==0)
                    ---Không Có Cấp Cha---
                    @else
                    @php 
                      $name=brand::where(['id'=>$brand['parentid']])->first();
                      echo ($name['name']);
                    @endphp
                  @endif
                </h4>
            
                <h4>Từ Khóa: {{$brand->metakey}} </h4>
                <h4>Mô Tả: {{$brand->metadesc}} </h4>
                <h4>Trạng Thái: @if($brand->status==1) Hiện @else Nổi Bật @endif </h4>
              
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>