
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
		//事件绑定
		function mainEvt(){
			$('button').click(function(e){
				e.preventDefault();
				var _name = $('[name=name]').val(),
					_slug= $('[name=slug]').val(),
					_token = $('input[name=_token]').val(),
					cates = $('#cates');

				var data = {
					name : _name,
					slug: _slug,
					_token : _token
				}
				getData('/article/createcate', 'post', data, function(data){
					if(data.status=='success' && data.data){
						cates.append('<li data-id="'+data.data.id+'"><a href="cates">'+_name+'</a></li>');
					}
				});
			});

			$("#cates li").click(function(){
				var me = $(this),
					_token = $('input[name=_token]').val(),
					_id = me.data('id');

				var data = {
					id : _id,
					_token : _token
				}

				if(confirm("真的要删除此条吗")){//删除
					getData('/article/removecate', 'post', data, function(data){
						if(data.status=='success'){
							me.remove();
						}
					});
				}
			})

		}
	$(function(){
		// axios.get('/getHeader')
		// .then(function (response) {
		// console.log(response);
		// })
		// .catch(function (error) {
		// console.log(error);
		// });

		mainEvt();
		
	})