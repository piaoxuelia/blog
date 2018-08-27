@extends('layouts.app')
@section('bodybg')bglogin
@endsection
@section('content')
<style type="text/css">
	.cont-editor{
		background: rgba(255,255,255,.6);
		padding: 40px
	}
</style>
<div class="cont-editor">
	<form action="{{ url('article/store') }}" method="POST">
		{!! csrf_field() !!}
		<fieldset class="form-group">
			<label for="article-title">文章标题：<span class="f12 fc-9">(6~50个字)</span><small class="ml-10 text-danger"></small></label>
			<input type="text" name="title" class="form-control js-vali-text" id="article-title" data-min="6" data-max="50" placeholder="">
		</fieldset>
		<fieldset class="form-group">
			<label for="article-intro">简介：<span class="f12 fc-9">(10~200个字)<small class="ml-10 text-danger"></small></label>
			<textarea id="article-intro" class="form-control  js-vali-text" name="intro" data-min="10" data-max="200" ></textarea>
		</fieldset>
		<fieldset class="form-group" id="article-cate">
			<label>所属分类：<small class="ml-10 text-danger"></small></label>
			<div class="checkbox">
			@foreach ($cates as $cate)
				 <label>
					<input type="checkbox" value="{{$cate->id}}">{{$cate->name}}
				</label>
			@endforeach
			</div>
			
		</fieldset>
		<fieldset class="form-group" id="editor-text" data-max="80000" data-min="30">
			<label for="article-intro">具体描述：<span class="f12 fc-9">(30~80000个字)</span><small class="ml-10 text-danger"></small></label>
			<script id="demo_simple_toolbar" name="content" type="text/plain"></script>

		</fieldset>
		<fieldset class="form-group">
			<div style="padding-top:10px">
			<input class="btn btn-primary" type="submit" id="submit-article" value="提交"><small class="ml-10 text-success"></small>
			</div>
		</fieldset>
	</form>
	

</div>
 @foreach ($errors->all() as $error)
	<li>{{ $error }}</li>
@endforeach

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
		window.ueditor_simple = UE.getEditor('demo_simple_toolbar', {
			'serverUrl' : '{{ route("zhangmazi_front_ueditor_service", ['_token' => csrf_token()]) }}',
			'pageBreakTag' : 'editor_page_break_tag',
			'maximumWords' : 8000,   //自定义可以输入多少字
			'toolbars' : ueditor_toolbars,  //采用自定义工具条
			'autoFloatEnabled' : false,
			'autoHeightEnabled': true,
			'enableAutoSave':true,
			'focus':true,
			'pasteplain':true,
			'initialFrameWidth' : 920,  //自定义宽度
			'initialFrameHeight' : 300  //自定义高度
		});
		// 附加上其他参数,方便后端业务自主获取用
		ueditor_simple.ready(function() {
			ueditor_simple.execCommand('serverparam', function(editor) {
				return getUeditorCommonParams();
			});
		});

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

		function validateText(node, num){
			var _max = node.data('max'),
				_min = node.data('min');
			if(num > _max){
				showTips(node,'字数超出了哦~');
				return false;
			}else if(num < _min){
				showTips(node,'字数不足哦~');
				return false;
			}
			return true;
		}
		function getCheckVal(wrap){
			var arr=[];
			$('input[type=checkbox]',wrap).each(function(){
				var me=$(this);
				if(me.prop('checked')){
					arr.push(me.val());
				}
			})

			if(arr.length){
				return arr.join(',');
			}else{
				var _node = wrap.find('.text-danger');
				showNormalTip(_node,'请至少选择一个分类');
				return false;
			}
		}

		function valieditor(editorWrap, content){
			var _max = editorWrap.data('max'),
				_min = editorWrap.data('min'),
				_num = content.length,
				_node = editorWrap.find('.text-danger');
			if(content){//有内容
				if(_num > _max){
					showNormalTip(_node,'字数超出了哦~');
					return false;
				}else if(_num < _min){
					showNormalTip(_node,'字数不足哦~');
					return false;
				}
				return true;
			}else{
				showNormalTip(_node,'请输入详细内容~');
				return false;
			}
		}
		function hideTips(){
			setTimeout(function(){
				$('.text-danger').text('');
				$('.has-warning').removeClass('has-warning');
			},3000);
			
		}
		function showTips(node, msg){
			var msg = msg || '';
			if(msg){
				node.parent().addClass('has-warning').find('.text-danger').text(msg);
			}else{
				node.parent().find('.text-danger').text(msg);
			}
			hideTips();
		}

		function showNormalTip(node, msg){
			var msg = msg || '';
			if(msg){
				node.text(msg);
			}else{
				node.text(msg);
			}
			hideTips();
		}

		$('.form-control').on('focus',function(){
			$(this).parent().removeClass('has-warning');
			showTips($(this),'');
		});



		$('.js-vali-text').on('blur',function(){
			var me = $(this);
			var _val = me.val()
			if(_val){
				validateText(me,_val.length);
			}else{
				showTips(me,'请输入文字');
			}
		});

		$("#submit-article").click(function(e){
			e.preventDefault();
			var me = $(this);
			$('.js-vali-text').each(function(){
				if(!validateText($(this),$(this).val().length)){
					return false;
				}
			});
			var _checkVal = getCheckVal($("#article-cate"));
			var _content = ueditor_simple.getContent();

			if(!valieditor($('#editor-text'),_content)) {
				return false;
			}

			if(!_checkVal){
				return false;
			}
			var data = {
				_token : $('input[name=_token]').val(),
				title : $('#article-title').val(),
				intro :$('#article-intro').val(),
				cover:_checkVal,//cover暂时存储所属的分类
				content:_content
			};
			getData('/article/store1','post',data,function(data){
				if(data.status=='success'){
					me.siblings('.text-success').text('发布成功');
					setTimeout(function(){
						location.reload();
					},1000)
				}
			})
			

		})
	})
</script>
@endsection

