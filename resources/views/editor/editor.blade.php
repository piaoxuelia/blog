@extends('layouts.app')

@section('content')
<div class="cont-editor">
	<form action="{{ url('/article') }}" method="POST">
		{!! csrf_field() !!}
		<fieldset class="form-group">
		    <label for="exampleInputEmail1">文章标题：</label>
		    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter title">
		    <small class="text-muted"></small>
		</fieldset>
		
   
	    <script id="demo_simple_toolbar" name="content" type="text/plain"><!-- <?php echo htmlspecialchars('自定义工具条展示,自定义高度,自定义宽度');?> --></script>
    <fieldset class="form-group">
    	<div style="padding-top:10px">
	    <input class="btn btn-primary" type="submit" value="提交">
		</div>
    </fieldset>
    </form>
</div>
	
@endsection

@section('js')
@include("zhangmazi::ueditor")
<script>
	$(function(){
	function getUeditorCommonParams() {
	    return {
	        'thumb_appointed' : '0',    //强制缩略图, 1=是,0=否,支持多组,用逗号分隔开,如0,0,0,0
	        'thumb_water' : '0',     //是否水印,1=是,0=否,支持多组,用逗号分隔开,如0,0,0,0
	        'thumb_num' : '1',      //缩略图数量, 跟多组有关联性
	        'thumb_max_width' : '600',  //缩略图最大宽度, 多组用逗号分隔并由小到大,如200,400,800
	        'thumb_max_height' : '2000',//缩略图最大高度, 多组用逗号分隔并由小到大,如200,400,800
	        'ext_type' : '100', //允许上传的扩展名
	        'need_origin_pic' : 0,  //是否保留原图, 1=要, 0=不
	        '_token' : '{{ csrf_token() }}',    //Laravel 校验token用的
	    };
	}
	// var ueditor_toolbars = [
	//     ['fontfamily', 'fontsize', 'forecolor', 'backcolor', 'bold', 'italic', 'underline','strikethrough',
	//         'justifycenter', 'justifyleft', 'justifyright', 'fontborder', 'removeformat', 'link', 'unlink',
	//         'simpleupload', 'lineheight', 'imagecenter', 'preview', 'source', 'fullscreen'
	//     ]
	// ];
	var ueditor_toolbars = [
	    ['simpleupload','insertorderedlist','insertunorderedlist' ,'bold','undo','redo','fullscreen']
	];

	// 生成自定义工具条编辑器
	var ueditor_simple = UE.getEditor('demo_simple_toolbar', {
	    'serverUrl' : '{{ route("zhangmazi_front_ueditor_service", ['_token' => csrf_token()]) }}',
	    'pageBreakTag' : 'editor_page_break_tag',
	    'maximumWords' : 1000000,   //自定义可以输入多少字
	    'toolbars' : ueditor_toolbars,  //采用自定义工具条
	    'autoFloatEnabled' : false,
	    'autoHeightEnabled': true,
	    'enableAutoSave':true,
	    'focus':true,
	    'pasteplain':true,
	    'initialFrameWidth' : 1000,  //自定义宽度
	    'initialFrameHeight' : 300  //自定义高度
	});
	// 附加上其他参数,方便后端业务自主获取用
	ueditor_simple.ready(function() {
	    ueditor_simple.execCommand('serverparam', function(editor) {
	        return getUeditorCommonParams();
	    });
	});
	})
</script>
@endsection