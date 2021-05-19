@extends('layout', ['page' => 'Quản lý tài khoản'])

@section('content')
   <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="header">
                        <h2> Account management </h2>
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
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Fullname</th>
                                        <th>Chức vụ</th>
                                        <th>Phòng ban</th>
                                        <th>Operation</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($user as $user_item)
                                    <tr>
                                        <td><span class="badge badge-info"><a href="{{route('profile.index', ['id' => $user_item->username])}}" style="color:white">{{$user_item->username}}</a><span></td>
                                        <td>{{$user_item->email}}</td>
                                        <td>{{$user_item->fullname}}</td>
                                        <td>{{isset($user_item->chucvu->name) ? $user_item->chucvu->name : ''}}</td>
                                        <td>{{isset($user_item->phongban->name) ? $user_item->phongban->name : ''}}</td>
                                        @if($user_item->isActive == 0)
                                        <td><span class="badge badge-success open-AddBookDialog" style="cursor: pointer;" data-toggle="modal" data-target="#exampleModal" data-avatar="{{asset('storage')}}/{{$user_item->avatar}}" data-id="{{$user_item->id}}" data-email="{{$user_item->email}}" data-fullname="{{$user_item->fullname}}">Active</span> <span class="badge badge-danger" style="cursor: pointer;">Reject</span></td>
                                        @else
                                        <td><span class="badge badge-secondary">Account is active</span></td>
                                        @endif
                                    </tr>
                                @endforeach
                                 
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- modal --}}
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Active account</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <div class="form-line">
                                <img src="" alt="avatar" id="ac_avatar" style="vertical-align: middle;width: 50px;height: 50px;border-radius: 50%;">
                            </div>
                        <div class="form-line">
                            <label>Tên</label>
                            <input type="text" class="form-control date" id="ac_name" value="" disabled>
                        </div>
                        <div class="form-line">
                            <label>Email</label>
                            <input type="text" class="form-control date" id="ac_email" value="" disabled>
                        </div>
                        <div class="">
                            <label>Chức vụ</label>
                            <select id="ac_chucvu" class="form-control show-tick" >
                                @foreach($chucvu as $cv)
                                <option value="{{$cv->id}}">{{$cv->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-line" >
                            <label>Phòng ban</label>
                            <select id="ac_phongban" class="form-control show-tick"></select>
                        </div>
                    
                        
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="submit_acti">Active account and send notification</button>
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
    $('#submit_acti').on('click', function(){
        $.ajax({
            url: "{{route('account.activeuser')}}",
            type: 'post',
            data: {
                id: $(this).data('id'),
                chucvu: $('#ac_chucvu option:selected').val(),
                phongban: $('#ac_phongban option:selected').val(),
                "_token": "{{ csrf_token() }}",
            }
        })
        .done(res =>{
            console.log(res);
            if(res.is){
                toastr.success('Active thành công');
                setTimeout(()=>{location.reload()},3000);
            }else{
                toastr.error('Lỗi');
            }
        })
    });
    $('#ac_chucvu').on('change', function(){
        getPhongban($(this).val());
    });

    function getPhongban(id){
        $.ajax({
            url: "{{route('account.getpb')}}",
            type: 'post',
            data: {
                chucvu_id: id,
                "_token": "{{ csrf_token() }}",
            }
        })
        .done(res =>{
            let pb = res.phongban;
            $('#ac_phongban').html('');
            $.each(pb, function (i, item) {
                // console.log(item);
                $('#ac_phongban').append(`<option value="${item.id}">${item.name}</option>`)
            });
            let newitemnum = Math.floor(Math.random() * pb.length) + 1;
            $("#ac_phongban").val(newitemnum);
            $('#ac_phongban').selectpicker("refresh");
        })
    }
    
    $(document).on("click", ".open-AddBookDialog", function () {
        var id = $(this).data('id');
        var email = $(this).data('email');
        var fullname = $(this).data('fullname');
        var avatar = $(this).data('avatar');
        $('#ac_name').val(fullname);
        $('#ac_email').val(email);
        $('#ac_avatar').attr('src',avatar);
        $('#submit_acti').attr('data-id',id);
        getPhongban($('#ac_chucvu option:selected').val());
     // As pointed out in fullname, 
     // it is unnecessary to have to manually call the modal.
     // $('#addBookDialog').modal('show');
});
</script>
@endsection