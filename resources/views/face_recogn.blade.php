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
                        <h2>Dữ liệu khuôn mặt</h2>
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
                        <h1 class="font-weight-light text-center text-lg-left mt-4 mb-0">Danh sách dữ liệu</h1>
                        <hr class="mt-2 mb-5">
                        <div class="row text-center text-lg-left" style="height: 208px;overflow: auto;" id="data_cloud">
                            @foreach ($face['face'] as $ff)
                            <div class="col-lg-3 col-md-3 col-6">
                                <a href="#" class="d-block mb-4 h-100">
                                      <img class="img-fluid img-thumbnail" src="{{$ff['url']}}" alt="">
                                    </a>
                              </div>
                            @endforeach
                            
                        </div>
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
                                <button class="btn btn-warning" id="detect_face" style="display: none">Nhận diện khuôn mặt để kiểm tra</button>
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

    $('#detect_face').on('click', function(e){
        $.ajax({
            url: '{{route("face.detect")}}',
            type: 'post',
            data:{
                "_token": "{{ csrf_token() }}",
                avatar: $('#avatar_lo').attr('src'),
            }
        })
        .done(res => {
            if(res.is){
            swal({
                title: "Nhận diện thành công",
                text: "Họ và tên: "+res.messenge.fullname+"\nUsername: "+res.messenge.username+"\nEmail: "+res.messenge.email,
                icon: "success",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
            })
            
            }else{
                toastr.error(res.messenge)
            }
        })
    })

    $('#upload_to_cloud').on('click', function(e){
        e.preventDefault();
        var data_image = $('#avatar_lo').attr('src');
        $.ajax({
            url: '{{route("face.post")}}',
            type: 'post',
            data:{
                "_token": "{{ csrf_token() }}",
                avatar: data_image,
            }
        })
        .done((res)=>{
            if(res.is){
                let tmp = `<div class="col-lg-3 col-md-3 col-6">
                                <a href="#" class="d-block mb-4 h-100">
                                      <img class="img-fluid img-thumbnail" src="${res.source.url}" alt="">
                                    </a>
                              </div>`;
                $('#data_cloud').append(tmp);    
                toastr.success('upload thành công');
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