<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>login</title>

        <!-- Fonts -->
        <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
        <script src="{{asset('js/jquery-3.6.0.min.js')}}"></script>
        <script src="{{asset('js/bootstrap.min.js')}}"></script>
        <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('css/bootstrap-datepicker3.css')}}">
        <script src="{{asset('js/bootstrap-datepicker.js')}}"></script>
        <link rel="stylesheet" href="{{asset('css/toastr.min.css')}}">
        <script src="{{asset('js/toastr.min.js')}}"></script>
        <script src="{{asset('js/webcamjs/webcam.min.js')}}"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

        <style>

/* BASIC */

html {
  background-color: #56baed;
}

body {
  font-family: "Poppins", sans-serif;
  height: 100vh;
}

a {
  color: #92badd;
  display:inline-block;
  text-decoration: none;
  font-weight: 400;
}

h2 {
  text-align: center;
  font-size: 16px;
  font-weight: 600;
  text-transform: uppercase;
  display:inline-block;
  margin: 40px 8px 10px 8px; 
  color: #cccccc;
}



/* STRUCTURE */

.wrapper {
  display: flex;
  align-items: center;
  flex-direction: column; 
  justify-content: center;
  width: 100%;
  min-height: 100%;
  padding: 20px;
}

#formContent {
  -webkit-border-radius: 10px 10px 10px 10px;
  border-radius: 10px 10px 10px 10px;
  background: #fff;
  padding: 30px;
  width: 90%;
  max-width: 450px;
  position: relative;
  padding: 0px;
  -webkit-box-shadow: 0 30px 60px 0 rgba(0,0,0,0.3);
  box-shadow: 0 30px 60px 0 rgba(0,0,0,0.3);
  text-align: center;
}
#formReg{
    -webkit-border-radius: 10px 10px 10px 10px;
  border-radius: 10px 10px 10px 10px;
  background: #fff;
  padding: 30px;
  width: 90%;
  max-width: 450px;
  position: relative;
  padding: 0px;
  -webkit-box-shadow: 0 30px 60px 0 rgba(0,0,0,0.3);
  box-shadow: 0 30px 60px 0 rgba(0,0,0,0.3);
  text-align: center;
}
#facelogin{
    -webkit-border-radius: 10px 10px 10px 10px;
  border-radius: 10px 10px 10px 10px;
  background: #fff;
  padding: 30px;
  width: 90%;
  max-width: 450px;
  position: relative;
  padding: 0px;
  -webkit-box-shadow: 0 30px 60px 0 rgba(0,0,0,0.3);
  box-shadow: 0 30px 60px 0 rgba(0,0,0,0.3);
  text-align: center;
}

#formFooter {
  background-color: #f6f6f6;
  border-top: 1px solid #dce8f1;
  padding: 25px;
  text-align: center;
  -webkit-border-radius: 0 0 10px 10px;
  border-radius: 0 0 10px 10px;
}



/* TABS */

h2.inactive {
  color: #cccccc;
}

h2.active {
  color: #0d0d0d;
  border-bottom: 2px solid #5fbae9;
}



/* FORM TYPOGRAPHY*/

input[type=button], input[type=submit], input[type=reset]  {
  background-color: #56baed;
  border: none;
  color: white;
  padding: 15px 80px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  text-transform: uppercase;
  font-size: 13px;
  -webkit-box-shadow: 0 10px 30px 0 rgba(95,186,233,0.4);
  box-shadow: 0 10px 30px 0 rgba(95,186,233,0.4);
  -webkit-border-radius: 5px 5px 5px 5px;
  border-radius: 5px 5px 5px 5px;
  margin: 5px 20px 40px 20px;
  -webkit-transition: all 0.3s ease-in-out;
  -moz-transition: all 0.3s ease-in-out;
  -ms-transition: all 0.3s ease-in-out;
  -o-transition: all 0.3s ease-in-out;
  transition: all 0.3s ease-in-out;
}

