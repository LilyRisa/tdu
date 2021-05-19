@extends('layout', ['page' => 'Exam'])

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
                  <div class="col-md-6 col-lg-6 col-sm-6 col-lg-offset-4" style="width:550px;font-weight:bold;">
                    <h2 style="color: green">Bộ câu hỏi đã hoàn thành. Vui lòng ghi nhớ mã bộ câu hỏi dưới đây</h2>
                     <!-- Trigger the modal with a button -->
                     <h2>Vui lòng ghi nhớ mã dự thi bộ môn này : <span style="color: red;font-size: 40px; font-weight: bold;">{{$uniqueid}}</span></h2>
                     <a href="{{route('index')}}"><button type="button" class="btn btn-info btn-lg btn-block"> Back To Home </button></a><br>
                     <form action="/makequestion/{{$uniqueid}}/edit" method="get">
                       {{ csrf_field() }}
                       <input type="hidden" name="uniqueid" value="{{$uniqueid}}">
                       <button type="submit" class="btn btn-info btn-lg btn-block">Review Questions</button>
                     </form>
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection