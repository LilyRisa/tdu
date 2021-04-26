@extends('layout', ['page' => 'chức vụ'])

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
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
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
                                        <td>{{$item->name}}</td>
                                        <td><span class="badge badge-light">{{$item->chucvu->name}}</span></td>
                                        <td>{{$item->icon}}</td>
                                        <td><span class="badge badge-success" style="cursor: pointer;">Sửa</span> <span class="badge badge-danger" style="cursor: pointer;">Xóa</span></td>
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
})
</script>
@endsection