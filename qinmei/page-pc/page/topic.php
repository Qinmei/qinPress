<?php get_header(); ?>
<style>
	  main{
    background-color: rgba(0,0,0,0.03);
  }
  .new-con-panel{
  	border:none;
  	margin: 0 15px;
  }
</style>

<div class="container">
	<div class="pc-new-top-img">
		<div class="pc-new-top-img-bg" style="background-image: url(<?php echo get_post_meta($post->ID,'page_tab_head_img',true); ?>)">
			<div class="pc-new-top-head">
				专题图文
			</div>
		</div>
	</div>

	<div class="pc-new-con">
		<div class="pc-new-con-nav">
			<?php $general_options = get_option('ashuwp_general');
			$count =0;
			if(empty($general_options['tab3_modules'])){}else{	
						foreach($general_options['tab3_modules'] as $category) {
							$count++;
			?>
			<div class="new-nav-list <?php if($count == '1'){echo 'active';}?>"><?php echo get_cat_name($category);?></div>
			<?php }}; ?> 
		</div>
		<div class="pc-new-con-main">
			<?php 
        	foreach($general_options['tab3_modules'] as $list) : ?>
				<div class="new-con-panel">
					<div class="topic-container">
						<?php 
						$args = array(
							    'post_type' => 'post',
							    'posts_per_page' => '30',
							    'cat'=> $list,
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
					            <a href="<?php the_permalink() ?>">
					            	<div class="topic-panel-list">
						            	<div class="topic-panel-list-img" style="background-image: url(<?php the_post_thumbnail_url(medium);?>);">
						            		<div class="list-smallicon">
							            		<span><i class="fa fa-eye" aria-hidden="true"></i>
													<?php if(get_post_meta($post->ID,"post_views_count",true)){
														echo get_post_meta($post->ID,"post_views_count",true);
													}else{ echo '0'; };?>
							            		</span>
							            		<span><i class="fa fa-commenting" aria-hidden="true"></i>
													<?php $id=$post->ID; echo get_post($id)->comment_count;?>
							            		</span>
						            		</div>
						            	</div>
						            	<div class="list-head">
						            			<?php the_title(); ?>
						            		</div>
						            	<div class="list-content">
						            		<?php the_excerpt(); ?>
						            	</div>
						            	
					            	</div>
					            </a>
					     <?php endwhile;}?>
					 </div>
					     <?php wp_reset_postdata(); ?> 
						<div class="col-md-12 display-box">
						  <?php if ( function_exists('dw_pagination') ) { dw_pagination(); } ?>
						</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</div>
<?php get_footer();?>