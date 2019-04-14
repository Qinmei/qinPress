<?php get_header(); ?>
<?php if (have_posts()) : the_post(); update_post_caches($posts); ?>
<style>
	main{
    background-color: rgba(0,0,0,0.03);
  }
  .discuss-nav-list{
  	width: auto;
  }
  .pc-discuss-con-right{
  	padding:0;
  }
  .pc-discuss-user {
   height: auto;
    padding: 0 15px 15px 15px;
  }
  .pc-discuss-con-right{
  	height: auto;
  }
  .pc-discuss-user-info {
    width: 100%;
    min-height: 80px;
    margin-top: 0;
    border-radius: 5px;
    padding: 15px;
    background-color: rgba(0,0,0,0.05);
}
.discuss-con-panel{
	border-radius: 5px;
	background-color: white;
	padding:15px;
}
.discuss-con-panel{
	line-height: 1.8;
}
.discuss-con-panel p{
	margin: 15px 0;
}
.discuss-con-panel h1,.discuss-con-panel h2,.discuss-con-panel h3,.discuss-con-panel h4,.discuss-con-panel h5{
	margin: 15px 0;
	display: flex;
    justify-content: flex-start;
    align-items: center;
    background-color: rgba(0,0,0,0.04);
}
.discuss-con-panel img{
	max-width: 100%;
	border-radius: 3px;
	padding:3px;
	border: solid 1px rgba(0,0,0,0.1);
	margin: 0 auto;
	display: inherit;
}
.discuss-con-panel h3::before{
	content: "";
    display: inline-block;
    width: 8px;
    height: 1.3em;
    background-color: rgba(0,0,0,0.5);
    margin-right: 15px;
}
.comments-zone{
	margin-top: 15px;
}
.comments-children .form-submit{
  	display: flex;
  }
  .pc-discuss-location{
  	position: relative;
  }
  .pc-discuss-commentload{
  	display: none;
	position: absolute;
    right: 0;
    line-height: 33px;
    height: 33px;
    top: 0;
    padding: 0 15px;
    background-color: rgba(0,0,0,0.2);
    border-radius: 5px;

  }
  .pc-discuss-commenterror{
  	display: none;
	position: absolute;
    right: 0;
    line-height: 33px;
    height: 33px;
    top: 0;
    padding: 0 15px;
    background-color: rgba(0,0,0,0.2);
    border-radius: 5px;
  }
  .ias-noneleft{
  	font-weight: bold;
    width: 100%;
    margin: 15px 0 0;
    background-color: white;
    border-radius: 5px;
    text-align: center;
    padding: 10px;
    color: rgba(0,0,0,0.4);
  }
  .pc-discuss-login{
  	float: right;
    margin-top: 10px;
    margin-right: 10px;
    padding: 8px 15px;
    background-color: rgba(0,0,0,0.8);
    color: rgba(255,255,255,0.8);
    border-radius: 5px
  }
  .pc-discuss-nav-head a{
  	color: white;
  }
  .comment-reply-title{
  	display: none !important;
  }
  .user-info-logo img{
  	max-width: 100%;
	border-radius:0;
	padding:0;
	border: none;
	margin: 0 auto;
	display: inherit;
  }
  .comments-zone{
  	margin-top: 0;
  }
  .discuss-con-panel-2{
  	padding: 0 15px 15px 15px;
  }
  .pc-discuss-writting{
  	cursor: pointer;
  }
  .play-history-con{
  	width: 100%;
  	height: auto;
  	padding: 15px;
  }
  .play-history-con a{
  	color: rgba(0,0,0,0.75);
  }
  .play-history-list{
  	width: 100%;
  	height: 40px;
  	padding:0 30px;
  	line-height: 40px;
		display:flex;
		justify-content: space-between;
  }
  .play-history-list:hover{
  	background-color: rgba(0,0,0,0.1);
  }
</style>

<div class="container">
	<div class="pc-new-top-img">
		<div class="pc-new-top-img-bg" style="background-image: url(<?php echo get_post_meta($post->ID,'page_tab_head_img',true); ?>)"><div class="pc-new-top-head">
				播放记录
			</div>
		</div>
	</div>


	<div class="pc-discuss-con">
		<div class="pc-discuss-con-left">
			<div class="pc-discuss-con-nav comments-zone ">
				<div class="pc-discuss-nav-head">
					<div class="discuss-nav-list">历史记录</div>
					<div class="pc-discuss-writting">清除所有</div>
				</div>
				<div class="play-history-con">

				</div>
			</div>
		</div>

		<div class="pc-discuss-con-right">
			<div class="pc-discuss-con-nav">
				<div class="pc-discuss-nav-head">
					<div class="discuss-nav-list">说明</div>
				</div>
			</div>
			<div class="discuss-con-panel discuss-con-panel-2">
					此处仅为本地同步，若删除浏览器缓存则清空，云端同步功能暂未开发
			</div>
		</div>
	</div>
</div>
<script>
$(function(){
    if(localStorage.record == undefined ){
      $('.play-history-con').append('<p style="text-align:center">暂无历史记录</p>');
    }else{
    var showHistory = JSON.parse(localStorage.record);
		var text1 = '<a class="play-history-list-link" href="';
    var text2 = '"><div class="play-history-list">';
		var text3 = '</div></a>';
		var span1 = '<span>';
		var span2 = '</span>';
    var node = '';
    for(var i =0;i<showHistory.length;i++){
      var s1 = showHistory[i][0];
      var s2 = showHistory[i][1];
			var s3 = showHistory[i][2];
			var s4 = showHistory[i][3];
      var textall = text1 + s1 + text2 + span1+s2+'第'+s3+'话'+span2+span1+s4+span2 + text3;
      node += textall;
    };
    $('.play-history-con').append(node);
	};
  $('.pc-discuss-writting').click(function(){
    localStorage.removeItem('record');
    $('.play-history-list').remove();
  });
});
</script>
<?php else : ?>
<?php endif; ?>
<?php get_footer();?>
