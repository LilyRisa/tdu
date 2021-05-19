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
                    <div class="row">
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
                    
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover js-exportable dataTable">
                                <thead>
                                    <tr>
                                        <th>Người giao đề</th>
                                        <th>Tên môn thi</th>
                                        <th>Số câu hỏi</th>
                                        <th>Mã đề thi</th>  
                                        <th>thời gian làm bài (phút)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($exam as $item)
                                    <tr>
                                        {{-- <td class="namecv" data-id="{{$item->id}}" data-st="0">{{$item->id}}</td> --}}
                                        <td>
                                            {{$item->User->fullname}} - <span class="badge badge-info"><a href="{{route('profile.index', ['id' => $item->User->username])}}" target="_blank" style="color:white">17097</a><span></span></span>
                                        </td>
                                        <td>
                                            {{$item->Course}}
                                        </td>
                                        <td>
                                            {{$item->question_lenth}}
                                        </td>
                                        <td>
                                            <span class="badge badge-primary unique" style="cursor: pointer;">{{$item->uniqueid}}</span>
                                        </td>
                                        <td>
                                            {{$item->time}}
                                        </td>
                                    
                                    </tr>
                                @endforeach
                                 
                                </tbody>
                            </table>
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
    $(document).ready(function(){
        $('.unique').on('click', function(){
            var $temp = $("<input>");
            $("body").append($temp);
            var text = $(this);
            $temp.val($(text).html()).select();
            document.execCommand("copy");
            toastr.success('Copy thành công');
        });
    });
</script>
@endsection