<?php get_header(); ?>
<?php do_action('show_beautiful_filters'); ?>
<?php if (have_posts()) : the_post(); update_post_caches($posts); ?>
<style>
	main{
    background-color: rgba(0,0,0,0.03);
  }
  .new-con-panel{
  	border:none;
  	margin: 0 15px;
  }
  .pc-discuss-con-main {
    padding-top: 0;
  }
  .new-panel-list{
  	
  }
  .new-panel-list-img {
    height: 280px;
    width: 200px;
    background-size: cover;
  }
  .new-panel-list {
    box-shadow: none;
    background-color: white;
	}
  .new-panel-list-content {
    padding: 15px;

    overflow: hidden;
    width: calc(100% - 200px);
    display: flex;
    flex-direction: column;
    justify-content: space-between;
  }
 .list-content-main{
 	display: flex;
 	flex-direction: column;
 	justify-content: flex-start;
 	align-items: flex-start;
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
  .pc-all-con-right{
	width: 300px;
	
	}
.pc-all-con-right .right-list{
	margin-bottom: 15px;
	background-color: white;
	border-radius: 5px;
	width: 100%;
}
.pc-all-con-right .all-top-con{
	padding: 15px;
}
.pc-all-con-right .all-top-list{
	color: rgba(0,0,0,0.7);
	height: 30px;
	width: 100%;
	overflow: hidden;
	text-overflow:ellipsis;
	white-space: nowrap;
	border-radius: 5px;
	font-size: 0.95em;
}
.pc-all-con-right .all-top-list span{
	display: inline-block;
	width: 20px;
	height: 20px;
	border-radius: 3px;
	text-align: center;
	background-color: rgba(0,0,0,0.15);
}
.pc-all-con-right .all-top-list a{
	line-height: 30px;
	padding-left: 8px;
	display: inline-block;
    width: 100%;
    color: rgba(0,0,0,0.7);
    border-radius: 5px;
}
.pc-all-con-right .all-top-list a:hover{
	background-color: rgba(0,0,0,0.05);
}
</style>

<div class="container">
	<div class="pc-new-top-img">
		<div class="pc-new-top-img-bg" style="background-image: url(<?php echo get_post_meta($post->ID,'page_tab_head_img',true); ?>)">
			<div class="pc-new-top-head">
				全部番剧
			</div>
		</div>
	</div>

		<div class="pc-discuss-con">
			<div class="pc-discuss-con-left">
				<div class="pc-discuss-con-nav">
					<div class="pc-discuss-nav-head">
						<div class="discuss-nav-list">所有</div>
					</div>
				</div>
				<div class="pc-discuss-con-main">
					<div class="discuss-con-panel">
						<?php 
							$general_options = get_option('ashuwp_general');
							$args = array(
							    'post_type' => 'animate',
							    'posts_per_page' => '30',
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
				            </div>
				     <?php endwhile;}?>
				     <?php wp_reset_postdata();; ?> 
					</div>
					</div>
						<div class="col-md-12 display-box">
						  <?php if ( function_exists('dw_pagination') ) { dw_pagination(); } ?>
						</div>
				</div>
			<div class="pc-all-con-right">
				<div class="right-list">
					<div class="pc-discuss-con-nav">
						<div class="pc-discuss-nav-head">
							<div class="discuss-nav-list">评分排行</div>
							<div class="all-top-con">
								<?php 
									$args = array('post_type' => 'animate',      
									'orderby'   => array(
						        		'meta_value_num'=>'DESC'
						    		),
						    		'meta_key'  => 'baseinfo_rate',
						    		'showposts' => 100);    
									$the_query = new WP_Query( $args );
									$num = 1;
							   	if ( $the_query->have_posts() ) {    
								    while ( $the_query->have_posts() ) : $the_query->the_post();?>
								    <div class="all-top-list">
								    	<span><?php echo $num;$num =$num +1;?></span>
								    	<a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
								    </div>
								<?php endwhile;}?>
			     				<?php wp_reset_postdata();; ?> 
							</div>
						</div>
					</div>
				</div>
				<div class="right-list">
					<div class="pc-discuss-con-nav">
						<div class="pc-discuss-nav-head">
							<div class="discuss-nav-list">推荐排行</div>
							<div class="all-top-con">
								<?php 
									$args = array('post_type' => 'animate',
									'tax_query' => array(
										array(
											 'taxonomy' => 'animatecat',
											 'field' => 'slug',
											 'terms' => array('top'),
											 'operator' => 'IN'
										)),
						    		'showposts' => 100);    
									$the_query = new WP_Query( $args );
									$num = 1;
							   	if ( $the_query->have_posts() ) {    
								    while ( $the_query->have_posts() ) : $the_query->the_post();?>
								    <div class="all-top-list">
								    	<span><?php echo $num;$num =$num +1;?></span>
								    	<a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
								    </div>
								<?php endwhile;}?>
			     				<?php wp_reset_postdata();; ?> 
							</div>
						</div>
					</div>
				</div>
				<?php $html = $general_options['qinmei_ad_pc_12'];echo html_entity_decode($html, ENT_QUOTES);?>
			</div>
		</div>
</div>

<?php else : ?>
<?php endif; ?>
<?php get_footer();?>