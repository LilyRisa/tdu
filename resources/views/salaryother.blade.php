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
                                            <label>Tên phụ cấp: </label>
                                            <input type="text" id="name" class="form-control"/>
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
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th>Tên phụ cấp</th>
                                        <th>Mức phụ cấp <span style="color: red">*</span></th>
                                        <th>Loại phụ cấp</th>                                   
                                        <th width="20%">Operation</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($phucap as $item)
                                    <tr>
                                        {{-- <td class="namecv" data-id="{{$item->id}}" data-st="0">{{$item->id}}</td> --}}
                                        <td data-id="{{$item->id}}" class="namecv" data-st="0">
                                            {{$item->name}}
                                        </td>
                                        @if($item->salary_type) 
                                            <td>{{$item->salary}}%</td> 
                                        @else   
                                            <td class="currency">{{$item->salary}}</td> 
                                        @endif
                                        <td data-id="{{$item->id}}" data-st="0">
                                            {{$item->salary_type ? '% (lương cứng)' : 'cộng trực tiếp'}}
                                        </td>
                                        
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
            text: "Việc xóa bản ghi sẽ ảnh hưởng đến phần tính lương cho nhân viên",
            icon: "error",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            console.log(id);
            if (willDelete) {
                $.ajax({
                    url: "{{route('phucapother.delete')}}",
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
                    url: "{{route('phucapother.edit')}}",
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
            name: $('#name').val()
        };
        let salary = $('#type_salary').val() == 'percent' ? {percent: true, salary: $('#salaries').val()} : {percent: false, salary: $('#salaries').val()};
        data = {...data, ...salary};
        console.log(data);
        $.ajax({
            url: "{{route('phucapother.add')}}",
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