@extends('layout', ['page' => 'Exam'])

@section('content')
<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="header">
                    <h2> Kết quả bài thi </h2>
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
                        <div class="col-lg-offset-12">
                            <h2>Id : {{$studentId}}</h2>
                            <h2>Tên môn thi : <a href="{{route('student.index')}}">{{$course}}</a></h2>
                            <h3 >Tổng điểm của bạn : <b><span style="color: green">{{$getScore}}</span></b></h3>
                        </div><hr>
                                
                            @foreach($answeredQuestion as $answerQ)
                                <div class="col-md-12 col-lg-12 col-sm-6 col-lg-offset-12">
                                    <h3><span style="color: red">Câu hỏi : </span> {{$answerQ->question}} ?</h3>
                                    <div class="col-lg-offset-12">  
                                        <div class="form-group">
                                            <p type="text" name="given_answer">Câu trả lời của bạn : <b>{{$answerQ->given_answer}}</b></p>
                                        </div>
                                         <div class="form-group">
                                            <p type="text" name="true_answer"><span style="color: #03cc2e">Câu trả lời đúng : <b>{{$answerQ->true_answer}}</b></span></p>
                                        </div>
                    
                                    </div>
                                </div>
                             @endforeach
                    
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection