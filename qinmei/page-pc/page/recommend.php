<?php get_header(); ?>
<style>
	  main{
    background-color: rgba(0,0,0,0.03);
  }
  .new-con-panel{
  	border:none;
  	margin: 0 15px;
  }
   .list-content-main{
  display: flex;
  flex-direction: column;
  justify-content: flex-start;
}
</style>

<div class="container">
	<div class="pc-new-top-img">
		<div class="pc-new-top-img-bg" style="background-image: url(<?php echo get_post_meta($post->ID,'page_tab_head_img',true); ?>)">
			<div class="pc-new-top-head">
				推荐好评
			</div>
		</div>
	</div>

	<div class="pc-new-con">
		<div class="pc-new-con-nav">
			<div class="new-nav-list active">站长推荐</div>
			<div class="new-nav-list">评分排行</div>
		</div>
		<div class="pc-new-con-main">
			<div class="new-con-panel">
				<?php $args = array('post_type' => 'animate',
                            'orderby' => 'time',
                            'tax_query' => array(
											 				'taxonomy' => 'animatecat',
											 				'field' => 'slug',
											 				'terms' => array('top'),
											 				'operator' => 'IN'
														)
											);
		    	$tech = new WP_Query( $args );
		   		 if ( $tech -> have_posts() ) {
			        while ( $tech -> have_posts() ) : $tech ->the_post();?>
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
			            			<strong>点评：</strong>
			            		</div>
			            		<div class="list-web-content">
			            			<?php
							          $recomend = get_post_meta($post->ID,"baseinfo_commend",true);
							          if(!empty($recomend)){
							            echo get_post_meta($post->ID,"baseinfo_commend",true);
							          }else{
							            echo "暂无评语";
							          }?>
			            		</div>
			            	</div>
			            </div>
			     <?php endwhile;}?>
			     <?php wp_reset_postdata();; ?>
			</div>

			<div class="new-con-panel">
				<div class="new-con-panel-introduce">
					此评分为豆瓣评分排行，主观意识较大，并不代表真实的排行，如有争议，欢迎反馈
				</div>
				<?php
						$general_options = get_option('ashuwp_general');
						$args = array('post_type' => 'animate',
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
									              	if($tagcount < 8){

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
<?php get_footer();?>
