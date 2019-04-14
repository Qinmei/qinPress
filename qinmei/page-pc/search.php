<?php get_header(); ?>
<style>
    main{
    background-color: rgba(0,0,0,0.03);
  }
   .new-con-panel{
    border:none;
    margin: 0 15px;
  }
  .pc-new-con-main {
    padding-top: 0;
  }
  .new-panel-list{
  }
  .new-panel-list-img {

    background-size: cover;
  }
  .new-panel-list {
    box-shadow: none;
    background-color: white;
    border: solid 1px rgba(0,0,0,0.05);
    box-shadow: 0 0 3px rgba(0,0,0,0.1);
  }
  .new-panel-list-content {
    padding: 15px;
    overflow: hidden;
    width: calc(100% - 256px);
  }
  .list-content-main p{
    text-overflow: ellipsis;
  }
  .new-panel-list-content-header{
    display: flex;
    justify-content: space-between;
    align-items: center;
  }
  .new-panel-list-content .list-content-title{
    width: auto;
  }
  .new-con-panel2-right{
    width: 100%;
    padding-top: 15px;
    border-left: solid 1px rgba(0,0,0,0.1);
  }
  .new-con-panel2 .new-item-list-right-li{
    width: calc((100% - 90px)/6);
  }
  .new-time-nobreak-list{
    justify-content: flex-start;
  }
  .new-con-panel2 .new-time-nobreak-list{
    margin-top: 15px;
  }
  .new-time-list-left, .new-time-list-left2{
    width: 100px;
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
  .index-table-list-title {
    display: none;
  }
  .listblock{
    display: flex;
    flex-wrap: wrap;
  }
  .listblock .new-panel-list{
    width: calc((100% - 75px)/6);
    margin-right: 15px;
    height: auto;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    align-items: center;
    box-shadow: none;
  }
  .listblock .new-panel-list:nth-child(6n){
    margin-right: 0;
  }
  .listblock .index-table-list-title {
    display: inline-block;
    margin:10px 0;
  }
  .listblock a{
    width: 100%;
    display: inline-block;
  }
  .listblock .new-panel-list-img{
    width: 100%;
    height: 0;
    padding-bottom: 130%;
    border-radius: 5px;
  }
  .listblock .new-panel-list-content{
    display: none;
  }
  .nav-list-icon-switch{
    float: right;
    width: 80px;
    height: 40px;
    display: flex;
    justify-content: space-around;
    align-items: center;
  }
  .nav-list-icon-switch span{
    width: 30px;
    height: 30px;
    color: grey;
    font-size: 1.2em;
    text-align: center;
    line-height: 30px;
    cursor: pointer;
    
  }
  .nav-list-icon-switch span.active{
    background-color: rgba(0,0,0,0.1);
}
.list-content-main{
  height: 190px;
}
</style>

<div class="container">
	<div class="pc-new-top-img"><div class="pc-new-top-img-bg" style="background-image: url(<?php $general_options = get_option('ashuwp_general');echo $general_options['qinmei_base_search_img']; ?>)">
			<div class="pc-new-top-head">
				搜索:<span></span>
			</div>
		</div>
	</div>

	<div class="pc-new-con">
		<div class="pc-new-con-nav">
			<div class="new-nav-list active">搜索结果</div>
			<div class="nav-list-icon-switch">
				<span class="active"><i class="fa fa-list-ul" aria-hidden="true"></i></span>
        <span><i class="fa fa-th-large" aria-hidden="true"></i></span>
			</div>
		</div>
		<div class="pc-new-con-main">
			<div class="new-con-panel">
				<div class="discuss-con-panel">
						<?php
				   		 if (have_posts() ) {
					        while (have_posts() ) :the_post();?>
				            <div class="new-panel-list">
				            	<a href="<?php the_permalink() ?>"><div class="new-panel-list-img" style="background-image: url(<?php echo get_post_meta($post->ID,"baseinfo_img_link",true); ?>);">
				            	</div></a>
				            	<p class="index-table-list-title text-center"><?php the_title(); ?></p>
				            	<div class="new-panel-list-content">
				            		<div class="new-panel-list-content-header">
					            		<a  class="list-content-title" href="<?php the_permalink() ?>"><?php the_title(); ?></a>
				            		</div>
                                  
                                  <div class="list-content-tag">
					            			<span>标签：</span>
					            			<?php $animatetags = wp_get_object_terms( $post->ID,  'animatetag' );
                              foreach ( $animatetags as $tag ) {
                              echo '<a>'.$tag->name.'</a>';
                            }?>
					            		</div>

				            		<div class="list-content-main">
				            			<span>简介：</span>
				            			<div class="con">
				            				<?php echo get_post_meta($post->ID,"baseinfo_introduce",true);?>
				            			</div>
				            		</div>

				            	</div>
				            </div>
				     <?php endwhile;}?>
				     <?php wp_reset_postdata();; ?>
					</div>
				<div class="col-md-12 display-box">
					<?php if ( function_exists('dw_pagination') ) { dw_pagination(); } ?>
				</div>
			</div>

		</div>
	</div>
</div>
<script>
$(function() {
	$(".nav-list-icon-switch span").click(function(){
		$(this).addClass('active');
		$(this).siblings().removeClass("active");
		$(".discuss-con-panel").toggleClass("listblock");
	});
});

  $(function(){
  var link =  window.location.href;
  var linkarr = link.split("=");
  link = decodeURI(linkarr[1]);
  $('.pc-new-top-head span').html(link);
  if(link ==""){return};
  if(localStorage.playHistory == undefined ){
   	var history = [];
  }else{
    var history = JSON.parse(localStorage.playHistory);
  };
  if(history.length == 0){
    history.push(link);
  }else{
    for(var i=0;i< history.length;i++){
    	if(link == history[i]){
          history.splice(i, 1);
        }
    };
    if(history.length == 6){
     	history.pop();
    };
    history.unshift(link);
  };
  localStorage.playHistory = JSON.stringify(history);
});
</script>
<?php get_footer();?>
