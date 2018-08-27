<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('headTitle')</title>
        @yield('maincss')
        <link rel="stylesheet" type="text/css" href="/css/common.css">
        <style type="text/css">
        	.top{
        		height: 60px;
        		line-height: 60px;
        		width: 100%;
        		background: rgba(255,255,255,.2);
        		position: relative;
                top:0;
                z-index: 10;
        	}
        	.top-right{
        		position: absolute;
        		right: 20px;
        		top: 0
        	}
        	.logo{
    		    height: 60px;
                width: 208px;
                vertical-align: middle;
                display: inline-block;
                background: url(/img/logo-s.png) no-repeat 30px 9px;
                background-image: -webkit-image-set(url(/img/logo-s.png) 1x, url(/img/logo-b.png) 2x);
                background-size: 150px auto;
        	}
        	.links > a {
        	    color: #636b6f;
        	    padding: 0 5px;
        	    font-size: 12px;
        	    font-weight: 400;
        	    letter-spacing: .1rem;
        	    text-decoration: none;
        	    text-transform: uppercase;
        	}
        	 .links > a:hover{
        	    color: #000;
                cursor:pointer;
        	 }
        	 .nav-item{
        	 	display: inline-block;
        	 	vertical-align: middle;
        	 	text-decoration: none;
        	 	color: #333;
        	 }

        </style>
    </head>
    <body>
        <div class="top">
            @if (Route::has('login'))
            	<a href="/" class="logo"></a>
            	<!-- <a class="/list" class="nav-item">文章</a> -->
                <div class="top-right links">
                    @if (Auth::check())
                        <a href="{{ url('/home') }}">用户中心</a>
                    @else
                        <a href="{{ url('/login') }}">登录</a>
                        <a href="{{ url('/register') }}">注册</a>
                    @endif
                </div>
            @endif
        </div>
        @yield('content')
            <script src="/js/app.js"></script>
		@yield('js')
    </body>
</html>
