<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--><html lang="en"><!--<![endif]-->
<head>
<meta charset="utf-8">

<!-- Viewport Metatag -->
<meta name="viewport" content="width=device-width,initial-scale=1.0">

<!-- Required Stylesheets -->
<link rel="stylesheet" type="text/css" href="/static/Admin/bootstrap/css/bootstrap.min.css" media="screen">
<link rel="stylesheet" type="text/css" href="/static/Admin/css/fonts/ptsans/stylesheet.css" media="screen">
<link rel="stylesheet" type="text/css" href="/static/Admin/css/fonts/icomoon/style.css" media="screen">

<link rel="stylesheet" type="text/css" href="/static/Admin/css/login.css" media="screen">

<link rel="stylesheet" type="text/css" href="/static/Admin/css/mws-theme.css" media="screen">

<title>后台登录界面</title>

</head>

<body>

    <div id="mws-login-wrapper">
        <div id="mws-login">
            <h1>选座系统后台</h1>
            <div class="mws-login-lock"><i class="icon-lock"></i></div>
            <div id="mws-login-form">
                <form class="mws-form" action="/adminlogin" method="post">
                    <h3 style="color:red">
                        @if(session('error'))
                            {{session('error')}}
                        @endif
                    </h3>
                    <div class="mws-form-row">
                        <div class="mws-form-item">
                            <input type="text" name="name" class="mws-login-username required" placeholder="name">
                        </div>
                    </div>
                    <div class="mws-form-row">
                        <div class="mws-form-item">
                            <input type="password" name="password" class="mws-login-password required" placeholder="password">
                        </div>
                    </div>
                    <div class="mws-form-row">
                        {{csrf_field()}}
                        <input type="submit" value="Login" class="btn btn-success mws-login-button">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- JavaScript Plugins -->
    <script src="/static/Admin/js/libs/jquery-1.8.3.min.js"></script>
    <script src="/static/Admin/js/libs/jquery.placeholder.min.js"></script>
    <script src="/static/Admin/custom-plugins/fileinput.js"></script>
    
    <!-- jQuery-UI Dependent Scripts -->
    <script src="/static/Admin/jui/js/jquery-ui-effects.min.js"></script>

    <!-- Plugin Scripts -->
    <script src="/static/Admin/plugins/validate/jquery.validate-min.js"></script>

    <!-- Login Script -->
    <script src="/static/Admin/js/core/login.js"></script>

</body>
</html>