input[type=button]:hover, input[type=submit]:hover, input[type=reset]:hover  {
  background-color: #39ace7;
}

input[type=button]:active, input[type=submit]:active, input[type=reset]:active  {
  -moz-transform: scale(0.95);
  -webkit-transform: scale(0.95);
  -o-transform: scale(0.95);
  -ms-transform: scale(0.95);
  transform: scale(0.95);
}

input[type=text], input[type=password] {
  background-color: #f6f6f6;
  border: none;
  color: #0d0d0d;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 5px;
  width: 85%;
  border: 2px solid #f6f6f6;
  -webkit-transition: all 0.5s ease-in-out;
  -moz-transition: all 0.5s ease-in-out;
  -ms-transition: all 0.5s ease-in-out;
  -o-transition: all 0.5s ease-in-out;
  transition: all 0.5s ease-in-out;
  -webkit-border-radius: 5px 5px 5px 5px;
  border-radius: 5px 5px 5px 5px;
}

input[type=text]:focus {
  background-color: #fff;
  border-bottom: 2px solid #5fbae9;
}

input[type=text]:placeholder {
  color: #cccccc;
}



/* ANIMATIONS */

/* Simple CSS3 Fade-in-down Animation */
.fadeInDown {
  -webkit-animation-name: fadeInDown;
  animation-name: fadeInDown;
  -webkit-animation-duration: 1s;
  animation-duration: 1s;
  -webkit-animation-fill-mode: both;
  animation-fill-mode: both;
}

@-webkit-keyframes fadeInDown {
  0% {
    opacity: 0;
    -webkit-transform: translate3d(0, -100%, 0);
    transform: translate3d(0, -100%, 0);
  }
  100% {
    opacity: 1;
    -webkit-transform: none;
    transform: none;
  }
}

@keyframes fadeInDown {
  0% {
    opacity: 0;
    -webkit-transform: translate3d(0, -100%, 0);
    transform: translate3d(0, -100%, 0);
  }
  100% {
    opacity: 1;
    -webkit-transform: none;
    transform: none;
  }
}

/* Simple CSS3 Fade-in Animation */
@-webkit-keyframes fadeIn { from { opacity:0; } to { opacity:1; } }
@-moz-keyframes fadeIn { from { opacity:0; } to { opacity:1; } }
@keyframes fadeIn { from { opacity:0; } to { opacity:1; } }

.fadeIn {
  opacity:0;
  -webkit-animation:fadeIn ease-in 1;
  -moz-animation:fadeIn ease-in 1;
  animation:fadeIn ease-in 1;

  -webkit-animation-fill-mode:forwards;
  -moz-animation-fill-mode:forwards;
  animation-fill-mode:forwards;

  -webkit-animation-duration:1s;
  -moz-animation-duration:1s;
  animation-duration:1s;
}

.fadeIn.first {
  -webkit-animation-delay: 0.4s;
  -moz-animation-delay: 0.4s;
  animation-delay: 0.4s;
}

.fadeIn.second {
  -webkit-animation-delay: 0.6s;
  -moz-animation-delay: 0.6s;
  animation-delay: 0.6s;
}

.fadeIn.third {
  -webkit-animation-delay: 0.8s;
  -moz-animation-delay: 0.8s;
  animation-delay: 0.8s;
}

.fadeIn.fourth {
  -webkit-animation-delay: 1s;
  -moz-animation-delay: 1s;
  animation-delay: 1s;
}

/* Simple CSS3 Fade-in Animation */
.underlineHover:after {
  display: block;
  left: 0;
  bottom: -10px;
  width: 0;
  height: 2px;
  background-color: #56baed;
  content: "";
  transition: width 0.2s;
}

.underlineHover:hover {
  color: #0d0d0d;
}

.underlineHover:hover:after{
  width: 100%;
}



/* OTHERS */

*:focus {
    outline: none;
} 

