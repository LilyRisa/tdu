@extends('layout', ['page' => 'Exam'])

@section('content')
<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="header">
                    <h2> Tạo câu hỏi </h2>
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
                    <form method="post" action="{{route('examinfo.store')}}">
                        {{ csrf_field() }}
                    
                        <div class="col-md-6 col-lg-6 col-sm-6 col-lg-offset-3">
                          <div class="form-group">
                            <label class="col-form-label" for="formGroupExampleInput">Chọn nhân viên giao đề</label>
                            <select name="Teacher_id" class="form-control show-tick">
                              @foreach ($user as $us)
                                  <option value="{{$us->id}}">{{$us->fullname}}</option>
                              @endforeach
                            </select>
                          </div>
                          <div class="form-group">
                            <label class="col-form-label" for="formGroupExampleInput2">Tên bộ đề</label>
                            <input type="text" name="Course" class="form-control" id="formGroupExampleInput2" placeholder="Ví dụ: Giáo dục công dân" required>
                          </div>
                          <div class="form-group">
                            <label class="col-form-label" for="formGroupExampleInput2">Số câu hỏi</label>
                            <input type="text" name="question_lenth" class="form-control" id="formGroupExampleInput2" placeholder="Ví dụ: 10" required>
                          </div>
                          <div class="form-group">
                            <label class="col-form-label" for="formGroupExampleInput2">Đặt thời gian</label>
                            <input type="text" name="time" class="form-control" id="formGroupExampleInput2" placeholder="Nhập số phút" required>
                          </div>
                          <div class="form-group">
                            <input type="hidden" value="{{substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ", 5)), 0, 5)}}" name="uniqueid" class="form-control" id="formGroupExampleInput2">
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