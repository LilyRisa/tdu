@extends('layout', ['page' => 'home'])

@section('head')
<style>
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
    <div class="row clearfix">
        <div class="col-lg-3 col-md-6 col-sm-12">
          <div class="card info-box-2 l-pink">
            <div class="body" style="height: 195px">
              <div class="icon col-12">
                <span class="chart chart-line"><i class="material-icons">account_circle</i></span>
                
              </div>
              <div class="content col-12">
                <div class="text"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Nhân viên</font></font></div>
                <div class="number"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{$user}}</font></font></div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">
          <div class="card info-box-2 l-parpl">
            <div class="body" style="height: 195px">
              <div class="icon col-12 m-t-10 m-b-5">
                <span class="chart chart-line"><i class="material-icons">
                    verified_user
                </i></span>
              </div>
              <div class="content col-12">
                <div class="text"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Nhân viên đã active</font></font></div>
                <div class="number"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{$user_avtive}}</font></font></div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">
          <div class="card info-box-2 l-turquoise">
            <div class="body" style="height: 195px">
              <div class="icon col-12 m-t-5">
                <span class="chart chart-line"><i class="material-icons">
                    work
                </i></span>
              </div>
              <div class="content col-12">
                <div class="text"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Tổng chức vụ</font></font></div>
                <div class="number"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{$chucvu}}</font></font></div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">
          <div class="card info-box-2 l-amber">
            <div class="body" style="height: 195px">
              <div class="icon col-12 m-t-10 m-b-5">
                <span class="chart chart-line"><i class="material-icons">
                    perm_contact_calendar
                </i></span>
              </div>
              <div class="content col-12">
                <div class="text"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Tổng phòng ban</font></font></div>
                <div class="number"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{$phongban}}</font></font></div>
              </div>
            </div>
          </div>
        </div>
    </div>        
{{-- calendar  --}}
    <div class="row clearfix">
        <div class="col-lg-4 col-md-12 col-sm-12">
            <div class="card">                   
               <div id="calean"></div>
            </div>
        </div>
        <div class="col-lg-8 col-md-12 col-sm-12">
            <div class="card">                   
                <div class="card product-report">
                    <div class="header">
                        <h2>Báo cáo số lượng tin nhắn đã gửi <small>Dự báo ngân sách chi cho phần thông báo</small></h2>
                        <ul class="header-dropdown m-r--5">
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
                        <div class="row clearfix m-b-15">
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <div class="icon l-amber"><i class="zmdi zmdi-chart-donut"></i></div>
                                <div class="col-in">
                                    <h4 class="counter m-b-0">{{$count_email}} tin (miễn phí)</h4>
                                    <small class="text-muted m-t-0">Thông báo Email</small>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <div class="icon l-turquoise"><i class="zmdi zmdi-chart"></i></div>
                                <div class="col-in">
                                    <h4 class="counter m-b-0">{{$count_sms}} tin (${{$count_sms * 0.175}})</h4>
                                    <small class="text-muted m-t-0">Thông báo sms </small>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <div class="icon l-parpl"><i class="zmdi zmdi-card"></i></div>
                                <div class="col-in">
                                    <h4 class="counter m-b-0">${{$total_price}}</h4>
                                    <small class="text-muted m-t-0">Tổng tiền phí gửi tin nhắn</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
{{-- calendar  --}}
    {{-- <div class="row clearfix">
        <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
            <div class="card">
                <div class="body">
                    <h3><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">50,5 Gb</font></font></h3>
                    <p class="text-muted"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Lưu lượng truy cập tháng này</font></font></p>
                    <div class="progress">
                        <div class="progress-bar l-green" role="progressbar" aria-valuenow="68" aria-valuemin="0" aria-valuemax="100" style="width: 68%;"></div>
                    </div>
                    <span class="text-small"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Cao hơn 4% so với tháng trước</font></font></span> </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
            <div class="card">
                <div class="body">
                    <h3><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">26,8%</font></font></h3>
                    <p class="text-muted"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Tải máy chủ</font></font></p>
                    <div class="progress">
                        <div class="progress-bar l-slategray" role="progressbar" aria-valuenow="68" aria-valuemin="0" aria-valuemax="100" style="width: 68%;"></div>
                    </div>
                    <span class="text-small"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Cao hơn 4% so với tháng trước</font></font></span> </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
            <div class="card">
                <div class="body">
                    <h3><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">14.500 đô la</font></font></h3>
                    <p class="text-muted"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Tổng doanh thu</font></font></p>
                    <div class="progress">
                        <div class="progress-bar l-amber" role="progressbar" aria-valuenow="68" aria-valuemin="0" aria-valuemax="100" style="width: 68%;"></div>
                    </div>
                    <span class="text-small"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Cao hơn 15% so với tháng trước</font></font></span> </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
            <div class="card">
                <div class="body">
                    <h3><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">1.600</font></font></h3>
                    <p class="text-muted"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Tổng số phản hồi</font></font></p>
                    <div class="progress">
                        <div class="progress-bar l-blue" role="progressbar" aria-valuenow="68" aria-valuemin="0" aria-valuemax="100" style="width: 68%;"></div>
                    </div>
                    <span class="text-small"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Cao hơn 10% so với tháng trước</font></font></span> </div>
            </div>
        </div>
    </div> --}}
    <div class="row clearfix">
        <div class="col-sm-12">
             <div class="card">
                <div class="header">
                    <h2><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">System logger</font></font></h2>
                    <small><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Hệ thống ghi lại những lần truy cập của tất cả người dùng bao gồm cả người dùng ẩn danh</font></font></small>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown"><a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more-vert"></i> </a>
                            {{-- <ul class="dropdown-menu pull-right">
                                <li><a href="javascript:void(0);"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Hoạt động</font></font></a></li>
                                <li><a href="javascript:void(0);"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Một hành động khác</font></font></a></li>
                                <li><a href="javascript:void(0);"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Một cái gì đó khác ở đây</font></font></a></li>
                            </ul> --}}
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <div class="table-responsive social_media_table">
                        <table class="table table-bordered table-striped table-hover js-exportable dataTable ">
                            <thead>
                                <tr>
                                    <th colspan="2"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">User</font></font></th>
                                    <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Ip v4</font></font></th>
                                    <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">UserAgent</font></font></th>                                                                                
                                    <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Truy cập cuối</font></font></th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($logg as $log)
                                <tr>
                                    <td>
                                        <img class="rounded-circle" src="{{$log->user != null ? asset('storage').'/'.$log->user->avatar : asset('images/anonymous.png')}}"  alt="user" width="40">
                                    </td>
                                    <td>
                                        <a href="{{$log->user != null ? route('profile.index', ['id' =>$log->user->username]) : '#'}}">{{$log->user != null ? $log->user->fullname : 'Anonymous'}}</a>
                                    </td>
                                    <td><span class="list-name"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{$log->ip_address}}</font></font></span>
                                    </td>
                                    <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{$log->user_agent}}</font></font></td>
                                    <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{$log->last_activity }}</font></font></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>            
    </div>
    
    <div class="row clearfix">
       <div class="col-lg-12 col-md-12">
           <div class="card ">
            <div class="header">
                <h2>Dữ liệu dịch bệnh covid-19 tại Việt Nam<small>Dữ liệu được lấy từ nguồn thứ 3</small></h2>
                <div class="row">
                    <div class="col col-md-4">
                        <label for="">Số ngày trước</label>
                        <input type="number" class="form-control" id="lastday" value="120">
                    </div>
                    <div class="col col-md-2">
                        <button class="btn btn-warning" style="margin-top: 30px" id="load_data">Trích xuất</button>
                    </div>
                </div>
                <ul class="header-dropdown m-r--5">
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
                <div id="area_chart" class="graph"></div>
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
function imgError(image) {
    image.onerror = "";
    image.src = "{{asset('images/anonymous.png')}}";
    return true;
}
const yourDate = new Date()

