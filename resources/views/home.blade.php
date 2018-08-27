@extends('layouts.app')
@section('bodybg')bglogin
@endsection
@section('content')
<style type="text/css">
    .user-list-ul li{
        margin-bottom: 30px
    }
    .user-list-ul h2 a{
        color: #333;
        font-size: 18px
    }
    .user-list-ul .context a{
        font-size: 14px;
        color: #777
    }
    .rt-top-btn{
        float: : right;
        top: -22px;
        right: 0;
        width:80px;
        height: 22px;
        line-height: 22px;
        text-align: center;
        background: #2bc79a;
        font-size: 14px;
        color: #fff;
        border-radius: 6px;
        text-decoration: none;
    }
    a.rt-top-btn:hover{
        color: #fff;
        opacity: .8;
        text-decoration: none;
    }
    .col-md-8 .panel-default{
        min-height: 500px;
    }
    .subhead{
            font-size: 12px;
            color: #aaa;
            margin-bottom: 10px
        }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2 pdt30">
            <div class="panel panel-default pd-20">
                <div class="panel-heading"><a class="rt-top-btn" href="/article/create" style="float: right;">写文章</a>  我的文章 @if (count($lists)>1)<span class="f12 fc-9"> (共{{count($lists)}}篇)</span> @endif</div>
                <div class="panel-body">
                    @if (count($lists)>1)
                        <ul class="user-list-ul">
                            @foreach ($lists as $list)
                                <li>
                                    <h2><a href="/detail/{{$list->id}}" target="_blank">{{$list->title}}</a></h2>
                                    <p class="subhead">@if (!empty($list->username)) {{$list->username}} | @endif 更新时间：{{$list->updated_at}}</p>
                                    <p class="context"><a href="/detail/{{$list->id}}" target="_blank">{{$list->intro}}</a></p>
                                </li>
                            @endforeach
                        </ul>
                    @else
                         <p class="tips">你还没有写文章哦~  &nbsp;&nbsp;&nbsp;&nbsp;</p>
                    @endif
                </div>

                

            </div>
        </div>
    </div>
</div>
@endsection
