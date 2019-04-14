<?php get_header(); ?>
<?php if (have_posts()) : the_post(); update_post_caches($posts); ?>
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
  height: 200px;
}
 .list-content-main{
  display: flex;
  flex-direction: column;
  justify-content: flex-start;
  align-items: flex-start;
 }
</style>

<div class="container">
	<div class="pc-new-top-img">
		<div class="pc-new-top-img-bg" style="background-image: url(<?php bloginfo('template_url')?>/images/<?php echo strip_tags(category_description()); ?>);">
			<div class="pc-new-top-head">
				<?php single_cat_title();?>番剧
			</div>
		</div>
	</div>

	<div class="pc-new-con">
		<div class="pc-new-con-nav">
			<div class="new-nav-list active">所有列表</div>
			<div class="new-nav-list">最近更新</div>
			<div class="new-nav-list">评分排行</div>
			<div class="nav-list-icon-switch">
				<span class="active"><i class="fa fa-list-ul" aria-hidden="true"></i></span>
				<span><i class="fa fa-th-large" aria-hidden="true"></i></span>
			</div>
		</div>
		<div class="pc-new-con-main">
			<div class="new-con-panel">
				<div class="discuss-con-panel">
						<?php

            $now_slug = get_query_var('animatekind');
				   			$args = array(
							    'orderby' => 'title',
							    'post_type' => 'animate',
							    'order'=>'ASC',
                  'tax_query' => array(
                       array(
                       'taxonomy' => 'animatekind',
                       'field' => 'slug',
                       'terms' => array($now_slug),
                       'operator' => 'IN'
                       )),
							    'paged' => get_query_var( 'paged' )
							);
							$the_query = new WP_Query( $args );
							$wp_query = NULL;
							$wp_query = $the_query;
							if ( $total_pages > 1) {
							    $the_paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
							}
				   		 if ( $the_query->have_posts() ) {
					        while ( $the_query->have_posts() ) : $the_query->the_post();?>
				            <div class="new-panel-list">
				            	<a href="<?php the_permalink() ?>"><div class="new-panel-list-img" style="background-image: url(<?php echo get_post_meta($post->ID,"baseinfo_img_link",true); ?>);">
				            	</div></a>
				            	<p class="index-table-list-title text-center"><?php the_title(); ?></p>
				            	<div class="new-panel-list-content">
				            		<div class="new-panel-list-content-header">
					            		<a  class="list-content-title" href="<?php the_permalink() ?>"><?php the_title(); ?></a>
				            		</div>

				            		<div class="list-content-main">
                          <div class="list-content-tag">
                            <span>标签：</span>
                            <?php $animatetags = wp_get_object_terms( $post->ID,  'animatetag' );
                              $tagcount = 0;
                                foreach ( $animatetags as $tag ) {
                                  $tagcount++;
                                  if($tagcount < 5){

                                                echo '<a>'.$tag->name.'</a>';
                                        }
                                }?>
                          </div>
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

			<div class="new-con-panel new-con-panel2" style="display: none;">

             	<?php
					$prev = 0;
					$listnum = 0;
					$prevlistnum = 1;
					$liststart = '<div class="new-time-nobreak-list">';
					$breaklist = '<div class="new-time-list-right">';
					$the_query = new WP_Query( array(
                    	'post_type' => 'animate',
                        'showposts' => 30,
                        'tax_query' => array(
                       array(
                       'taxonomy' => 'animatekind',
                       'field' => 'slug',
                       'terms' => array($now_slug),
                       'operator' => 'IN'
                       )),
                        'orderby' => 'time',
                ));
                while ($the_query->have_posts()) : $the_query->the_post();
                	$img =  get_post_meta($post->ID,"baseinfo_img_link",true);
	                $now =  get_the_time('n 月 j 日');
	                $datetime = '<div class="new-time-list-left2"><span></span>'.$now.'</div>';
	                $list = '<div class="new-item-list-right-li">
								<a href="'.get_the_permalink().'"><div class="index-table-list">
								<img src="'.$img.'"></div></a>
								<p class="text-center">'.get_the_title().'</p>
							</div>';
	                if($now != $prev ){
	                			$listnum = $listnum + 1;
		                		$conlist = $liststart.$datetime.$breaklist.$list;
		                		if($prevlistnum != $listnum){
								$right_start = $right_start.'</div></div>';
								}
		                		$right_start = $right_start.$conlist;
					}else{
		                	$right_start = $right_start.$list;
					};
					$prev = $now;
					$prevlistnum = $listnum;
				endwhile;
						$right_start = $right_start.'</div></div>';

				?>
             	<?php wp_reset_postdata();?>
             	<div class="new-con-panel2-right">
					<?php echo $right_start;?>
             	</div>
			</div>

			<div class="new-con-panel" style="display: none;">
          <?php
            $general_options = get_option('ashuwp_general');
            $args = array('post_type' => 'animate',
                    'tax_query' => array(
                       array(
                       'taxonomy' => 'animatekind',
                       'field' => 'slug',
                       'terms' => array($now_slug),
                       'operator' => 'IN'
                       )),
                    'orderby'   => array(
                        'meta_value_num'=>'DESC'
                    ),
                    'meta_key'  => 'baseinfo_rate',);
          $techs = new WP_Query( $args );
           if ( $techs -> have_posts() ) {
              while ( $techs -> have_posts() ) : $techs ->the_post();?>
							<?php $ratenum = get_post_meta($post->ID,"baseinfo_rate_num",true);
							if($ratenum > 1000){?>
                  <div class="new-panel-list">
                    <a href="<?php the_permalink() ?>"><div class="new-panel-list-img" style="background-image: url(<?php echo get_post_meta($post->ID,"baseinfo_img_link",true); ?>);">
                    </div></a>
                    <div class="new-panel-list-content">
                      <a  class="list-content-title" href="<?php the_permalink() ?>"><?php the_title(); ?></a>
                      <div class="list-content-main">
                        <div class="list-content-tag">
                        <span>标签：</span>
                        <?php $animatetags = wp_get_object_terms( $post->ID,  'animatetag' );
                              $tagcount = 0;
                                foreach ( $animatetags as $tag ) {
                                  $tagcount++;
                                  if($tagcount < 5){

                                                echo '<a>'.$tag->name.'</a>';
                                        }
                                }?>
                      </div>
                        <span>简介：</span>
                        <div class="con">
                          <?php echo get_post_meta($post->ID,"baseinfo_introduce",true);?>
                        </div>
                      </div>
                    </div>

                    <div class="new-panel-list-web">
                      <div class="list-web-header">
                        <strong>评分：</strong>
                      </div>
                      <div class="list-web-content list-web-rate">
                        <?php
                        $rate = get_post_meta($post->ID,"baseinfo_rate",true);
                        if(!empty($rate)){
                          echo '<span>'.$rate.'</span>';
                        }else{
                          echo "暂无评分";
                        }?>
                      </div>
                    </div>
                  </div>
           <?php };endwhile;}?>
           <?php wp_reset_postdata();?>
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
</script>
<?php else : ?>
<?php endif; ?>
<?php get_footer();?>
