@extends('layouts.frame')
@section('title')
	fetime详情页 
@endsection
@section('maincss')
	<style>
		
		.det-cont{
			width:900px;
			padding: 50px 60px;
			margin:0 auto;
			background: #fff;
			min-height: 600px;
			
		}
		.det-cont h1{
			font-size:22px;
			font-weight: normal;
			text-align: center;
			margin-bottom:6px;
		}
		.det-cont h2{
			font-size:14px;
			font-weight: normal;
			border-top: 1px solid #eaeaea;
			border-bottom: 1px solid #eaeaea;
			padding: 20px 0;
			margin-bottom: 30px;
			color: #999;
		}
		.det-cont .det-article{
			
		}
		.det-article img{
			display: block;
		}
		.up-time{
			text-align: center;
			font-size:12px;
			color: #ddd;
			margin-bottom: 20px
		}
		.det-bg{
			background: #fafafa;
		}
		.top{
			margin-bottom: 30px
		}
		body{
			background-image:url('/img/det-bg.jpg')!important;
			background-size: 100% auto;
		}
	</style>
@endsection
@section('content')


@php
   $article = $article[0];
   $cont=htmlspecialchars_decode($article->content);
@endphp

<div class="det-cont clearfix">
	<h1>{{$article->title}}</h1>
	<p class="up-time">@if (!empty($article->username)) {{$article->username}} | @endif 更新时间：{{$article->updated_at}}</p>
	<h2>{{$article->intro}}</h2>
	<div class="det-article">{!!$article->content!!}</div>
			
		
	
</div>

@endsection
@section('js')
	
@endsection
