@extends('layout', ['page' => 'Lương cứng nhân viên'])
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
                        <h2> Bảng kê khai lương </h2>
                        <div class="clearfix">
                            <div class="col-sm-3">
                                <button class="btn btn-primary" id="add_cv" data-toggle="modal" data-target="#exampleModal">Thêm bản ghi</button>
                            </div>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Thêm bản ghi</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form>
                                        <div class="form-group">
                                        <div class="form-line">
                                            <label>Chọn nhân viên: </label>
                                            <select id="user_id" class="show-tick" style="margin-left: 10px">
                                                @foreach ($user as $us)
                                                    <option value="{{$us->id}}">{{$us->fullname}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-line">
                                            <label>Mức lương</label>
                                            <input type="number" min="10000" step="10000" class="form-control date" id="salaries" value="" style="display: inline; width: 70%">
                                            <span>VND</span>
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
                                        <th>Id</th>
                                        <th>User</th>
                                        <th>Mức lương <span style="color: red">*</span></th>
                                        <th>Created at</th>                                       
                                        <th width="20%">Operation</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($salary as $item)
                                    <tr>
                                        <td class="namecv" data-id="{{$item->id}}" data-st="0">{{$item->id}}</td>
                                        <td data-id="{{$item->id}}" data-st="0"><span class="badge badge-warning bg-blue hidden-sm-down">
                                            <a href="{{route('profile.index',['id' => $item->User->username])}}" style="color: white; text-decoration: none;" target="_blank">{{$item->User->username}}</a>
                                        </span> {{$item->User->fullname}} </td>
                                        <td class="currency">{{$item->salary}}</td>
                                        <td>{{$item->created_at}}</td>
                                        <td>
                                            <span title="Thông báo qua sms phone" class="badge badge-success phone_send" style="cursor: pointer" data-id="{{$item->id}}" data-salary="{{$item->salary}}" data-userphone="{{$item->User->phone}}" data-time="{{$item->created_at}}"><i class="zmdi zmdi-smartphone-landscape"></i></span>
                                            <span title="Thông báo qua Email" class="badge badge-success email_send" style="cursor: pointer" data-id="{{$item->id}}" data-email="{{$item->User->email}}" data-time="{{$item->created_at}}" data-user="{{$item->User->id}}" data-salary="{{$item->salary}}"><i class="zmdi zmdi-email"></i></span>
                                            <span title="Việc xóa lương nhân viên sẽ ảnh hưởng đến phần tính lương cho nhân viên" class="badge badge-danger delete" style="cursor: pointer" data-id="{{$item->id}}">Xóa</span>
                                        </td>

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
    //currency format
    $('.currency').each(function(i, obj) {
        let val = parseInt($(obj).text());
        val = val.toLocaleString('it-IT', {style : 'currency', currency : 'VND'});
        $(obj).text(val);
    });
    //send sms phone 
    $('.phone_send').on('click', function(e){
        e.stopPropagation();
        var salary = $(this).data('salary');
        var phone = $(this).data('userphone');
        var time = $(this).data('time');
        var that = this;
        swal({
            title: "Bạn có Muốn thông báo qua sms phone?",
            text: "Thông báo tới "+phone+" mức lương được khởi tạo vào lúc: "+time ,
            icon: "info",
            buttons: true,
            dangerMode: true,
        })
        .then((will) => {
            if (will) {
                $.ajax({
                    url: "{{route('salaries.notiphone')}}",
                    type: 'post',
                    data: {
                        phone: phone,
                        salary: salary,
                        time: time,
                        "_token": "{{ csrf_token() }}",
                    }
                })
                .done(res =>{
                    if(res.is){
                        swal("Thông bào thành công!", {
                        icon: "success",
                        });
                        // setTimeout(()=>{location.reload()}, 2000)
                    }else{
                        swal("lôi!", {
                        icon: "warning",
                        });
                    }
                })
            } else {
                swal("Thông báo chưa được gửi!");
            }
        });
    });
    //send email
    $('.email_send').on('click', function(e){
        e.stopPropagation();
        var id = $(this).data('id');
        var email = $(this).data('email');
        var time = $(this).data('time');
        var user = $(this).data('user');
        var salary = $(this).data('salary');
        var that = this;
        swal({
            title: "Bạn có Muốn thông báo qua email?",
            text: "Thông báo tới "+email+" mức lương được khởi tạo vào lúc: "+time ,
            icon: "info",
            buttons: true,
            dangerMode: true,
        })
        .then((will) => {
            console.log(id);
            if (will) {
                $.ajax({
                    url: "{{route('salaries.noti')}}",
                    type: 'post',
                    data: {
                        id: id,
                        user_id: user,
                        salary: salary,
                        time: time,
                        "_token": "{{ csrf_token() }}",
                    }
                })
                .done(res =>{
                    if(res.is){
                        swal("Thông bào thành công!", {
                        icon: "success",
                        });
                        // setTimeout(()=>{location.reload()}, 2000)
                    }else{
                        swal("lôi!", {
                        icon: "warning",
                        });
                    }
                })
            } else {
                swal("Thông báo chưa được gửi!");
            }
        });
    });
    //delete
    $('.delete').on('click', function(e){
        e.stopPropagation();
        var id = $(this).attr('data-id');
        var that = this;
        swal({
            title: "Bạn có chắc chắn?",
            text: "Việc xóa lương nhân viên sẽ ảnh hưởng đến phần tính lương cho nhân viên",
            icon: "error",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            console.log(id);
            if (willDelete) {
                $.ajax({
                    url: "{{route('salaries.delete')}}",
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
            url: "{{route('salaries.add')}}",
            type: 'post',
            data: {
                user_id: $('#user_id').val(),
                salary: $('#salaries').val(),
                "_token": "{{ csrf_token() }}",
            }
        })
        .done(res =>{
            if(res.is){
                toastr.success('Thêm thành công');
                setTimeout(()=>{location.reload()}, 2000)
            }else{
                toastr.error(res.messenges);
            }
        })
    });
})
</script>
@endsection