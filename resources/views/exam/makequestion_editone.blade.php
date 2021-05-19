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
                  @foreach($questions as $question)
                  <form  method="post" action="{{route('makequestion.update', [$question->id])}}">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="put">
                    <input type="hidden" name="quiz_id" value="{{$question->quiz_id}}">
                      <div class="col-md-8 col-md-offset-2">
                     <table class="table col-lg-6">
                                    <tbody>
                                      <div class="form-group">
                                      <tr class="danger">
                                        <td><strong>Question : </strong></td>
                                        <td><input type="text" class="form-control" name="question" value="{{$question->question}}" required></td>
                                        
                                      </tr>
                  
                                      </div>  
                  
                                      <div class="form-group">    
                                      <tr class="bg-success">
                                        <td><strong>Choice1 : </strong></td>
                                        <td><input name="choice1" class="form-control"  value="{{$question->choice1}}" type="text" required></td>
                                      </tr>
                                    </div>
                  
                                    <div class="form-group">
                                      <tr class="danger">
                                        <td><strong>Choice2 : </strong></td>
                                        <td><input name="choice2" class="form-control" value="{{$question->choice2}}" type="text" required></td>
                                      </tr>
                                    </div>
                  
                                    <div class="form-group">
                                      <tr class="bg-success">
                                        <td><strong>Choice3 : </strong></td>
                                        <td><input name="choice3" class="form-control" value="{{$question->choice3}}" type="text" required></td>
                                      </tr>
                                    </div>
                  
                                    <div class="form-group">
                                      <tr class="danger">
                                        <td><strong>Choice4 : </strong></td>
                                        <td><input name="choice4" class="form-control" value="{{$question->choice4}}" type="text" required></td>
                                      </tr>
                                    </div>
                  
                                    <div class="form-group">
                                      <tr class="bg-success">
                                        <td><strong>Answer : </strong></td>
                                        <td><input name="answer" class="form-control" value="{{$question->answer}}" type="text" required></td>
                                      </tr>
                                    </div>
                                    </tbody>
                                  </table>
                                  <input type="submit" class="btn btn-success btn-block" name="update" value="update">
                              </div>
                           
                  </form>
                  @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@endsection