function showList(){$(".content").addClass("moveIn"),$("body").addClass("slide-up")}function mainEvt(){$(".nav-item").click(function(o){o.preventDefault(),showList()});var o=!0,n=!0,i=$(window).scrollTop(),t=null;$(document).on("mousewheel",function(s){clearTimeout(t),t=setTimeout(function(){if(o){var t=$(window).scrollTop(),s=t-i;i=t,s<=0?n=!1:t>0&&(showList(),window.scrollTo(0,0),o=!1)}},100)})}$(function(){mainEvt()});