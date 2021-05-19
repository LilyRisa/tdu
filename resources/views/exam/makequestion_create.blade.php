@extends('layout', ['page' => 'Exam'])

@section('content')
<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="header">
                    <h2> Tạo câu hỏi Hệ thống sẽ chuyển hướng khi bạn setup đầy đủ </h2>
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
                    <form method="post" action="{{route('makequestion.store')}}">
                        {{ csrf_field() }}
                        
                            <div class="col-md-6 col-lg-6 col-sm-6 col-lg-offset-3">
                              <div class="form-group">
                                <label class="col-form-label" for="formGroupExampleInput">Câu hỏi</label>
                                <input type="text" name="question" class="form-control " id="formGroupExampleInput" required>
                              </div>
                              <div class="form-group">
                                <label class="col-form-label" for="formGroupExampleInput2">Tùy chọn 1</label>
                                <input type="text" name="option1" class="form-control" id="formGroupExampleInput2" required>
                              </div>
                              <div class="form-group">
                                <label class="col-form-label" for="formGroupExampleInput2">Tùy chọn 2</label>
                                <input type="text" name="option2" class="form-control" id="formGroupExampleInput2" required>
                              </div>
                              <div class="form-group">
                                <label class="col-form-label" for="formGroupExampleInput2">Tùy chọn 3</label>
                                <input type="text" name="option3" class="form-control" id="formGroupExampleInput2" required>
                              </div>
                              <div class="form-group">
                                <label class="col-form-label" for="formGroupExampleInput2">Tùy chọn 4</label>
                                <input type="text" name="option4" class="form-control" id="formGroupExampleInput2" required>
                              </div>
                              <div class="form-group">
                                <label class="col-form-label" for="formGroupExampleInput2">Câu trả lời</label>
                                <input type="text" name="answer" class="form-control" id="formGroupExampleInput2" required>
                              </div>
                              <div class="form-group">
                                <label class="col-form-label" for="formGroupExampleInput2">Quiz ID</label>
                                <input type="hidden" name="quizid" class="form-control" id="formGroupExampleInput2" value="{{$examinfo->id}}" readonly>
                              </div>
                              <button type="Submit" class="btn btn-success btn-block">Submit</button>
                            </div>
                    
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection