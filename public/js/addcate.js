function getData(t,a,e,n){$.ajax({url:t,method:a,data:e,success:function(t){n(t)}})}function mainEvt(){$("button").click(function(t){t.preventDefault();var a=$("[name=name]").val(),e=$("[name=slug]").val(),n=$("input[name=_token]").val(),c=$("#cates");getData("/article/createcate","post",{name:a,slug:e,_token:n},function(t){"success"==t.status&&t.data&&c.append('<li data-id="'+t.data.id+'"><a href="cates">'+a+"</a></li>")})}),$("#cates li").click(function(){var t=$(this),a=$("input[name=_token]").val(),e=t.data("id"),n={id:e,_token:a};confirm("真的要删除此条吗")&&getData("/article/removecate","post",n,function(a){"success"==a.status&&t.remove()})})}$(function(){mainEvt()});