@extends('layout', ['page' => 'Phụ cấp thân nhân'])
@section('head')
<style>
    .edittext, .edittext:focus{
        background: #ffffff00;
        border: none;
    }
</style>
@endsection


@section('content')
   <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="header">
                        <h2> Bảng phụ cấp thân nhân </h2>
                        <div class="clearfix">
                            <div class="col-sm-3">
                                <button class="btn btn-primary open-AddBookDialog" id="add_cv" data-toggle="modal" data-target="#exampleModal">Thêm bản ghi</button>
                            </div>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Thêm bản ghi</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form>
                                        <div class="form-group">
                                        <div class="form-line">
                                            <label>Chọn chức vụ: </label>
                                            <select id="chucvu_id" class="show-tick" style="margin-left: 10px">
                                                @foreach ($chucvu as $cvv)
                                                    <option value="{{$cvv->id}}">{{$cvv->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-line">
                                            <label>Chọn phòng ban: </label>
                                            <select id="phongban_id" class="show-tick" style="margin-left: 10px">
                                               
                                            </select>
                                        </div>
                                        <div class="form-line">
                                            <label>Mức lương phụ cấp</label>
                                            <select id="type_salary" class="show-tick">
                                                <option value="percent">Phần trăm (%-Lương cứng)</option>
                                                <option value="number" selected>Mức cố định</option>
                                            </select>
                                            <input type="number" min="0.1"class="form-control date" id="salaries" value="" style="display: inline; width: 70%">
                                            <span id="type_curren">VND</span>
                                        </div>
                                        <div class="form-line">
                                            <label>Khoảng thời gian</label>
                                            <input type="text" name="daterange" id="date_range" class="form-control"/>
                                        </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" id="submit_cv">Save changes</button>
                                </div>
                                </div>
                            </div>
                            
                        </div>
                        
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
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover js-exportable dataTable">
                                <thead>
                                    <tr>
                                        <th>Chức vụ</th>
                                        <th>Phòng ban</th>
                                        <th>Mức phụ cấp lương <span style="color: red">*</span></th>
                                        <th>Loại phụ cấp</th>  
                                        <th>Khoảng thời gian</th>
                                                                             
                                        <th width="20%">Operation</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($phucap as $item)
                                    <tr>
                                        {{-- <td class="namecv" data-id="{{$item->id}}" data-st="0">{{$item->id}}</td> --}}
                                        <td data-id="{{$item->id}}" data-st="0">
                                            {{$item->chucvu->name}}
                                        </td>
                                        <td data-id="{{$item->id}}" data-st="0">
                                            {{$item->phongban->name}}
                                        </td>
                                        @if($item->precent_salary) 
                                            <td>{{$item->salary}}%</td> 
                                        @else   
                                            <td class="currency">{{$item->salary}}</td> 
                                        @endif
                                        <td>{{$item->precent_salary ? '% (lương cứng)' : 'cộng trực tiếp'}}</td>
                                        <td>{{$item->time_start}} to {{$item->time_end}}</td>
                                        
                                        <td>
                                            <span title="Việc xóa lương nhân viên sẽ ảnh hưởng đến phần tính lương cho nhân viên" class="badge badge-danger delete" style="cursor: pointer" data-id="{{$item->id}}">Xóa</span>
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
        
@endsection

@section('script')
<script src="{{asset('bundles/datatablescripts.bundle.js')}}"></script>
<script src="{{asset('plugins/jquery-datatable/buttons/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('plugins/jquery-datatable/buttons/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/jquery-datatable/buttons/buttons.colVis.min.js')}}"></script>
<script src="{{asset('plugins/jquery-datatable/buttons/buttons.flash.min.js')}}"></script>
<script src="{{asset('plugins/jquery-datatable/buttons/buttons.html5.min.js')}}"></script>
<script src="{{asset('plugins/jquery-datatable/buttons/buttons.print.min.js')}}"></script>
<script src="{{asset('js/pages/tables/jquery-datatable.js')}}"></script>
<script>
$(document).ready(function(){
    //date ranger
    $('input[name="daterange"]').daterangepicker();
    //select type salary
    $('#type_salary').on('change', function(){
        if($(this).val() == 'percent'){
            $('#type_curren').text('%');
            $('#salaries').attr('max',100);
        }else{
            $('#type_curren').text('VND');
            $('#salaries').attr('max','');
        }
    });

    $('#chucvu_id').on('change', function(){
        getPhongban($(this).val());
    });

    function getPhongban(id){
        $.ajax({
            url: "{{route('account.getpb')}}",
            type: 'post',
            data: {
                chucvu_id: id,
                "_token": "{{ csrf_token() }}",
            }
        })
        .done(res =>{
            let pb = res.phongban;
            $('#phongban_id').html('');
            $.each(pb, function (i, item) {
                // console.log(item);
                $('#phongban_id').append(`<option value="${item.id}">${item.name}</option>`)
            });
            let newitemnum = Math.floor(Math.random() * pb.length) + 1;
            $("#phongban_id").val(newitemnum);
            $('#phongban_id').selectpicker("refresh");
        })
    }
    $(document).on("click", ".open-AddBookDialog", function () {
        getPhongban($('#chucvu_id option:selected').val());

    });
    // currency format
    $('.currency').each(function(i, obj) {
        let val = parseInt($(obj).text());
        val = val.toLocaleString('it-IT', {style : 'currency',currency : 'VND'});
        $(obj).text(val);
    });
 
    //delete
    $('.delete').on('click', function(e){
        e.stopPropagation();
        var id = $(this).attr('data-id');
        var that = this;
        swal({
            title: "Bạn có chắc chắn?",
            text: "Việc xóa lương nhân viên sẽ ảnh hưởng đến phần tính lương cho nhân viên",
            icon: "error",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            console.log(id);
            if (willDelete) {
                $.ajax({
                    url: "{{route('phucap.delete')}}",
                    type: 'post',
                    data: {
                        id: id,
                        "_token": "{{ csrf_token() }}",
                    }
                })
                .done(res =>{
                    if(res.is){
                        swal("Xóa thành công!", {
                        icon: "success",
                        });
                        $(that).closest('tr').remove();
                        // setTimeout(()=>{location.reload()}, 2000)
                    }else{
                        swal("lôi!", {
                        icon: "warning",
                        });
                    }
                })
            } else {
                swal("Không xóa!");
            }
        });
    });
    //click to edit
    $('#name_change').on('click', function(e){
        e.stopPropagation();
    });
    $('.color_picker').on('change', function(e){
        e.stopPropagation();
        $.ajax({
            url: "{{route('chucvu.edit')}}",
            type: 'post',
            data: {
                color: $(this).val(),
                id: $(this).attr('data-id'),
                "_token": "{{ csrf_token() }}",
            }
        })
        .done(res =>{
            if(res.is){
                toastr.success('sửa thành công');
            }else{
                toastr.error('Lỗi');
            }
        })
    });
    $('.namecv').on('click', function(e){
        e.stopPropagation();
        let st = parseInt($(this).attr('data-st'));
        st = st+1;
        $(this).attr('data-st', st);
        if(st == 1){
            let val = $(this).text();
            $(this).text('');
            $(this).append(`<input type="text" class="form-control edittext" id="name_change" value="${val}">`);
        }
    });
    $(window).click(function() {
        let val = $('#name_change').val();
        $('.namecv').each(function(i, obj) {
            if($(obj).children('input').length != 0){
                $(obj).html(val);
                $(obj).attr('data-st', 0);
                $.ajax({
                    url: "{{route('chucvu.edit')}}",
                    type: 'post',
                    data: {
                        name: $(obj).text(),
                        id: $(obj).attr('data-id'),
                        "_token": "{{ csrf_token() }}",
                    }
                })
                .done(res =>{
                    if(res.is){
                        toastr.success('sửa thành công');
                    }else{
                        toastr.error('Lỗi');
                    }
                })
            }
        });
    });

    $('#submit_cv').on('click', function(){
        let data = {
            chucvu_id: $('#chucvu_id').val(),
            phongban_id: $('#phongban_id').val(),
        }
        let salary = $('#type_salary').val() == 'percent' ? {percent: true, salary: $('#salaries').val()} : {percent: false, salary: $('#salaries').val()};
        let date = $('#date_range').val();
        date = date.split(' - ');
        date = {time_start: date[0], time_end: date[1]};
        data = {...data, ...salary, ...date};
        console.log(data);
        $.ajax({
            url: "{{route('phucap.add')}}",
            type: 'post',
            data: {
                ...data,
                "_token": "{{ csrf_token() }}",
            }
        })
        .done(res =>{
            if(res.is){
                toastr.success('Thêm thành công');
                setTimeout(()=>{location.reload()}, 2000)
            }else{
                toastr.error(res.messenge);
            }
        })
    });
})
</script>
@endsection