#icon {
  width:60%;
}

        </style>
    </head>
    <body>
     <div class="wrapper fadeInDown">
        <div id="formContent">
            <!-- Tabs Titles -->

            <!-- Icon -->
            <div class="fadeIn first">
            <img src="https://quantri.thanhdo.edu.vn/upload/thanhdo/images/logo-daihocthanhdo(1).jpg" id="icon" alt="User Icon" />
            </div>

            <!-- Login Form -->
            <form>
            <input type="text" id="username" class="fadeIn second" name="login" placeholder="Username">
            <input type="password" id="password" class="fadeIn third" name="login" placeholder="Password">
            <input type="submit" class="fadeIn fourth" id="submit_login" value="Log In">
            </form>

            <!-- Remind Passowrd -->
            <div id="formFooter">
            <a class="underlineHover" id="reg" href="#">Đăng kí tài khoản</a><br/>
            <a class="underlineHover" id="facelog" href="#">Đăng nhập bằng khuôn mặt</a>

            </div>

        </div>
        <div id="formReg" style="display:none">
            <!-- Tabs Titles -->

            <!-- Icon -->
            <div class="fadeIn first">
            <img src="https://quantri.thanhdo.edu.vn/upload/thanhdo/images/logo-daihocthanhdo(1).jpg" id="icon" alt="User Icon" />
            </div>

            <!-- Login Form -->
            <form>
                <input type="text" id="reg_username" class="fadeIn second" name="login" disabled placeholder="Username">
                <input type="button" id="get_username" class="fadeIn second" name="login" value="Get username" style="background-color: #56dfed;">
                <input type="text" id="reg_fullname" class="fadeIn second" name="login" placeholder="Fullname">
                <input type="text" id="reg_email" class="fadeIn second" name="login" placeholder="email">
                <input type="text" id="reg_contract" class="fadeIn second" name="login" placeholder="Start contract">
                <input type="password" id="reg_password" class="fadeIn third" name="login" placeholder="Password">
                <input type="password" id="reg_re_password" class="fadeIn third" name="login" placeholder="re-Password">
                <input type="submit" class="fadeIn fourth" id="submit_reg" value="register">
            </form>

            <!-- Remind Passowrd -->
            <div id="formFooter">
            <a class="underlineHover" id="log" href="#">login</a>
            </div>

        </div>
        <div id="facelogin" style="display:none">
          <div class="fadeIn first">
            <img src="https://quantri.thanhdo.edu.vn/upload/thanhdo/images/logo-daihocthanhdo(1).jpg" id="icon" alt="User Icon" />
            </div>
              <div class="row">
                <div class="col col-md-12" id="my_camera" style="overflow: ">
                </div>
                <hr>
                <div class="col col-md-6" id="results" style="margin: 10px 0px">
                </div>
              </div>
              <div class="row">
                <div class="col col-md-3"></div>
                <div class="col col-md-3"><button class="btn btn-warning" id="takephoto">Chụp ảnh</button></div>
                <div class="col col-md-3"><button class="btn btn-primary" id="login_ok">Đăng nhập</button></div>
                <div class="col col-md-3"></div>
                
              </div>
            
        </div>
    </div>
    <script>
        $(document).ready(function(){

          $('#login_ok').on('click', function(){
            if (typeof $('#avatar_lo').attr('src') === 'undefined'){
              toastr.error('Hãy chụp ảnh')
            }else{
              $.ajax({
                url: '{{route("loginpostface")}}',
                type: 'post',
                data:{
                    "_token": "{{ csrf_token() }}",
                    avatar: $('#avatar_lo').attr('src'),
                }
            })
            .done(res => {
              if(res.is){
                toastr.success('Đăng nhập thành công');
                swal({
                    title: "Nhận diện thành công",
                    text: "Họ và tên: "+res.messenge.fullname+"\nUsername: "+res.messenge.username+"\nEmail: "+res.messenge.email,
                    icon: "success",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                  setTimeout(()=>{location.reload();},3000);
                })
                
              }else{
                toastr.error(res.messenge)
              }
            })
            }
              
          });

          $('#takephoto').on('click', function(e){
            e.preventDefault();
            Webcam.snap( function(data_uri) {
              $('#results').html(`<img class="img-responsive" id="avatar_lo" src="${data_uri}" />`)
            })
          });
          Webcam.set({
            width: 320,
            height: 240,
            image_format: 'jpeg',
            jpeg_quality: 90
          });
          Webcam.attach( '#my_camera' );

            $('#reg_contract').datepicker({
                format:'mm/dd/yyyy',
            });
            $('#reg').on('click', function(e){
                e.preventDefault();
                $('#formContent').fadeIn(2000).hide();
                $('#formReg').fadeOut(2000).show();
                $('#facelogin').fadeIn(2000).hide();

            });
            $('#log').on('click', function(e){
                e.preventDefault();
                $('#formReg').fadeOut(2000).hide();
                $('#facelogin').fadeIn(2000).hide();
                $('#formContent').fadeIn(2000).show();
            });
            $('#facelog').on('click', function(e){
                e.preventDefault();
                $('#formReg').fadeOut(2000).hide();
                $('#formContent').fadeIn(2000).hide();
                $('#facelogin').fadeIn(2000).show();
            });

            $('#get_username').on('click', function(e){
                e.preventDefault();
                $.ajax({
                    url: '{{route("generation")}}',
                })
                .done(res => {
                    $('#reg_username').val(res.barcode);
                    $('#get_username').prop('disabled', true);
                })
                .fail(e => {
                    toastr.error('error')
                })
            });
            $('#submit_reg').on('click',function(e){
              e.preventDefault();
              if($('#reg_username').val() != '' && $('#reg_fullname').val() != '' && $('#reg_email').val() != '' && $('#reg_contract').val() != '' && $('#reg_password').val() != '' && $('#reg_re_password').val() != ''){
                if($('#reg_password').val() == $('#reg_re_password').val()){
                  var datafn = {
                    username : $('#reg_username').val(),
                    fullname: $('#reg_fullname').val(),
                    email: $('#reg_email').val(),
                    password: $('#reg_password').val(),
                    start_contract: $('#reg_contract').val()
                  };
                  submitReg(datafn);
                }else{
                  toastr.error('Mật khẩu không khớp')
                }
              }else{
                toastr.error('Kiểm tra trường dữ liệu bắt buộc')
              }
              
            })
            $('#submit_login').on('click',function(e){
              e.preventDefault();
              if($('#username').val() != '' && $('#password').val() != ''){
                  var datafn = {
                    username : $('#username').val(),
                    password: $('#password').val(),
                  };
                  submitlogin(datafn);
              }else{
                toastr.error('Kiểm tra trường dữ liệu bắt buộc')
              }
              
            })

            function submitReg(data){
                var data = {...data, _token: '{{csrf_token()}}'}
                $.ajax({
                    url: "{{route('register')}}",
                    type: 'post',
                    data: data
                })
                .done(res => {
                    if(res.is){
                      toastr.success('Đăng kí thành công');
                      setTimeout(()=>{location.reload();},3000);
                    }else{
                      toastr.error('Lỗi hệ thống')
                    }
                })
                .fail(e=>{
                  toastr.error('error')
                })
            }
            function submitlogin(data){
                var data = {...data, _token: '{{csrf_token()}}'}
                $.ajax({
                    url: "{{route('loginpost')}}",
                    type: 'post',
                    data: data
                })
                .done(res => {
                    if(res.is){
                      toastr.success('Đăng nhập thành công');
                      setTimeout(()=>{location.reload();},3000);
                    }else{
                      toastr.error('Lỗi hệ thống')
                    }
                })
                .fail(e=>{
                  toastr.error('error');
                })
            }
    
            
        });
  
    </script>
    </body>
</html>
