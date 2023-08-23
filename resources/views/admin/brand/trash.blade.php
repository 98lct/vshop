<div class="modal fade bd-example-modal-lg" id="ModalTrash" tabindex="-1" role="dialog" aria-labelledby="ModalTrashTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="ModalTrashTitle">Thùng Rát :
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </h3>
            </div>
            <div class="modal-body">
              <table id="example2" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th width="10px">STT</th>
                    <th>Tên</th>
                    <th width="50px">Hình</th>
                    <th >Loại Thương Hiệu</th>
                    <th >Thương Hiệu</th>
                    <th >Ngày Xóa</th>
                    <th width="70px">Hành Động</th>
                  </tr>
                </thead>
                <tbody> 
                  @php $i=1 @endphp
                  @foreach($items as $key=>$value)
                    <tr>
                      <td>{{$i++}}</td>
                      <td>{{$value->name}}</td>
                      <td align="center"><img src="{{ asset('upload/brand/'.$value->img) }}" height="30px"></td>
                      <td></td>
                      <td></td>
                      <td>{{$value->updated_at}}</td>
                      <td align="center">
                        <a href="{{asset('admin/brand/restore/'.$value->id)}}" class="btn btn-success btn-sm" id="btn-restore"><i class="fas fa-redo-alt"></i> </a>
                        <form method="post" action="{{route('DeleteBrand',$value->id)}}"> @method('DELETE') @csrf
                        <button type="submit" class="btn btn-danger btn-sm" id="btn-destroy"><i class="fas fa-times" onclick="Confirm()"></i></button></form>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>