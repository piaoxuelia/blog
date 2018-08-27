@extends('layouts.frame')
@section('title')
	fetime首页 - feblog
@endsection
@section('maincss')
	<style>
		html, body {
			background-color: #fff;
			color: #636b6f;
			font-family: 'Raleway', sans-serif;
			font-weight: 100;
			margin: 0;
		}
		#bg{
			height: 100vh;
			width: 100vw;
			transition:.5s ease-in;
			position: fixed;
			top: 0;
			left: 0;
		    z-index: 1;
		}
		.m-b-md {
			margin-bottom: 30px;
		}

		.bg0,.bg1,.bg2{
			background-repeat: : no-repeat;
			background-position: 50% 50%;
			background-size: cover;
		}
		.bg0{
			background-image:url('/img/bg0.jpg');
			background-color: #eddcc2;
		}
		.bg1{
			background-image:url('/img/bg1.jpg');
			background-color: #98c3d3;
		}
		.bg2{
			background-image:url('/img/bg2.jpg');
			background-color: #d8d495
		}
		.wel-line{
			position: fixed;
			bottom: 0px;
			left: 0;
			width:100%;
			background: #000;
			z-index: 2;
		}
		.linetext{
			color: #aaa;
			font-size:14px;
			width: 400px;
			margin:0 auto;
			height: 35px;
			line-height: 35px;
			text-align: center;
			position: relative;
			
		}
		.linetext span{
			display: inline-block;
			padding: 0 30px;
		}
		.linetext:before{
			content: "";
			display: block;
			position: absolute;
			width:50px;
			height: 1px;
			top: 16px;
			background:#777;
		 }
		.linetext:after{
			content: "";
			display: block;
			position: absolute;
			width:50px;
			height: 1px;
			top: 16px;
			right: 0;
			background:#777;
		 }
		.content{
			padding-top: 30px;
			transform:translateY(100vh);
			transition: .5s ease-in;
			background: #fff;
			margin-top: 80px;
		}

		.slide-up .content{
			transform:translateY(0);
		}
		.slide-up #bg{
			height: 80px;
			opacity: .9;
		}
		.slide-up .wel-line{
			display: none
		}
		.con-left{
			float: left;
			width:30%;
			max-width: 300px
		 }
		 .con-right{
			float: left;
			width: 66%
		 }
		.tags{
			padding-left: 20px
		}
		.tags a{
			color: #666;
			border:1px solid #ccc;
			border-radius: 5px;
			line-height: 20px 10px;
			padding: 0 10px;
			font-size: 14px;
			display: inline-block;
		}
		.tags a:hover{
			color: #000;
			border:1px solid #666;
			background: #eee
		}

		
		.clearfix:after{
			content: "";
			display: block;
			width:100%;
			height: 0px;
			clear: both;
		}


	</style>
@endsection
@section('content')
<div id="bg"></div>
<script type="text/javascript">
	var bodyBgName = 'bg'+Math.floor(Math.random()*3);
	document.getElementById('bg').className = bodyBgName;
</script>

<div class="wel-line">
	<div class="linetext">
		<span>每天进步一点点，你会发现一个不一样的自己</span>
	</div>
</div>

<div class="content clearfix">
	<div class="con-left" >
		<div class="tags">
			<h3>标签</h3>
			<a href="" class="tags-item">前端</a>
			<a href="" class="tags-item">ES6</a>
		</div>
	</div>
	<div class="con-right" >
		<!-- <router-view></router-view> -->
		<!-- <div id="app">
			 <my-component v-for="(item ,index) in items"></my-component>
			 <home msg="hello,boy"></home>
		</div> -->
		<ul class="list-ul">
			<li>
				<h2><a href="">aaa</a></h2>
				<p class="subhead">bbb</p>
				<p class="context"><a href="">ccc</a></p>
			</li>
		</ul>

	</div>
</div>

@endsection
@section('js')
	<script type="text/javascript" src=""></script>
@endsection
