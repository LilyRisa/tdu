@extends('layout', ['page' => 'Nhận diện khuôn mặt'])
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
                        <h2>Thêm khuôn mặt</h2>
                        <p><span style="color: red">*</span> Hệ thống nhận diện khuôn mặt vẫn chưa có dữ liệu của bạn</p><br/>
                        <p><span style="color: red">*</span> Dữ liệu của bạn được bảo mật trong hệ thống của chúng tôi không ai có quyền truy cập ngay cả thành viên cấp bậc admin</p>
                        <div class="row">
                            <div class="col col-md-6">
                                {{$user->fullname}} - <span class="badge badge-warning bg-blue hidden-sm-down">{{$user->username}}</span>
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
                    
                        <div class="row">
                            <div class="col col-md-12">
                                <h2 class="font-weight-light text-center text-lg-left mt-4 mb-0">Thu thập thêm dữ liệu</h2>
                                <hr class="mt-2 mb-5">
                                <p><span style="color: red">*</span> <i>Dữ liệu khuôn mặt càng nhiều độ chính xác khi nhận diện càng cao</i></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col col-md-4">
                                <div id="camera_face"></div>
                            </div>
                            <div class="col col-md-2"></div>
                            <div class="col col-md-4">
                                <div id="result_face"></div>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 10px">
                            <div class="col col-md-4">
                                <button class="btn btn-primary" id="take">Chụp ảnh</button>
                            </div>
                            <div class="col col-md-2"></div>
                            <div class="col col-md-4">
                                <button class="btn btn-success" style="display: none" id="upload_to_cloud">Upload to cloud</button>
                            </div>
                        </div>
                            
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


    $('#upload_to_cloud').on('click', function(e){
        e.preventDefault();
        var data_image = $('#avatar_lo').attr('src');
        $.ajax({
            url: '{{route("face.postper")}}',
            type: 'post',
            data:{
                "_token": "{{ csrf_token() }}",
                avatar: data_image,
            }
        })
        .done((res)=>{
            if(res.is){  
                toastr.success('upload thành công');
                setTimeout(()=>{location.reload()}, 1000);
            }else{
                toastr.error('Lỗi');
            }
        })
        .fail(e => {
            toastr.error('Lỗi hệ thống');
        })
    })

    $('#take').on('click', function(){
        Webcam.snap( function(data_uri) {
            $('#result_face').html(`<img class="img-responsive" id="avatar_lo" src="${data_uri}" />`);
            $('#upload_to_cloud').fadeIn(1000).show();
            $('#detect_face').fadeIn(1000).show();
        })
    });
    

    Webcam.set({
        width: 320,
        height: 240,
        image_format: 'jpeg',
        jpeg_quality: 90
    });
    Webcam.attach( '#camera_face' );


    
})
</script>
@endsection