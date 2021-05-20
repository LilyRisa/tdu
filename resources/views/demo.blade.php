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


    </head>
    <body >
      <div id="my_camera"></div>
      <input type=button value="Take Snapshot" onClick="take_snapshot()">
      
        <div id="results"></div>
        
        <script>
      

  $(document).ready(function(){
    Webcam.set({
      width: 320,
      height: 240,
      image_format: 'jpeg',
      jpeg_quality: 90
    });
    Webcam.attach( '#my_camera' );
    
  });
  function take_snapshot() {
			
			// take snapshot and get image data
			Webcam.snap( function(data_uri) {
				// display results in page
				document.getElementById('results').innerHTML = 
					'<img src="'+data_uri+'"/>';
			} );
		}
    </script>
    </body>
</html>
