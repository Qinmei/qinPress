<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php
	if ( is_home() ) {
		bloginfo('name'); echo " - "; bloginfo('description');
	} elseif ( is_category() ) {
		single_cat_title(); echo " - "; bloginfo('name');
	} elseif (is_single() ) {
  		single_post_title();echo " - "; bloginfo('name');
	} elseif (is_search() ) {
		echo "搜索结果"; echo " - "; bloginfo('name');
	} elseif (is_404() ) {
		echo '页面未找到!';
  	} elseif (is_page() ) {
  		single_post_title();echo " - "; bloginfo('name');
	} else {
		wp_title('',true);
	} ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="theme-color" content="#4285f4">
<meta name="msapplication-navbutton-color" content="#4285f4">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/font/fontawesome/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/bootstrap.css">
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/style.css">
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/pc.css">
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery-1.12.0.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery-ias.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/main001.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/comments-ajax.js"></script>
<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "<?php
	$general_options = get_option('ashuwp_general');
	echo $general_options['tab9_tongji_link'];?>";
  var s = document.getElementsByTagName("script")[0];
  s.parentNode.insertBefore(hm, s);
})();
</script>

</head>
<body>
	<header>
		<div class="pc-nav" style="background-color: <?php
						$general_options = get_option('ashuwp_general');
						echo $general_options['qinmei_base_color'];?>">
				<div class="pc-nav-con">
					<div class="pc-nav-logo" title="主页">
						<a href="/"><i class="fa fa-snowflake-o" aria-hidden="true"></i></a>
					</div>
					<div class="pc-nav-main">
						<div class="pc-nav-show">
							<a href="/"><div class="pc-nav-list">主页</div></a>
                          	<a href="http://vue.qinmei.org"><div class="pc-nav-list">vue主题</div></a>
							<a href="/new"><div class="pc-nav-list">新番</div></a>
							<a href="/recommend"><div class="pc-nav-list">推荐</div></a>
							<a href="/topic"><div class="pc-nav-list">专题</div></a>
							<a href="/discuss"><div class="pc-nav-list">动态</div></a>
							<a href="/all"><div class="pc-nav-list">全部</div></a>
							<a href="/animatekind/fun"><div class="pc-nav-list">搞笑</div></a>
							<a href="/animatekind/fight"><div class="pc-nav-list">战斗</div></a>
							<a href="/animatekind/daily"><div class="pc-nav-list">日常</div></a>
							<a href="/animatekind/depress"><div class="pc-nav-list">致郁</div></a>
							<a href="/animatekind/cure"><div class="pc-nav-list">治愈</div></a>
							<a href="/animatekind/world"><div class="pc-nav-list">异界</div></a>
							<div class="pc-nav-list pc-nav-search"><i class="fa fa-search" aria-hidden="true"></i></div>
						</div>

						<div class="pc-nav-search-bar">
							<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
								<input type="text"  placeholder="darling in the franxx" name="s" autocomplete="off">
							</form>
							<div class="pc-nav-search-panel" style="background-color: <?php echo $general_options['qinmei_base_color'];?>;opacity: 0.8;">
								<div class="search-hot-list-top">热门搜索</div>
								<?php
									if(empty($general_options['tab7_modules'])){
										echo '<a href="/N037"><div class="search-hot-list">东京喰种</div></a>
								<a href="/N102"><div class="search-hot-list">国家队</div></a>
								<a href="/N108"><div class="search-hot-list">紫罗兰永恒花园</div></a>
								<a href="/N105"><div class="search-hot-list">Overlord</div></a>
								<a href="/N001"><div class="search-hot-list">进击的巨人</div></a>
								<a href="/N025"><div class="search-hot-list">一拳超人</div></a>
								<a href="/N054"><div class="search-hot-list">超电磁炮</div></a>
								<a href="/N032"><div class="search-hot-list">刀剑神域</div></a>';
									}else{
									foreach($general_options['tab7_modules'] as $list){?>
									<a href="<?php echo $list['tab7_modules_link']; ?>"><div class="search-hot-list"><?php echo $list['tab7_modules_title']; ?></div></a>
									<?php }}?>

							</div>
							<div class="fixed-bg"></div>
							<div class="pc-nav-search-close"><i class="fa fa-times" aria-hidden="true"></i></div>
						</div>
					</div>
					<div class="pc-nav-user" title="用户中心">
						<a href="/user"><i class="fa fa-modx" aria-hidden="true"></i></a>
					</div>

				</div>
		</div>
			<script>
				$(".pc-nav-search").click(function(){
				  	$(".pc-nav-show").fadeOut();
				  	$(".pc-nav-search-bar").fadeIn();
				  	$(".pc-nav-search-bar input").focus();
				});
				$(".fixed-bg").click(function(){
				  	$(".pc-nav-show").fadeIn();
				  	$(".pc-nav-search-bar").fadeOut();
				});
				$(".pc-nav-search-close").click(function(){
				  	$(".pc-nav-show").fadeIn();
				  	$(".pc-nav-search-bar").fadeOut();
				});
				$(".pc-nav-search-bar").bind('input porpertychange',function(){
					if($(".pc-nav-search-bar input").val() !=""){
						$(".pc-nav-search-panel").fadeOut();
					}else{
						$(".pc-nav-search-panel").fadeIn();
					}
				});
				$(window).scroll(function(){
					if($(".fixed-bg").is(":visible")){
						$(".pc-nav-show").fadeIn();
				  		$(".pc-nav-search-bar").fadeOut();
					}
				});
				var link= location.href;
				var navlist  = $(".pc-nav-show a");
				for (var i = 1; i < navlist.length; i++) {
					if(link.indexOf(navlist.eq(i).attr("href")) != -1){
						navlist.eq(i).children().addClass("active");
					}
				}
			</script>
	</header>
	<main>
