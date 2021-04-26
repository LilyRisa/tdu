@extends('layout', ['page'=>'contact'])

@section('content')
<div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                {{-- <div class="card action_bar m-t-15">
                    <div class="row">
                        <div class="col-lg-1 col-md-1 col-3">
                            <div class="checkbox m-t-20 m-l-15">
                                <input type="checkbox" id="basic_checkbox_0">
                                <label for="basic_checkbox_0"></label>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 hidden-sm-down">
                            <div class="input-group m-t-10">
                                <span class="input-group-addon">
                                    <i class="zmdi zmdi-search"></i>
                                </span>
                                <div class="form-line">
                                    <input type="text" class="form-control" placeholder="Search...">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-5 col-9 text-right d-flex justify-content-end align-items-center">
                            <div class="btn-group hidden-sm-down" role="group">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default dropdown-toggle text-muted" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="zmdi zmdi-label"></i>
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="javascript:void(0);">Family</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);">Work</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);">Google</a>
                                        </li>
                                        <li role="separator" class="divider"></li>
                                        <li>
                                            <a href="javascript:void(0);">Create a Label</a>
                                        </li>
                                    </ul>
                                </div>                            
                            </div>
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-default waves-effect col-cyan">
                                    <i class="zmdi zmdi-plus-circle"></i>
                                </button>
                                <button type="button" class="btn btn-default waves-effect col-green">
                                    <i class="zmdi zmdi-archive"></i>
                                </button>
                                <button type="button" class="btn btn-default waves-effect col-amber">
                                    <i class="zmdi zmdi-star"></i>
                                </button>
                                <button type="button" class="btn btn-default waves-effect col-red">
                                    <i class="zmdi zmdi-delete"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <ul class="list-unstyled">
                    @foreach($user as $user_item)
                    <li class="c_list">
                        <div class="row">
                            <div class="col-lg-5 col-md-5 col-10">
                                <div class="control">
                                    <div class="checkbox">
                                        <label>
                                            <input name="optionsCheckboxes" type="checkbox">
                                            <span class="checkbox-material">
                                                <span class="check"></span>
                                            </span>
                                        </label>
                                    </div>
                                    
                                </div>
                                <div class="avatar">
                                    <img src="{{asset('storage')}}/{{$user_item->avatar}}" class="rounded-circle" alt="">
                                </div>
                                <div class="u_name">
                                    <h5 class="c_name">{{$user_item->fullname}}<span class="badge badge-warning bg-blue hidden-sm-down">{{$user_item->username}}</span></h5>
                                    <h6 class="phone"><i class="zmdi zmdi-phone"></i><span>{{$user_item->phone}}</span></h6>
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-6 col-12 hidden-sm-down">
                                <span class="email"><a href="mailto:{{$user_item->fullname}}" title=""><i class="zmdi zmdi-email"></i> {{$user_item->email}}</a></span>
                                <address><i class="zmdi zmdi-pin"></i>{{$user_item->address}}</address>
                            </div>
                            <div class="col-lg-2 col-md-1 col-2">
                                <ul class="header-dropdown list-unstyled">
                                    <li class="dropdown"><a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more-vert"></i> </a>
                                        <ul class="dropdown-menu">
                                            <li><a href="javascript:void(0);">Send sms</a></li>
                                            <li><a href="javascript:void(0);">Delete</a></li>                                        
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="action_btn">                        
                            <a href="{{route('profile.index', ['id' => $user_item->username])}}" class="btn btn-default col-green"><i class="material-icons">visibility</i></a>
                        </div>
                    </li>
                   @endforeach
                    
                </ul>
                <ul class="pagination">
                    <li class="page-item"><a class="page-link" href="javascript:void(0);">Previous</a></li>
                    <li class="page-item active"><a class="page-link" href="javascript:void(0);">1</a></li>
                    <li class="page-item"><a class="page-link" href="javascript:void(0);">2</a></li>
                    <li class="page-item"><a class="page-link" href="javascript:void(0);">3</a></li>
                    <li class="page-item"><a class="page-link" href="javascript:void(0);">Next</a></li>
                </ul>
            </div>
        </div>
    </div>
@endsection