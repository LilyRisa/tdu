@extends('layout', ['page' => 'Tính lương nhân viên'])
@section('head')
<style>
    .edittext, .edittext:focus{
        background: #ffffff00;
        border: none;
    }
    .loading {
    width: 100%;
    height: 100%;
    position: fixed;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    background-color: rgba(0,0,0,.5);
}
.loading-wheel {
    width: 20px;
    height: 20px;
    margin-top: -40px;
    margin-left: -40px;
    
    position: absolute;
    top: 50%;
    left: 50%;
    
    border-width: 30px;
    border-radius: 50%;
    -webkit-animation: spin 1s linear infinite;
}
.style-2 .loading-wheel {
    border-style: double;
    border-color: #ccc transparent;
}
@-webkit-keyframes spin {
    0% {
        -webkit-transform: rotate(0);
    }
    100% {
        -webkit-transform: rotate(-360deg);
    }
}
</style>
@endsection


@section('content')
   <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="header">
                        <h2> Tính lương nhân viên </h2>
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
                                <div class="col col-md-3">
                                    <label for="user" id="lab_user" data-salary="">Chọn nhân viên</label>
                                    <select id="user" class="form-control show-tick">
                                        @foreach ($user as $us)
                                            <option value="{{$us->id}}" data-username="{{$us->username}}" data-salary="{{$us->salary == null ? null : $us->salary->salary}}"
                                                data-chucvu="{{$us->chucvu_id}}" data-phongban="{{$us->phongban_id}}">{{$us->fullname}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col col-md-3">
                                    <label id="pctn">Phụ cấp thân nhân</label>
                                    <div style="display: none" id="pctn_val">0</div>
                                    <div class="row">
                                        <div class="col col-md-6">
                                            <select id="chucvu" class="form-control" disabled></select>
                                        </div>
                                        <div class="col col-md-6">
                                            <select id="phongban" class="form-control" disabled></select>
                                        </div>
                                    </div>
                                   
                                </div>
                                <div class="col col-md-3">
                                    <label for="phucap" id="pcother" data-salary="0">Phụ cấp riêng</label>
                                    <div style="display: none" id="pcother_val">0</div>
                                    <select id="phucap" class="form-control show-tick" multiple>
                                        @foreach ($salaryother as $slo)
                                            <option value="{{$slo->id}}"  data-salary="{{$slo->salary}}" data-salarytype="{{$slo->salary_type}}">{{$slo->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col col-md-2">
                                    <label>Nhập số ngày nghỉ phép</label>
                                    <input type="number" id="leave" value="0" class="form-control">
                                </div>
                                <div class="col col-md-1">
                                    <button class="btn btn-primary" id="tinhluong">Tính Lương</button>
                                </div>
                        </div>
                        <div class="clearfix" style="margin-top: 30px">
                            <div class="row">
                                <div class="table-responsive" >
                                    <table class="table table-bordered table-striped table-hover js-exportable dataTable" id="table_data">
                                        <thead>
                                            <tr>
                                                <th>Tên nhân viên</th>
                                                <th>Chức vụ - phòng ban</th>
                                                <th>Tổng phụ cấp riêng</th>
                                                <th>Số ngày nghỉ phép</th>
                                                <th>Lương Gross</th>
                                                <th>Lương Net</th>
                                                <th>Lương thực nhận</th>
                                                <th>Bảo hiểm bắt buộc</th>
                                                <th>thuế</th>
                                                <th>Thời gian khởi tạo</th>
                                                <th>Operation</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($cal_salary as $cal)
                                            <tr>
                                                <td>{{$cal->user->fullname}} - <span>{{$cal->user->username}}</span></td>
                                                <td>{{$cal->user->chucvu->name}} -  {{$cal->user->phongban->name}} <div class="curency">{{$cal->allowance}}</div></td>
                                                <td class="curency">{{$cal->allowance_other}}</td>
                                                <td>{{$cal->leave}}</td>
                                                <td class="curency">{{$cal->gross}}</td>
                                                <td class="curency">{{$cal->net}}</td>
                                                <td class="curency">{{$cal->actual_salary_received}}</td>
                                                <td class="curency">{{$cal->insurrance}}</td>
                                                <td class="curency">{{$cal->tax}}</td>
                                                <td>{{$cal->created_at}}</td>
                                                <td>
                                                    <span title="Thông báo qua sms phone" class="badge badge-success phone_send" style="cursor: pointer"
                                                         data-net="{{$cal->net}}" 
                                                         data-gross="{{$cal->gross}}" 
                                                         data-tn="{{$cal->actual_salary_received}}" 
                                                         data-userphone="{{$cal->User->phone}}"
                                                         data-time="{{$cal->created_at}}"><i class="zmdi zmdi-smartphone-landscape"></i></span>
                                                    <span title="Thông báo qua Email" class="badge badge-success email_send" style="cursor: pointer" 
                                                        data-net="{{$cal->net}}" 
                                                        data-gross="{{$cal->gross}}" 
                                                        data-tn="{{$cal->actual_salary_received}}" 
                                                        data-user="{{$cal->User->id}}"
                                                        data-leave="{{$cal->leave}}"
                                                        data-email="{{$cal->User->email}}"
                                                        data-time="{{$cal->created_at}}"><i class="zmdi zmdi-email"></i></span>
                                                    <span class="badge badge-danger delete" style="cursor: pointer;" data-id="{{$cal->id}}">Xóa</span>
                                                    
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
    <div class="loading style-2" id="loading"><div class="loading-wheel"></div></div>
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
    var data_after_cal = {};

    $('.email_send').on('click', function(e){
        $('#loading').show();
        e.stopPropagation();
        var data_send_email = {};
        data_send_email.net = parseInt($(this).data('net')).toLocaleString('it-IT', {style : 'currency', currency : 'VND'});
        data_send_email.gross = parseInt($(this).data('gross')).toLocaleString('it-IT', {style : 'currency', currency : 'VND'});
        data_send_email.tn = parseInt($(this).data('tn')).toLocaleString('it-IT', {style : 'currency', currency : 'VND'});
        data_send_email.user_id = $(this).data('user');
        data_send_email.created_at = $(this).data('time');
        data_send_email.leave = $(this).data('leave');
        var u_email = $(this).data('email');
        var that = this;
        swal({
            title: "Gửi email đến nhân viên?",
            text: "Gửi email: "+u_email+"\nViệc gửi email sẽ phát sinh chi phí của hệ thống. Đồng ý để tiếp tục",
            icon: "success",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            console.log(willDelete);
            if (willDelete) {
                $.ajax({
                    url: "{{route('salarycal.sendEmail')}}",
                    type: 'post',
                    data: {
                        ...data_send_email,
                        "_token": "{{ csrf_token() }}",
                    }
                })
                .done(res =>{
                    $('#loading').hide();
                    if(res.is){
                        swal("Gửi thành công!", {
                        icon: "success",
                        });
                        // setTimeout(()=>{location.reload()}, 2000)
                    }else{
                        swal("lôi!", {
                        icon: "warning",
                        });
                    }
                })
            } else {
                $('#loading').hide();
                swal("Không xóa!");
            }
        });
    });

    $('.phone_send').on('click', function(e){
        $('#loading').show();
        e.stopPropagation();
        var data_send_sms = {};
        data_send_sms.net = parseInt($(this).data('net')).toLocaleString('it-IT', {style : 'currency', currency : 'VND'});
        data_send_sms.gross = parseInt($(this).data('gross')).toLocaleString('it-IT', {style : 'currency', currency : 'VND'});
        data_send_sms.tn = parseInt($(this).data('tn')).toLocaleString('it-IT', {style : 'currency', currency : 'VND'});
        data_send_sms.phone = $(this).data('userphone');
        data_send_sms.created_at = $(this).data('time');
        var that = this;
        swal({
            title: "Gửi tin nhắn sms đến nhân viên?",
            text: "Gửi đên số: "+data_send_sms.phone+"\nViệc gửi tin nhắn sẽ phát sinh chi phí của hệ thống. Đồng ý để tiếp tục",
            icon: "success",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            console.log(willDelete);
            if (willDelete) {
                $.ajax({
                    url: "{{route('salarycal.sendSms')}}",
                    type: 'post',
                    data: {
                        ...data_send_sms,
                        "_token": "{{ csrf_token() }}",
                    }
                })
                .done(res =>{
                    $('#loading').hide();
                    if(res.is){
                        swal("Gửi thành công!", {
                        icon: "success",
                        });
                        // setTimeout(()=>{location.reload()}, 2000)
                    }else{
                        swal("lôi!", {
                        icon: "warning",
                        });
                    }
                })
            } else {
                $('#loading').hide();
                swal("Không xóa!");
            }
        });
    });

    $('.delete').on('click', function(e){
        e.stopPropagation();
        var id = $(this).attr('data-id');
        var that = this;
        swal({
            title: "Bạn có chắc chắn?",
            text: "Đồng ý sẽ xóa toàn bộ các dữ liệu liên quan",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            console.log(id);
            if (willDelete) {
                $.ajax({
                    url: "{{route('salarycal.datele')}}",
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

    $('body').on('click', '#save_fetch', function(e){
        e.stopPropagation();
        swal({
            title: "Lưu vào database?",
            text: "",
            icon: "success",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: '{{route("salarycal.save")}}',
                    type: 'post',
                    data:{
                            "_token": "{{ csrf_token() }}",
                            ...data_after_cal
                    }
                })
                .done(res=>{
                        if(res.is){
                            swal("lưu thành công!");
                            $('#save_fetch').closest('td').html('<span class="badge badge-danger delete" style="cursor: pointer;" data-id="1">Xóa</span>');
                        }else{
                            toastr.error('Lỗi');
                        }
                })
            }else{
                swal("Không lưu!");
            }
        })

        
    })
    $('.curency').each(function(i, val){
        let curren = parseInt($(val).text());
        curren = curren.toLocaleString('it-IT', {style : 'currency', currency : 'VND'});
        $(val).text(curren);
    });

    $('#tinhluong').on('click', function(){
        $('#loading').show();
        $('#table_data').DataTable().row($('#fetching')).remove().draw();
        var cal_salary = parseInt($('#user option:selected').data('salary'));
        var cal_benefit = [];
        cal_benefit.push(parseInt($('#pctn_val').text()));
        cal_benefit.push(parseInt($('#pcother_val').text()));
        var cal_leave = parseInt($('#leave').val());
        var data = {
                salary : cal_salary,
                benefit : cal_benefit,
                leave: cal_leave,
                tax: {
                    depenPerson : 0,
                    reduce_yourself: 0
                }
           };

        console.log(data);
        
        $.ajax({
           url: '{{route("apical.SalaryCalculate")}}',
           type: 'post',
           data:data
       })
       .done(res => {
        data_after_cal.user_id = parseInt($('#user option:selected').val());
        data_after_cal.allowance = parseInt($('#pctn_val').text());
        data_after_cal.allowance_other = parseInt($('#pcother_val').text());
        data_after_cal.leave = cal_leave;
        data_after_cal.gross = res.gross;
        data_after_cal.net = res.net;
        data_after_cal.actual_salary_received = res.actual_salary_received;
        data_after_cal.insurrance = res.insurrance;
        data_after_cal.tax = res.tax;
        $('#loading').hide();
            let index = $('#table_data').DataTable().row.add([
                $('#user option:selected').text() + `- <span>${$('#user option:selected').data('username')}</span>`,
                $('#chucvu option:selected').text() + ' - ' + $('#phongban option:selected').text() + ` (${parseInt($('#pctn_val').text()).toLocaleString('it-IT', {style : 'currency', currency : 'VND'})})`,
                parseInt($('#pcother_val').text()).toLocaleString('it-IT', {style : 'currency', currency : 'VND'}) + '',
                cal_leave + '',
                res.gross.toLocaleString('it-IT', {style : 'currency', currency : 'VND'}) + '',
                res.net.toLocaleString('it-IT', {style : 'currency', currency : 'VND'}) + '',
                res.actual_salary_received.toLocaleString('it-IT', {style : 'currency', currency : 'VND'}) + '',
                res.insurrance.toLocaleString('it-IT', {style : 'currency', currency : 'VND'}) + '',
                res.tax.toLocaleString('it-IT', {style : 'currency', currency : 'VND'}) + '',
                convertDate(new Date())+'',
                '<span class="badge badge-susscess save" style="cursor: pointer;" id="save_fetch">Lưu vào database</span>'
            ]).draw(false);
            $('#table_data').DataTable().rows(index).nodes().to$().attr("id", 'fetching');
       })
    });


    $('#loading').hide();
    let salary = parseInt($('#user option:selected').data('salary'));
    let chucvu = parseInt($('#user option:selected').data('chucvu'));
    let phongban = parseInt($('#user option:selected').data('phongban'));
    getChucVu(chucvu);
    getPhongBan(phongban);
    getSalary(chucvu, phongban, salary);
    salary = salary.toLocaleString('it-IT', {style : 'currency', currency : 'VND'});
    $('#lab_user').text(`Nhân viên (Lương cứng: ${salary})`);

    $('#phucap').on('change', function(){
        // console.log($('option:selected', this).data('salary'));
        let total = 0;
        $(':selected', this).each(function(i, val){
            if($(val).data('salarytype') == 1){
                total = total + (parseInt($(val).data('salary')) / 100) * parseInt($('option:selected', '#user').data('salary'));
            }else{
                total = total + parseInt($(val).data('salary'))
            }
        });
        $('#pcother_val').text(total);
        total = total.toLocaleString('it-IT', {style : 'currency', currency : 'VND'});
        $('#pcother').text(`Phụ cấp riêng (${total})`);
    });

   $('#user').on('change', function(){
        let chucvu = parseInt($('option:selected', this).data('chucvu'));
        let phongban = parseInt($('option:selected', this).data('phongban'));
        let salary = parseInt($('option:selected', this).data('salary'));
        $.ajax({
           url: '{{route("account.getcv")}}',
           type: 'post',
           data:{
                "_token": "{{ csrf_token() }}",
                id: chucvu
           }
       })
       .done(res =>{
           console.log(res);
           res = res.chucvu;
           if(res != null){
                $('#chucvu').html(`<option id="${res.id}">${res.name}</option>`);
                $('#chucvu').selectpicker("refresh");
                getPhongBan(phongban);
           }else{
               $('#tinhluong').attr('disabled', 'true');
               swal("Nhân viên chưa được active!");
           }
           
       })
        
        
        getSalary(chucvu, phongban, salary);
        salary = salary.toLocaleString('it-IT', {style : 'currency', currency : 'VND'});
        $('#lab_user').text(`Nhân viên (Lương cứng: ${salary})`);
   });

   function getChucVu(id){
       $.ajax({
           url: '{{route("account.getcv")}}',
           type: 'post',
           data:{
                "_token": "{{ csrf_token() }}",
                id: id
           }
       })
       .done(res =>{
           res = res.chucvu;
           $('#chucvu').html(`<option id="${res.id}">${res.name}</option>`);
           $('#chucvu').selectpicker("refresh");
       })
   }

   function getPhongBan(id){
       $.ajax({
           url: '{{route("account.getpbid")}}',
           type: 'post',
           data:{
                "_token": "{{ csrf_token() }}",
                id: id
           }
       })
       .done(res =>{
           res = res.phongban;
           $('#phongban').html(`<option id="${res.id}">${res.name}</option>`);
           $('#phongban').selectpicker("refresh");
       })
   }

   function getSalary(cv,pb, salarytype){
        $.ajax({
            url: '{{route("phucap.getwithpbcv")}}',
            type: 'post',
            data:{
                "_token": "{{ csrf_token() }}",
                chucvu: cv,
                phongban: pb
            }
        })
        .done(res =>{
            let salary = 0;
            if(res.data.precent_salary == 1){
                salary = salarytype * (res.data.salary / 100);
                $('#pctn_val').text(salary);
            }else{
                salary =  parseInt(res.data.salary);
                $('#pctn_val').text(salary);
            }
            salary = salary.toLocaleString('it-IT', {style : 'currency', currency : 'VND'});
            $('#pctn').text(`Phụ cấp thân nhân (${salary})`);
        })
   }
   function convertDate(date) {
        var yyyy = date.getFullYear().toString();
        var mm = (date.getMonth()+1).toString();
        var dd  = date.getDate().toString();

        var mmChars = mm.split('');
        var ddChars = dd.split('');

        return yyyy + '-' + (mmChars[1]?mm:"0"+mmChars[0]) + '-' + (ddChars[1]?dd:"0"+ddChars[0]);
    }
})
</script>
@endsection