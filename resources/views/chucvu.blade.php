@extends('layout', ['page' => 'chức vụ'])
@section('head')
<style>
    .edittext, .edittext:focus{
        background: #ffffff00;
        border: none;
    }
</style>
@endsection


@section('content')
   <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="header">
                        <h2> Danh sách chức vụ </h2>
                        <div class="clearfix">
                            <div class="col-sm-3">
                                <button class="btn btn-primary" id="add_cv" data-toggle="modal" data-target="#exampleModal">Thêm chức vụ</button>
                            </div>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Thêm chức vụ</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form>
                                        <div class="form-group">
                                        <div class="form-line">
                                            <label>Tên chức vụ</label>
                                            <input type="text" class="form-control date" id="cv" value="">
                                        </div>
                                        <div class="form-line">
                                            <label>Màu</label>
                                            <input type="color" class="form-control date" id="color" value="">
                                        </div>
                                        
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" id="submit_cv">Save changes</button>
                                </div>
                                </div>
                            </div>
                            
                        </div>
                        
                        <ul class="header-dropdown">
                            <li class="dropdown"><a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more-vert"></i> </a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="javascript:void(0);">Action</a></li>
                                    <li><a href="javascript:void(0);">Another action</a></li>
                                    <li><a href="javascript:void(0);">Something else here</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th>Tên chức vụ</th>
                                        <th>Màu</th>
                                        <th width="20%">Operation</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($chucvu as $item)
                                    <tr>
                                        <td class="namecv" data-id="{{$item->id}}" data-st="0">{{$item->name}}</td>
                                        <td><input type="color" class="form-control color_picker" value="{{$item->icon == null ? '#FFFFFF' : $item->icon}}" data-id="{{$item->id}}"></td>
                                        <td><span class="badge badge-danger delete" style="cursor: pointer" data-id="{{$item->id}}">Xóa</span></td>

                                    </tr>
                                @endforeach
                                 
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
@endsection

@section('script')
<script src="{{asset('bundles/datatablescripts.bundle.js')}}"></script>
<script src="{{asset('plugins/jquery-datatable/buttons/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('plugins/jquery-datatable/buttons/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/jquery-datatable/buttons/buttons.colVis.min.js')}}"></script>
<script src="{{asset('plugins/jquery-datatable/buttons/buttons.flash.min.js')}}"></script>
<script src="{{asset('plugins/jquery-datatable/buttons/buttons.html5.min.js')}}"></script>
<script src="{{asset('plugins/jquery-datatable/buttons/buttons.print.min.js')}}"></script>
<script src="{{asset('js/pages/tables/jquery-datatable.js')}}"></script>
<script>
$(document).ready(function(){
    //delete
    $('.delete').on('click', function(e){
        e.stopPropagation();
        var id = $(this).attr('data-id');
        var that = this;
        swal({
            title: "Bạn có chắc chắn?",
            text: "Đồng ý sẽ xóa toàn bộ các dữ liệu liên quan",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            console.log(id);
            if (willDelete) {
                $.ajax({
                    url: "{{route('chucvu.delete')}}",
                    type: 'post',
                    data: {
                        id: id,
                        "_token": "{{ csrf_token() }}",
                    }
                })
                .done(res =>{
                    if(res.is){
                        swal("Xóa thành công!", {
                        icon: "success",
                        });
                        $(that).closest('tr').remove();
                        // setTimeout(()=>{location.reload()}, 2000)
                    }else{
                        swal("lôi!", {
                        icon: "warning",
                        });
                    }
                })
            } else {
                swal("Không xóa!");
            }
        });
    });
    //click to edit
    $('#name_change').on('click', function(e){
        e.stopPropagation();
    });
    $('.color_picker').on('change', function(e){
        e.stopPropagation();
        $.ajax({
            url: "{{route('chucvu.edit')}}",
            type: 'post',
            data: {
                color: $(this).val(),
                id: $(this).attr('data-id'),
                "_token": "{{ csrf_token() }}",
            }
        })
        .done(res =>{
            if(res.is){
                toastr.success('sửa thành công');
            }else{
                toastr.error('Lỗi');
            }
        })
    });
    $('.namecv').on('click', function(e){
        e.stopPropagation();
        let st = parseInt($(this).attr('data-st'));
        st = st+1;
        $(this).attr('data-st', st);
        if(st == 1){
            let val = $(this).text();
            $(this).text('');
            $(this).append(`<input type="text" class="form-control edittext" id="name_change" value="${val}">`);
        }
    });
    $(window).click(function() {
        let val = $('#name_change').val();
        $('.namecv').each(function(i, obj) {
            if($(obj).children('input').length != 0){
                $(obj).html(val);
                $(obj).attr('data-st', 0);
                $.ajax({
                    url: "{{route('chucvu.edit')}}",
                    type: 'post',
                    data: {
                        name: $(obj).text(),
                        id: $(obj).attr('data-id'),
                        "_token": "{{ csrf_token() }}",
                    }
                })
                .done(res =>{
                    if(res.is){
                        toastr.success('sửa thành công');
                    }else{
                        toastr.error('Lỗi');
                    }
                })
            }
        });
    });

    $('#submit_cv').on('click', function(){
        $.ajax({
            url: "{{route('chucvu.add')}}",
            type: 'post',
            data: {
                name: $('#cv').val(),
                color: $('#color').val(),
                "_token": "{{ csrf_token() }}",
            }
        })
        .done(res =>{
            if(res.is){
                toastr.success('Thêm thành công');
                setTimeout(()=>{location.reload()}, 2000)
            }else{
                toastr.error('Lỗi');
            }
        })
    });
})
</script>
@endsection