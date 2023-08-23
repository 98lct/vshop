@extends('layouts.admin')
@section('title','Product')
@section('main')
<link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Danh Sách Sản Phẩm
        </h1>
    </section>
    <section class="content">
    @include('errors.message')
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"></h3>
                <a href="{{asset('admin/product/create')}}" class="btn btn-default"><i class="fas fa-plus"></i></a>
                <a href="" class="btn btn-default" data-toggle="modal" data-target="#ModalTrash"><i class="fas fa-trash-alt"></i></a>
    @include('admin.product.trash')
                <button type="button" id="btn_delete_all" class="btn btn-sm btn-danger">Xóa</button>
            </div>
            <div class="box-body">
                <table id="product-tables" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="no-sort"><input id="checkall" class="" type="checkbox"></th>
                            <th width="5px">ID</th>
                            <th>Tên</th>
                            <th width="50px">Hình</th>
                            {{--
                            <th>Liên Kết</th> --}}
                            <th>Loại SP</th>
                            <th>Hiệu</th>
                            <th>Ngày Tạo</th>
                            <th width="100px">Hành Động</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </section>
</div>





























@section('script')
<script src="//code.jquery.com/jquery.js"></script>
{{--
<script src="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"></script> --}}
<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script>
    $(function() {
            $('#product-tables').DataTable({
                processing: false,
                serverSide: true,
                ajax: '{!! route('datatableProduct') !!}',
                columns: [
                    {data: 'checkone', name: 'checkone', orderable: false, searchable: false},
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data:'img',name:'img'},
                    { data:'category_name',name:'category_name'},
                    { data:'brand_name',name:'brand_name'},
                    { data: 'created_at', name: 'created_at' },
                    //{ data: 'show', name: 'show' },
                    { data: 'action', name: 'action' },
                    //{ data: 'include', name: '' },
                ],
                columnDefs: [ {
                    "targets": 'no-sort',
                    "orderable": false,
                }]

            });

           $('#checkall').change(function() {
                var checkboxes = $(this).closest('#product-tables').find(':checkbox');
                checkboxes.prop('checked', $(this).is(':checked'));
            });



        });
        $(document).on('click', '#btn_delete_all', function(){
            var id = [];
            if(confirm("Are you sure you want to Delete this data?"))
            {
                $('.checkone:checked').each(function(){

                    id.push($(this).val());
                });

                $('#checkall').click(function(){
                    $('.checkone:checked').each(function(){
                        id.push($(this).val());
                    });
                });

                //console.log(id);
                if(id.length > 0)
                {
                    $.ajax({
                        url:"{{route('RemoveProduct')}}",
                        method:"get",
                        data:{id:id},
                        success:function(data)
                        {
                            alert(data);
                            $('#product-tables').DataTable().ajax.reload();
                        }
                    });
                }
                else
                {
                    alert("Please select atleast one checkbox");
                }
            }
        });

</script>
@endsection

@endsection
