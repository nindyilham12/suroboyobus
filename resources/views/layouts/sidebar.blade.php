<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin</title>
    <link href="{{asset('public/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/css/datepicker3.css')}}" rel="stylesheet">
    <link href="{{asset('public/css/styles.css')}}" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#"><span>G - </span>TRASH</a>
            </div>
        </div>
    </nav>
    <div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
        <div class="profile-sidebar">
            <div class="profile-usertitle">
                <div class="profile-usertitle-name"><h4><b><?php echo Session::get('email');?></b></h4></div>
                <div class="profile-usertitle-status"><span class="indicator label-success"></span>Online</div>
            </div>
            <div class="clear"></div>
        </div>

        <ul class="nav menu">
            <li><a href="{{url('/homeweb')}}"><em class="fa fa-home">&nbsp;</em> Home</a></li>
            <li class="parent "><a data-toggle="collapse" href="#sub-item-1">
                <em class="fa fa-navicon">&nbsp;</em> Users <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="fa fa-plus"></em></span>
                </a>
                <ul class="children collapse" id="sub-item-1">
                    <li><a href="{{url('/homeuser')}}">
                        <span class="glyphicon glyphicon-user"></span> All User
                    </a></li>
                    <li><a href="{{url('/homehelper')}}">
                        <span class="glyphicon glyphicon-user"></span> Helper
                    </a></li>
                    <li><a href="{{url('/homepenumpang')}}">
                        <span class="glyphicon glyphicon-user"></span> Penumpang
                    </a></li>
                </ul>
            </li>
            <li><a href="{{url('/homesampah')}}"><span class="glyphicon glyphicon-trash"></span> Bank Sampah</a></li>
            <li><a href="{{url('/homebus')}}"><span class="glyphicon fa fa-bus"></span> Suroboyo Bus</a></li>
            <li><a href="{{url('/logout')}}"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
        </ul>
    </div>

    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        @yield('content')
    </div>

    <script src="{{asset('public/js/jquery-1.11.1.min.js')}}"></script>
    <script src="{{asset('public/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('public/js/bootstrap-datepicker.js')}}"></script>
    <script src="{{asset('public/js/custom.js')}}"></script>


</html>



    
    

