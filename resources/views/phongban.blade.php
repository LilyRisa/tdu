@extends('layout', ['page' => 'phòng ban'])

@section('content')
   <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="header">
                        <h2> Danh sách phòng ban </h2>
                        <div class="clearfix">
                            <div class="col-sm-3">
                                <button class="btn btn-primary" id="add_cv" data-toggle="modal" data-target="#exampleModal">Thêm phòng ban</button>
                            </div>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Thêm phòng ban</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label>Thuộc chức vụ</label>
                                                <select class="form-control show-tick" id="chucvu_id">
                                                    @foreach($chucvu as $cv_item)
                                                        <option value="{{$cv_item->id}}">{{$cv_item->name}}</option>
                                                    @endforeach
                                                <select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label>Tên phòng ban</label>
                                                <input type="text" class="form-control date" id="pb" value="">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" id="submit_pb">Save changes</button>
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
                            <table class="table table-bordered table-striped table-hover js-exportable dataTable ">
                                <thead>
                                    <tr>
                                        <th>Tên phòng ban</th>
                                        <th>Chức vụ</th>
                                        <th>Icon</th>
                                        <th width="20%">Operation</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($phongban as $item)
                                    <tr>
                                        <td class="namecv" data-id="{{$item->id}}" data-cv="{{$item->chucvu_id}}" data-st="0">{{$item->name}}</td>
                                        <td>
                                            <select class="show-tick chucvu_change" data-id="{{$item->id}}" data-color="{{$item->chucvu->icon}}">
                                                @foreach ($chucvu as $cv)
                                                    @if ($cv->id == $item->chucvu_id)
                                                        <option value="{{$cv->id}}" selected>{{$cv->name}}</option>
                                                    @else
                                                        <option value="{{$cv->id}}">{{$cv->name}}</option>
                                                    @endif                                                  
                                                @endforeach
                                            </select>
                                            <span class="badge badge-light color_cv" style="background-color: {{$item->chucvu->icon}}">{{$item->chucvu->name}}</span></td>
                                        <td>{{$item->icon}}</td>
                                        <td><span class="badge badge-danger delete" style="cursor: pointer;" data-id="{{$item->id}}">Xóa</span></td>
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
    $('#submit_pb').on('click', function(){
        $.ajax({
            url: "{{route('phongban.add')}}",
            type: 'post',
            data: {
                name: $('#pb').val(),
                chucvu_id: $('#chucvu_id').val(),
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
                    url: "{{route('phongban.delete')}}",
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
    $('.chucvu_change').on('change', function(){
        $.ajax({
            url: "{{route('phongban.edit')}}",
            type: 'post',
            data: {
                chucvu: $(this).val(),
                id: $(this).data('id'),
                "_token": "{{ csrf_token() }}",
            }
        })
        .done(res =>{
            if(res.is){
                toastr.success('sửa thành công');
                console.log($(this).data('color'));
                $.post("{{route('phongban.getcolor')}}", { id: $(this).val(), _token : "{{ csrf_token() }}" }).done((e) =>{
                    console.log(e);
                    $(this).closest('td').children('.color_cv').attr('style',`background-color: ${e.return.icon}`);
                    $(this).closest('td').children('.color_cv').text($(this).find('option:selected').text());
                })
                
            }else{
                toastr.error('Lỗi');
            }
        })
    });
    $(window).click(function() {
        let val = $('#name_change').val();
        $('.namecv').each(function(i, obj) {
            if($(obj).children('input').length != 0){
                $(obj).html(val);
                $(obj).attr('data-st', 0);
                $.ajax({
                    url: "{{route('phongban.edit')}}",
                    type: 'post',
                    data: {
                        name: $(obj).text(),
                        chucvu: $(obj).data('cv'),
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
})
</script>
@endsection