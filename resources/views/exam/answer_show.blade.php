@extends('layout', ['page' => 'Exam'])

@section('head')
<style>
    input[name="answer"] {
        position: relative !important;
        opacity: 1 !important;
        left: 0px !important;
        top: 22px;
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="header">
                    <h2> Câu hỏi ôn tập </h2>
                    {{-- <div class="clearfix">
                        <div class="col-sm-3">
                            <button class="btn btn-primary open-AddBookDialog" id="add_cv" data-toggle="modal" data-target="#exampleModal">Thêm bản ghi</button>
                        </div>
                    </div> --}}
                    <!-- Modal -->
                    
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
                    <div>
                        <nav class="col-lg-12 pull-right">
                          <div class="sidebar-nav-fixed affix">
                            <h1><b>Time <span id="timer" style="color: red">0.00</span></b></h1><br>
                          </div>
                        </nav>
                        <h1 class="col-lg-offset-12" style="color: red;"><span style="background-color:seagreen;color: white;border-radius: 5px"><b>  Kiểm tra bài: {{$course}}  </b></span></h1>
                        <div class="col-md-12 col-lg-12 col-sm-6 col-lg-offset-3" style="background-color: white">
                            
                        @foreach($questions as $question)
                                <form method="post" action="{{route('answer.store')}}" class="ansform">
                                    {{ csrf_field() }}
                
                                    <h3>{{$question->question}} ?</h3>
                                    <div class="col-lg-offset-1">
                                        <input type="hidden" name="question" value="{{$question->question}}">
                                        <input type="hidden" name="student_id" value="{{$student_id}}">
                                        <input type="hidden" name="true_answer" value="{{$question->answer}}">
                                        <input name="answer" value="{{$question->choice1}}" type="radio" class="form-control"> {{$question->choice1}} <br>
                                        <input name="answer" value="{{$question->choice2}}" type="radio" class="form-control">{{$question->choice2}}<br>
                                        <input name="answer" value="{{$question->choice3}}" type="radio" class="form-control">{{$question->choice3}}<br>
                                        <input name="answer" value="{{$question->choice4}}" type="radio" class="form-control">{{$question->choice4}}<br>
                                        <input type="submit" name="submit" value="submit" class="btn btn-primary" id="submitbtn">
                                    </div>
                                 </form>
                         @endforeach
                
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
    var timeoutHandle;
    function countdown(minutes) {
        var seconds = 60;
        var mins = minutes
        function tick() {
            var counter = document.getElementById("timer");
            var current_minutes = mins-1
            seconds--;
            counter.innerHTML =
            current_minutes.toString() + ":" + (seconds < 10 ? "0" : "") + String(seconds);
            if( seconds > 0 ) {
                timeoutHandle=setTimeout(tick, 1000);
            } else {
                if(mins > 1){
                   // countdown(mins-1);   never reach “00″ issue solved:Contributed by Victor Streithorst
                   setTimeout(function () { countdown(mins - 1); }, 1000);
                }
            }
        }
        tick();
    }
    countdown('{{$time}}');
    var time= '{{$time}}';
    var realtime = time*60000;
    setTimeout(function () {
        alert('Hết thời gian');
        window.location.href= '{{route("student.index")}}';},
   realtime);
$(document).ready(function(){
   $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
    $('.ansform').on('submit',function(e){
        var form = $(this);
        var submit = form.find("[type=submit]");
        var submitOriginalText = submit.attr("value");
        e.preventDefault();
        var data = form.serialize();
        var url = form.attr('action');
        var post = form.attr('method');
        $.ajax({
            type : post,
            url : url,
            data :data,
            success:function(data){
                submit.attr("value", "Submitted");
            },
            beforeSend: function(){
                submit.attr("value", "Loading...");
                submit.prop("disabled", true);
            },
            error: function() {
                submit.attr("value", submitOriginalText);
                submit.prop("disabled", false);
                // show error to end user
            }
        })
    })
});

</script>
@endsection
