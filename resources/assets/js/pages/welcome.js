//展示列表
function showList(){
	var cont = $(".content");
	cont.addClass('moveIn');
	$('body').addClass('slide-up');
}

//事件绑定
function mainEvt(){
	$('.nav-item').click(function(e){
		e.preventDefault();
		showList();
	});

	var isScroll = true;
	var scrollDown = true;
	var hisScroll = $(window).scrollTop();

	var wheelTimer = null;
	$(document).on('mousewheel',function(event){
		clearTimeout(wheelTimer);
		wheelTimer = setTimeout(function(){
			if(isScroll){ //如果处于全屏的状态
				var scrTop = $(window).scrollTop();
				var disScroll = scrTop - hisScroll;
				hisScroll = scrTop;
				if(disScroll<=0){ // <0,说明是向上滚动
					scrollDown = false;
				}else{
					if(scrTop > 0 ){
						showList();
						window.scrollTo(0,0);
						isScroll = false;
					}
				}
				
			}
		},100)
	})

}
$(function(){

	mainEvt();

})