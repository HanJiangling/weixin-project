<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--><html lang="en"><!--<![endif]-->
<head>
<meta charset="utf-8">

<!-- Viewport Metatag -->
<meta name="viewport" content="width=device-width,initial-scale=1.0">

<!-- Plugin Stylesheets first to ease overrides -->
<link rel="stylesheet" type="text/css" href="/static/Admin/plugins/colorpicker/colorpicker.css" media="screen">
<link rel="stylesheet" type="text/css" href="/static/Admin/custom-plugins/wizard/wizard.css" media="screen">

<!-- Required Stylesheets -->
<link rel="stylesheet" type="text/css" href="/static/Admin/bootstrap/css/bootstrap.min.css" media="screen">
<link rel="stylesheet" type="text/css" href="/static/Admin/css/fonts/ptsans/stylesheet.css" media="screen">
<link rel="stylesheet" type="text/css" href="/static/Admin/css/fonts/icomoon/style.css" media="screen">

<link rel="stylesheet" type="text/css" href="/static/Admin/css/mws-style.css" media="screen">
<link rel="stylesheet" type="text/css" href="/static/Admin/css/icons/icol16.css" media="screen">
<link rel="stylesheet" type="text/css" href="/static/Admin/css/icons/icol32.css" media="screen">

<!-- Demo Stylesheet -->
<link rel="stylesheet" type="text/css" href="/static/Admin/css/demo.css" media="screen">

<!-- jQuery-UI Stylesheet -->
<link rel="stylesheet" type="text/css" href="/static/Admin/jui/css/jquery.ui.all.css" media="screen">
<link rel="stylesheet" type="text/css" href="/static/Admin/jui/jquery-ui.custom.css" media="screen">

<!-- Theme Stylesheet -->
<link rel="stylesheet" type="text/css" href="/static/Admin/css/mws-theme.css" media="screen">
<link rel="stylesheet" type="text/css" href="/static/Admin/css/themer.css" media="screen">
<link rel="stylesheet" type="text/css" href="/static/Admin/css/my.css" media="screen">


<title>@yield("title")</title>

</head>

<body>
    <!-- Header -->
    <div id="mws-header" class="clearfix">
    
        <!-- Logo Container -->
        <div id="mws-logo-container">
        
            <!-- Logo Wrapper, images put within this wrapper will always be vertically centered -->
            <div id="mws-logo-wrap">
                <img src="/static/Admin/images/mws-logo.png" alt="mws admin">
            </div>
        </div>
        
        <!-- User Tools (notifications, logout, profile, change password) -->
        <div id="mws-user-tools" class="clearfix">
        
            <!-- Notifications -->
            
            <!-- Messages -->
            
            <!-- User Information and functions section -->
            <div id="mws-user-info" class="mws-inset">
            
                <!-- User Photo -->
                <div id="mws-user-photo">
                    <img src="/static/Admin/example/profile.jpg" alt="User Photo">
                </div>
                
                <!-- Username and Functions -->
                <div id="mws-user-functions">
                    <div id="mws-username">
                        您好, {{session('islogin')}}
                    </div>
                    <ul>
                        <li><a href="/adminreset1/{{session('islogin')}}">修改密码</a></li>
                        <li><a href="/adminlogin">退出</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Start Main Wrapper -->
    <div id="mws-wrapper">
    
        <!-- Necessary markup, do not remove -->
        <div id="mws-sidebar-stitch"></div>
        <div id="mws-sidebar-bg"></div>
        
        <!-- Sidebar Wrapper -->
        <div id="mws-sidebar">
        
            <!-- Hidden Nav Collapse Button -->
            <div id="mws-nav-collapse">
                <span></span>
                <span></span>
                <span></span>
            </div>
            
            <!-- Searchbox -->
            
            <!-- Main Navigation -->
            <div id="mws-navigation">
                <ul>
                    <li>
                        <a href="#"><i class="icon-add-contact"></i> 录入学员信息</a>
                        <ul class="closed">
                            <li><a href="/users/create">学员信息单个添加</a></li>
                            <li><a href="/users">学员信息查看</a></li>
                            <li><a href="/userss/create">学员信息批量导入</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="icon-user"></i> 预约管理</a>
                        <ul class="closed">
                            <li><a href="/adminuser">预约列表</a></li>
                        </ul>
                    </li>
                </ul>
            </div>         
        </div>
        
        <!-- Main Container Start -->
        <div id="mws-container" class="clearfix">
        
                <div class="container">
                     @if(session('success'))
                    <div class="mws-form-message success">
                        
                        {{session('success')}}
                        
                    </div>
                    @endif

                    
                     @if(session('error'))
                   <div class="mws-form-message error">
                        {{session('error')}}
                    </div>
                     @endif
                    @section("admin")
                    @show
                               
                    <!-- Panels End -->
                </div>
                <!-- footer -->
                <div id="mws-footer">
                    Copyright Your Website 2012. All Rights Reserved.
                </div>
        </div>
        <!-- Main Container End -->
        
    </div>

    <!-- JavaScript Plugins -->
    <script src="/static/Admin/js/libs/jquery-1.8.3.min.js"></script>
    <script src="/static/Admin/js/libs/jquery.mousewheel.min.js"></script>
    <script src="/static/Admin/js/libs/jquery.placeholder.min.js"></script>
    <script src="/static/Admin/custom-plugins/fileinput.js"></script>
    
    <!-- jQuery-UI Dependent Scripts -->
    <script src="/static/Admin/jui/js/jquery-ui-1.9.2.min.js"></script>
    <script src="/static/Admin/jui/jquery-ui.custom.min.js"></script>
    <script src="/static/Admin/jui/js/jquery.ui.touch-punch.js"></script>

    <!-- Plugin Scripts -->
    <script src="/static/Admin/plugins/datatables/jquery.dataTables.min.js"></script>
    <!--[if lt IE 9]>
    <script src="js/libs/excanvas.min.js"></script>
    <![endif]-->
    <script src="/static/Admin/plugins/flot/jquery.flot.min.js"></script>
    <script src="/static/Admin/plugins/flot/plugins/jquery.flot.tooltip.min.js"></script>
    <script src="/static/Admin/plugins/flot/plugins/jquery.flot.pie.min.js"></script>
    <script src="/static/Admin/plugins/flot/plugins/jquery.flot.stack.min.js"></script>
    <script src="/static/Admin/plugins/flot/plugins/jquery.flot.resize.min.js"></script>
    <script src="/static/Admin/plugins/colorpicker/colorpicker-min.js"></script>
    <script src="/static/Admin/plugins/validate/jquery.validate-min.js"></script>
    <script src="/static/Admin/custom-plugins/wizard/wizard.min.js"></script>

    <!-- Core Script -->
    <script src="/static/Admin/bootstrap/js/bootstrap.min.js"></script>
    <script src="/static/Admin/js/core/mws.js"></script>

    <!-- Themer Script (Remove if not needed) -->
    <script src="/static/Admin/js/core/themer.js"></script>

    <!-- Demo Scripts (remove if not needed) -->
    <script src="/static/Admin/js/demo/demo.dashboard.js"></script>

</body>
</html>