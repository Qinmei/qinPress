

$(function(){

		var i = 0;
		var pic = $(".main-picture ul li");
		var size = pic.size();
		var slideWide = $(".main-pic-container").width();
    	var img = $(".main-picture img");
		img.css("width",slideWide);
  		var clone = pic.first().clone();
		
		$(".main-picture ul").append(clone);
		for(var j=0;j<size;j++){
			$(".main-list ul").append("<li></li>");
		}
		$(".main-list ul li").first().addClass("active");

		
		$(window).resize(function() {
		  $(".main-picture img").css("width",slideWide);
		});

		function move(){
			if(i == size+1){
				$(".main-picture").css({left:0});
				i = 1;
			}else if(i == -1){
				$(".main-picture").css({left:- size*slideWide});
				i  = size-1;
			};
			$(".main-picture").stop().animate({left:-i*slideWide},slideWide);
			if( i == size){
				index = 0;
			}else{
				index = i;
			}
			$(".main-list ul li").eq(index).addClass("active").siblings().removeClass("active");

		}

		$(".main-list ul li").hover(function(){
			$(this).addClass("active").siblings().removeClass("active");
			var index = $(this).index();
			i = index;
			move();
		});

		var t=setInterval(function(){
			i++;
			move()
			},3000);

		$(".main-pic-container").hover(function(){
			clearInterval(t);
		},function(){
			t=setInterval(function(){
			i++;
			move()
			},3000)
		});


});


  $(function(){

		var playlist = $(".index-hot-play");
		var playPage = $(".index-play-page .row");
        function show(data){
          playlist.removeClass("active");
			data.addClass("active");
			num = data.parents().index();
			playPage.removeClass("active");
			playPage.eq(num).addClass("active");
        }
		playlist.click(function(){
			show($(this));
		});
	    
    
       var d=new Date();
	   var dayNum = d.getDay() -1;
       $('.index-date').eq(dayNum).addClass("active");
	   $('.index-date-page .row').eq(dayNum).addClass("active");
	  
	  	var timeList = $(".day-list-none");
	  	var now = new Date();
		now.setHours(0);
	  	now.setMinutes(0);
	  	now.setSeconds(0);
	 	var nowTime = now.getTime();
	  	var daytime = 24*60*60*1000;
	  	if(dayNum == '-1'){var daycount = 6}else{var daycount= dayNum};
	  	nowTime = nowTime - daytime * (daycount);
		
	  for(var i = 0;i<timeList.length;i++){
	    var time2 =  timeList.eq(i);
	    time2 = time2.html();
	  	var arr = time2.split('T');
	  	var arr2 = arr[1].split('+');
	  	var arr = arr[0].split('-');
	  	var arr2 = arr2[0].split(':');
	  	var publishTime = new Date();
	  	publishTime.setYear(arr[0]);
	    publishTime.setMonth(arr[1]-1);
	    publishTime.setDate(arr[2]);
	    publishTime.setHours(arr2[0]);
	    publishTime.setMinutes(arr2[1]);
	    publishTime.setSeconds(arr2[2]);
	  	var posttime = publishTime.getTime();
	  	if(posttime>nowTime){
	  	timeList.eq(i).parent().css('background-color','#ce669b');
	  }
	}
        
     var length = $(".page-cat-num .col-md-2");
      if(length.size() < 3){
        length.removeClass("col-sm-2 col-xs-2").addClass("col-sm-3 col-xs-6");
      }else if (length.size() < 5){
        length.removeClass("col-sm-2 col-xs-2").addClass("col-sm-3 col-xs-3");
      }else{
        length.removeClass("col-sm-2 col-xs-2").addClass("col-sm-2 col-xs-2");
      };

        
  });  		



$(function(){
	if(localStorage.danmu == 0){
          $('.video-list-danmu').children('.html5-menu-list-content').removeClass('active');
          $('.video-danmu-display').addClass('hiden');
	}else{
    	$('.video-list-danmu').children('.html5-menu-list-content').addClass('active');
          $('.video-danmu-display').removeClass('hiden');
    };
    if(localStorage.autoplay == 0){
          $('.video-list-autoplay').children('.html5-menu-list-content').removeClass('active');
	}else{
      	  $('.video-list-autoplay').children('.html5-menu-list-content').addClass('active');
    };
}); 

$(function(){
  var link = window.location.href;
  link = link.split('#')[0];
  var linkTop = $('.mobile-nav a');
  for(i = 0;i<linkTop.length;i++){
    if(link == linkTop.eq(i).attr('href')){
      linkTop.eq(i).children().children().addClass('active');
      linkTop.eq(i).siblings().children().children().removeClass('active');
    };
  };
});  

$(function () {
  $("a[id^='delete-']").click(function(){
    var link = $(this).data('url');
    var that = $(this).parent();
    if($(".comments-top-ding-dot").length>0){
    	that = $(this).parents(".mobile-comments");
    }
     $.ajax({  
            type:"GET",
            cache:false,
            url:link,   
            success: function(data){
                that.remove();
            }
        });
  });
$(function(){
    var tab = $(".new-nav-list");
    var panel = $(".new-con-panel");
    tab.click(function(){
      if($(this).hasClass("active")){}
        else{
	      var index = $(this).index();
	      tab.removeClass("active");      
	      $(this).addClass("active");
	      panel.hide();
	      panel.eq(index).fadeIn();
      }
    });
});
});

//设定commentLike函数
$.fn.commentLike = function () {
    if ($(this).hasClass('done')) {
        //如果此处有done类，就提醒“您已赞过本博客”，并return false当做什么也没发生。
alert('您已赞过此评论');
        return false;
    } else {
        //如果此处无done类，则马上添加一个done类
$(this).addClass('done');
        //从当前的a链接的data-id属性中获取id值和action值
var id = $(this).data("id"),
            action = $(this).data('action'),
            rateHolder = $(this).children('.count');
        //准备ajax的数据
var ajax_data = {
            action: "pinglun_zan",
            um_id: id,
            um_action: action
};
        var url = window.location.href;
        //如果当前url地址的("//localhost/") > 0，则去掉它。
url.indexOf("//localhost/") > 0 ? url = url.replace(/localhost\//, '') : false;
        //如果当前页面url路径包含3层目录则调用../../wp-admin/admin-ajax.php，2层调用../wp-admin/admin-ajax.php，1层调用wp-admin/admin-ajax.php
if (url.split("/").length = 6) {
            $.post('../../wp-admin/admin-ajax.php', ajax_data,
                function (data) {
                    $(rateHolder).html(data);
                });
            //要return false，否则会多次提交，数据不准确
return false;
        }
        if (url.split("/").length = 5) {
            $.post('../wp-admin/admin-ajax.php', ajax_data,
                function (data) {
                    $(rateHolder).html(data);
                });
            //要return false，否则会多次提交，数据不准确
return false;
        }
        if (url.split("/").length = 4) {
            $.post('wp-admin/admin-ajax.php', ajax_data,
                function (data) {
                    $(rateHolder).html(data);
                });
            //要return false，否则会多次提交，数据不准确
return false;
        }
    }
};
//当a.pinglunZan被点击时调用commentLike函数
$(document).on("click", "a.pinglunZan", function () {
    $(this).commentLike();
});
