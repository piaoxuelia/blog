@extends('layouts.app')
@section('content')
<div class="cont-editor">
	@foreach ($articles as $article)
	    <li>{{$article->title}}</li>
	@endforeach
</div>

@endsection
