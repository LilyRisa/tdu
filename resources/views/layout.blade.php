<html>
    @include('layout.head')
    <body class="theme-orange">
        @include('layout.loader')
        @include('layout.navbar')
        @include('layout.aside')
        @include('layout.livechat')

        <section class="content {{isset($page) ? $page : 'home'}}">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Dashboard
                    {{-- <small class="text-muted">Welcome to Nexa Application</small> --}}
                    </h2>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <ul class="breadcrumb float-md-right">
                        <li class="breadcrumb-item"><a href="{{route('index')}}"><i class="zmdi zmdi-home"></i> Dashboard</a></li>
                        <li class="breadcrumb-item active">{{isset($page) ? $page : 'home'}}</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            @yield('content')
            <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="body">
                        <p class="m-b-0">© 2021 Admin panel by <a href="https://facebook.com/dark.knight.os" target="black">Bronoz</a> </p>
                    </div>
                </div>
            </div>
        </div>
        </div>

        </section>

        @include('layout.script')

        @yield('script')
    </body>
</html>