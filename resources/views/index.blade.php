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
		    z-index: 0;
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
			/*transform:translateY(100vh);*/
			transition: .5s ease-in;
			position: relative;
			z-index: 1;
			width: 850px;
			margin:30px auto 0 auto;
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
		.con-tag{
		 }
		 .con-right{
			float: right;
			position: relative;
			width: 76%;
			background: rgba(255,255,255,.95);
			padding: 40px 30px;
			min-height: 500px
		 }
		.tags{
			padding: 0 0 15px;
			border-bottom: 1px solid #f3f3f3;
			margin-bottom: 20px
		}
		.tags a{
			color: #666;
			border:1px solid #eee;
			border-radius: 5px;
			line-height: 20px 10px;
			padding: 0 10px;
			font-size: 14px;
			display: inline-block;
		}
		.tags a:hover{
			color: #000;
			border:1px solid #ccc;
			/*background: #eee*/
		}

		
		.clearfix:after{
			content: "";
			display: block;
			width:100%;
			height: 0px;
			clear: both;
		}
		.subhead{
			font-size: 12px;
			color: #aaa;
			margin-bottom: 10px
		}
		#list-ul li{
			margin-bottom: 30px
		}
		#list-ul h2 a{
			color: #333;
			font-size: 18px
		}
		#list-ul .context a{
			font-size: 14px;
			color: #666
		}
		.rt-top-btn{
			position: absolute;
			top: -22px;
			right: 0;
			width:80px;
			height: 22px;
			line-height: 22px;
			text-align: center;
			background: #2bc79a;
			font-size: 14px;
			color: #fff;
			border-top-left-radius: 6px;
		}
		a.rt-top-btn:hover{
			opacity: .8;
		}
	</style>
@endsection
@section('content')
<div id="bg"></div>
<script type="text/javascript">
	var bodyBgName = 'bg'+Math.floor(Math.random()*2);
	document.getElementById('bg').className = bodyBgName;
</script>

<!-- <div class="wel-line">
	<div class="linetext">
		<span>每天进步一点点，你会发现一个不一样的自己</span>
	</div>
</div> -->



<div class="content clearfix">
	
	<div class="con-right" >
		<a class="rt-top-btn" href="/article/create">写文章</a>
		<div class="con-tag" >
			<div class="tags">
				<h3>分类</h3>
				{!! csrf_field() !!}
				<a href="" class="tags-item" data-id="-1">全部</a>
				@foreach ($cates as $cate)
					<a href="" class="tags-item" data-id="{{$cate->id}}">{{$cate->name}}</a>
				@endforeach
			</div>
		</div>
		<ul id="list-ul">
			@foreach ($lists as $list)
				<li>
					<h2><a href="/detail/{{$list->id}}" target="_blank">{{$list->title}}</a></h2>
					<p class="subhead">@if (!empty($list->username)) {{$list->username}} | @endif 更新时间：{{$list->updated_at}}</p>
					<p class="context"><a href="/detail/{{$list->id}}" target="_blank">{{$list->intro}}</a></p>
				</li>
			@endforeach
		</ul>

	</div>
</div>

@endsection
@section('js')
	<script type="text/javascript">
		$(function  () {

			function getData(url,method,data,callback){
				$.ajax({
					url:url,
					method:method,
					data:data,
					success:function(data){
						callback(data);
					}
				})
			}

			$('.tags-item').click(function(e){
				e.preventDefault();
				var me = $(this);
				var cateId = me.data('id');
				var data = {
					_token : $('input[name=_token]').val(),
					id:me.data('id')
				};

				getData('/index/cates','get',data,function(data){
					console.log(data);
					if(data.lists && data.lists.length){
						renderList(data.lists);
					}else{
						$('#list-ul').html('<li>没有找到相关结果哦~</li>');
					}
					
				});
			});

			function renderList(data){
				var html='';
				for(var i=0; i<data.length; i++){
					var username='';
					if(typeof data[i].username!= 'undefined'){
						username = data[i].username+' | ';
					}
					html+=
					'<li>'+
						'<h2><a href="/detail/'+data[i].id+'" target="_blank">'+data[i].title+'</a></h2>'+
						'<p class="subhead">'+username+' 更新时间：'+data[i].updated_at+'</p>'+
						'<p class="context"><a href="/detail/'+data[i].id+'" target="_blank">'+data[i].intro+'</a></p>'+
					'</li>';
				}
				console.log(html);
				$('#list-ul').html(html);


			}

		})
	</script>
@endsection
