@extends('layout', ['page' => 'profile-page'])

@section('content')
<div class="col-sm-12">
<div class="card overflowhidden m-t-20">
    <div class="profile-header" style="background-image: url({{asset('images/profilebg.jpg')}})">
        <div class="profile_info row">
            <div class="col-lg-3 col-md-4 col-12">
                <div class="profile-image float-md-right" id="upload" style="cursor: pointer;"> <img id="preimg" src="{{asset('storage')}}/{{$user->avatar}}" alt=""> </div>
                @if($user->username == Session::get('user_username'))
                    <input type="file" id="avatar" style="display:none">
                @endif
            </div>
            <div class="col-lg-6 col-md-8 col-12">
                <h4 class="m-t-5 m-b-0">{{$user->fullname}}</h4>
                <span class="job_post">@ {{$user->username}} - {{$user->email}}</span>
                {{-- <p>{{$user->description}}</p> --}}
                {{-- <div class="m-t-10">
                    <button class="btn btn-raised btn-default">Follow</button>
                    <button class="btn btn-raised btn-default">Message</button>
                </div> --}}
                {{-- <p class="social-icon m-t-20 m-b-0">
                    <a title="Twitter" href="javascript:void(0);"><i class="zmdi zmdi-twitter"></i></a>
                    <a title="Facebook" href="javascript:void(0);"><i class="zmdi zmdi-facebook"></i></a>
                    <a title="Google-plus" href="javascript:void(0);"><i class="zmdi zmdi-twitter"></i></a>
                    <a title="Behance" href="javascript:void(0);"><i class="zmdi zmdi-behance"></i></a>
                    <a title="Instagram" href="javascript:void(0);"><i class="zmdi zmdi-instagram "></i></a>
                </p> --}}
            </div>                
        </div>
    </div>
