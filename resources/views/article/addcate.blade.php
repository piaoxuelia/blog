@extends('layouts.app')
@section('bodybg')bglogin
@endsection
@section('content')
<div class="cont-editor">

	<div class="bd-example" data-example-id="">
	<form class="form-inline">
		<div class="form-group">
			{!! csrf_field() !!}
			<input type="text" class="form-control" name="name" placeholder="">
			<input type="text" class="form-control" name="slug" placeholder="">
		</div>
		<button type="submit" class="btn btn-primary">add</button>
	</form>
	</div>
	<div class="pd-t20 pd-b10 border-b fc-6">
		Tips: 点击下面标签可删除
	</div>
	<div class="pd-t20">
		<ul id="cates" class="tags-wrap-normal">
			@foreach ($cates as $cate)
				<li data-id="{{$cate->id}}"><a href="#cate">{{$cate->name}}</a></li>	
			@endforeach
		</ul>
	</div>
</div>


		
@endsection
@section('maincss')

@endsection
@section('js')
	<script type="text/javascript" src="/js/addcate.js"></script>
@endsection