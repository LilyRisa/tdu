@extends('layout', ['page' => 'Exam'])

@section('content')
<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="header">
                    <h2> Thi trực tuyến </h2>
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
                    <form method="post" action="{{route('student.store')}}">
                        {{ csrf_field() }}
                    
                        <div class="col-md-6 col-lg-6 col-sm-6 col-lg-offset-3">
                          <div class="form-group">
                            <label class="col-form-label" for="formGroupExampleInput">Student ID</label>
                            <input type="text" name="student_id" class="form-control " id="formGroupExampleInput" placeholder="E.g. 11122333" required>
                          </div>
                          <div class="form-group">
                            <label class="col-form-label" for="formGroupExampleInput2">Exam Code</label>
                            <input type="text" name="exam_code" class="form-control" id="formGroupExampleInput2" placeholder="E.g. A6xgP" required>
                          </div>
                          <button type="Submit" class="btn btn-success btn-block">Submit</button><br><br>
                          <h4 style="color: red">**Vui lòng để ý thời gian, nếu quá hạn bài thi của bạn sẽ không được tính.</h4>
                        </div>
                    
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection