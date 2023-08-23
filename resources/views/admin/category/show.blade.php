@php 
  use App\Models\Category;
@endphp
<div class="modal fade" id="ModalShow{{$category->id}}" tabindex="-1" role="dialog" aria-labelledby="ModalShowTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="ModalShowTitle">Chi Tiết : {{$category->name}}
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </h3>
            </div>
            <div class="modal-body">
                <h4>ID: {{$category->id}}</h4>
                <h4>Tên Sản Phẩm : {{$category->name}}</h4>
                <h4>Hình Ảnh: <br/><img src="{{asset('upload/category/'.$category->img)}}" height="100px"></h4>
                <h4>Liên Kết: {{$category->slug}} </h4>
                <h4>Cấp Cha: @if($category->parent_id==0)
                    ---Không Có Cấp Cha---
                    @else
                    @php 
                      $name=Category::where(['id'=>$category['parent_id']])->first();
                      echo ($name['name']);
                    @endphp
                  @endif
                </h4>
            
                <h4>Trạng Thái: @if($category->status==1) Hiện @else Nổi Bật @endif </h4>
              
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>