</div>
<div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="header">
                        <h2> Thông tin </h2>
                        <ul class="header-dropdown m-r--5">
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
                        <h2 class="card-inside-title">Thông tin chung</h2>
                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-12">
                                <div class="input-group"> <span class="input-group-addon">@</span>
                                    <div class="form-line">
                                        <input type="text" class="form-control date" value="{{$user->username}}" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-12">
                                <div class="input-group"> <span class="input-group-addon"> <i class="material-icons">mail</i> </span>
                                    <div class="form-line">
                                        <input type="text" class="form-control date" value="{{$user->email}}" disabled>
                                    </div>
                                     </div>
                            </div>
                            <div class="col-lg-3 col-md-12">
                                <div class="input-group"> <span class="input-group-addon"> <i class="material-icons">assignment</i> </span>
                                    <div class="form-line">
                                        <input type="text" class="form-control date" value="{{$user->start_contract}}" disabled>
                                    </div>
                                    {{-- <span class="input-group-addon"> <i class="material-icons">send</i> </span>  --}}
                                    </div>
                            </div>
                            <div class="col-lg-3 col-md-12">
                                <div class="input-group"> <span class="input-group-addon"> <i class="material-icons">verified_user</i> </span>
                                    <div class="form-line">
                                        {{-- <input type="text" class="form-control date" value="{{$user->start_contract}}" disabled> --}}
                                        <select class="form-control">
                                            @if($user->isAdmin == 0)
                                                <option>Người dùng</option>
                                            @else
                                                <option>Admin</option>
                                            @endif
                                        </select>
                                    </div>
                                    {{-- <span class="input-group-addon"> <i class="material-icons">send</i> </span>  --}}
                                    </div>
                            </div>
                            <div class="col-lg-3 col-md-12">
                                <div class="input-group"> <span class="input-group-addon"> <i class="material-icons">phone</i> </span>
                                    <div class="form-line">
                                        @if($user->username == Session::get('user_username'))
                                        <input type="text" class="form-control date" id="phone" value="{{$user->phone}}">
                                        @else
                                        <input type="text" class="form-control date" value="{{$user->phone}}" disabled>
                                        @endif
                                        
                                    </div>
                                    {{-- <span class="input-group-addon"> <i class="material-icons">send</i> </span>  --}}
                                    </div>
                            </div>
                        </div>
                        @if($user->username == Session::get('user_username'))
                        <h2 class="card-inside-title">Thông tin cập nhật</h2>
                        <div class="row clearfix">
                            <div class="col-sm-12"> 
                                    <label for="description">Mô tả</label>     
                                    <textarea id="ckeditor">
                                        {{$user->description}}
                                    </textarea>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-lg-12 col-md-12">
                                    <label for="description">Vị trí</label>  
                                    <div class="input-group">
                                    <span class="input-group-addon"> <i class="material-icons">place</i> </span>
                                        <div class="form-line">
                                            <input type="text" id="address" class="form-control date" value="{{$user->address}}" >
                                            
                                        </div>
                                        {{-- <span class="input-group-addon"> <i class="material-icons">send</i> </span>  --}}
                                        </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12">
                                <div class="input-group">
                                    <div class="form-line">
                                        <input type="submit" class="form-control" id="profile_submit" value="Cập nhật">
                                    </div>
                            </div>
                            {{-- <div class="col-lg-4 col-md-12">
                                <div class="input-group"> <span class="input-group-addon">$</span>
                                    <div class="form-line">
                                        <input type="text" class="form-control date">
                                    </div>
                                    <span class="input-group-addon">.00</span> </div>
                            </div> --}}
                        </div>
                        
                        @else
                        <div class="col-lg-4 col-md-12">
                                <div class="input-group"> <span class="input-group-addon"><i class="material-icons">place</i></span>
                                    <div class="form-line">
                                    <label for="">Vị trí</label>  
                                        <input type="text" class="form-control date" value="{{$user->address}}" disabled>
                                    </div>
                                    </div>
                            </div>
                            <div class="col-lg-4 col-md-12">
                                <div class="input-group"> <span class="input-group-addon"><i class="material-icons">person</i></span>
                                    <div class="form-line">
                                    <label for="">Mô tả</label>
                                        <p>{!!$user->description!!}</p> 
                                    </div>
                                    </div>
                            </div>
                        @endif
                        {{-- <h2 class="card-inside-title"> Different Sizes <small>You can use the <code>.input-group-sm, .input-group-lg</code> classes for sizing.</small> </h2> --}}
                        {{-- <div class="row clearfix">
                            <div class="col-lg-4 col-md-12">
                                <p> <b>Input Group Large</b> </p>
                                <div class="input-group input-group-lg"> <span class="input-group-addon"> <i class="material-icons">person</i> </span>
                                    <div class="form-line">
                                        <input type="text" class="form-control" placeholder="Username">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12">
                                <p> <b>Input Group Default</b> </p>
                                <div class="input-group">
                                    <div class="form-line">
                                        <input type="text" class="form-control" placeholder="Message">
                                    </div>
                                    <span class="input-group-addon"> <i class="material-icons">send</i> </span> </div>
                            </div>
                            <div class="col-lg-4 col-md-12">
                                <p> <b>Input Group Small</b> </p>
                                <div class="input-group input-group-sm"> <span class="input-group-addon"> <i class="material-icons">person</i> </span>
                                    <div class="form-line">
                                        <input type="text" class="form-control" placeholder="Recipient's username">
                                    </div>
                                    <span class="input-group-addon"> <i class="material-icons">send</i> </span> </div>
                            </div>
                        </div> --}}
                        {{-- <div class="row clearfix">
                            <div class="col-lg-4 col-md-12">
                                <div class="input-group input-group-lg"> <span class="input-group-addon">@</span>
                                    <div class="form-line">
                                        <input type="text" class="form-control" placeholder="Username">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12">
                                <div class="input-group">
                                    <div class="form-line">
                                        <input type="text" class="form-control" placeholder="Recipient's username">
                                    </div>
                                    <span class="input-group-addon">@example.com</span> </div>
                            </div>
                            <div class="col-lg-4 col-md-12">
                                <div class="input-group input-group-sm"> <span class="input-group-addon">$</span>
                                    <div class="form-line">
                                        <input type="text" class="form-control">
                                    </div>
                                    <span class="input-group-addon">.00</span> </div>
                            </div>
                        </div> --}}
                        {{-- <h2 class="card-inside-title">Radio & Checkbox</h2> --}}
                        {{-- <div class="row clearfix">
                            <div class="col-md-6">
                                <div class="input-group input-group-lg"> <span class="input-group-addon">
                                    <input type="checkbox" class="filled-in" id="ig_checkbox">
                                    <label for="ig_checkbox"></label>
                                    </span>
                                    <div class="form-line">
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group input-group-lg"> <span class="input-group-addon">
                                    <input type="radio" class="with-gap" id="ig_radio">
                                    <label for="ig_radio"></label>
                                    </span>
                                    <div class="form-line">
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
</div>
{{-- header --}}

@endsection

@section('script')
<script>
    $(document).ready(function(){
        $(document).keydown(function(event) {

            //19 for Mac Command+S
            if (!( String.fromCharCode(event.which).toLowerCase() == 's' && event.ctrlKey) && !(event.which == 19)) return true;
            $('#profile_submit').click();

            event.preventDefault();
            return false;
        });
        $('#profile_submit').on('click', function(){
            var data = {
                address: $('#address').val(),
                description: CKEDITOR.instances.ckeditor.getData(),
                phone: $('#phone').val()
            }
            console.log(data)
            $.ajax({
                url: "{{route('profile.update',['id' => $user->id])}}",
                type: 'post',
                data: {...data,"_token": "{{ csrf_token() }}",}
            })
            .done(res => {
                if(res.is){
                    toastr.success('update thành công');
                }else{
                    toastr.error('Lỗi');
                }
            })
            .fail(res => {
                toastr.error('Lỗi server');
            })
        });

        $('#upload').on('click', function(){
            $('#avatar').click();
        });
        $('#avatar').on('change', function(){
            var file = $(this)[0].files[0];
            if (file){
                var avatar = new AvatarImage(file);
                avatar.setSize(2000000);
                if(avatar.checkSize){
                    if(avatar.checktype){
                        avatar.Base64Encoder().then((imgbase64)=>{
                            $('#preimg').attr('src',imgbase64);
                            $.ajax({
                                url: '{{route('avatar')}}',
                                type: 'post',
                                data:{
                                    "_token": "{{ csrf_token() }}",
                                    avatar: imgbase64,
                                }
                            })
                            .done((res)=>{
                                if(res.is){
                                    toastr.success('upload thành công');
                                }else{
                                    toastr.error('Lỗi');
                                }
                            })
                            .fail(e => {
                                toastr.error('Lỗi hệ thống');
                            })
                        })

                    }else{
                        toastr.error('Định dạng không hợp lệ');
                    }
                }else{
                    toastr.error('Kích thước ảnh quá lớn');
                }
            }
        });
    });
    function AvatarImage(file){
		this.file = file;
	}
	AvatarImage.prototype.checktype = function(){
		var validImageTypes = ["image/gif", "image/jpeg", "image/png"];
		if ($.inArray(this.file.type, validImageTypes) < 0) {
		     return false;
		}else{
			return true;
		}
	}

	AvatarImage.prototype.setSize = function(size){ //byte
		this.validsize = size;
	}
	AvatarImage.prototype.checkSize = function(){
		if(this.file.size > this.validsize){
			return false;
		}else{
			return true;
		}
	}
	AvatarImage.prototype.Base64Encoder = function(){
		return new Promise((resolve, reject) => {
		    const reader = new FileReader();
		    reader.readAsDataURL(this.file);
		    reader.onload = () => resolve(reader.result);
		    reader.onerror = error => reject(error);
  		});
	}
</script>
@endsection