$('#calean').fullCalendar({
        header: {
            left: 'prev',
            center: 'title',
            right: 'next'
        },
        defaultDate: yourDate.toISOString().split('T')[0],
        editable: false,
        droppable: false, // this allows things to be dropped onto the calendar
        drop: function() {
            // is the "remove after drop" checkbox checked?
            if ($('#drop-remove').is(':checked')) {
                // if so, remove the element from the "Draggable Events" list
                $(this).remove();
            }
        },
        eventLimit: true, // allow "more" link when too many events
        events: [
            @foreach($calendar as $cale)
            {

                title: '{{$cale->title}}',
                {!!$cale->end != null ?  'end: "'.$cale->end.'",' : null!!}
                start: '{{$cale->start}}',
                className: '{{$cale->class_name}}',
                {!!$cale->url != null ? 'url: "'.$cale->url.'",' : null!!}
            },
            @endforeach
            
        ]
    });
// MorrisArea();
var morrisLine;
initMorris();

function setMorris(data) {
  morrisLine.setData(data);
  morrisLine.redraw();
}
function initMorris(data) {
    morrisLine = Morris.Line({
        element: 'area_chart',
        // data: data,
        lineColors: ['#ffcf4e', 'red', 'green'],
        xkey: 'date',
        ykeys: ['cases', 'deaths', 'recovered'],
        labels: ['Số ca', 'Tử vong', 'Hồi phục'],
        pointSize: 2,
        lineWidth: 1,
        resize: true,
        grid: true,
        axes: true,
        fillOpacity: 0.5,
        behaveLikeLine: true,
        gridLineColor: '#e3e5e7',
        hideHover: 'auto'
    });
}

$(document).ready(function() {
    $('#loading').hide();
    $.ajax({
        url: "{{route('covid_api')}}",
        type: 'POST',
        data:{
            last_day: 120,
            "_token": "{{ csrf_token() }}",
        }
    }).done(res => {
        console.log(res.timeline);
        var cases = res.timeline.cases;
        var deaths = res.timeline.deaths;
        var recovered = res.timeline.recovered;
        var data_covid = [];
        for(let index in cases) { 
            let obj = {};
            obj.date = index;
            obj.cases = cases[index];
            obj.deaths = deaths[index];
            obj.recovered = recovered[index];
            data_covid.push(obj);
        }
        setMorris(data_covid);
    })
    $('#load_data').on('click', function(e){
        e.preventDefault();
        $('#loading').show();
        var last_day = $('#lastday').val();
        $.ajax({
            url: "{{route('covid_api')}}",
            type: 'POST',
            data:{
                last_day: last_day,
                "_token": "{{ csrf_token() }}",
            }
        }).done(res => {
            $('#loading').hide();
            // console.log(res.timeline);
            var cases = res.timeline.cases;
            var deaths = res.timeline.deaths;
            var recovered = res.timeline.recovered;
            var data_covid = [];
            for(let index in cases) { 
                let obj = {};
                obj.date = index;
                obj.cases = cases[index];
                obj.deaths = deaths[index];
                obj.recovered = recovered[index];
                data_covid.push(obj);
            }
            setMorris(data_covid);
        })
    })

        

        
      
      });
    </script>
@endsection