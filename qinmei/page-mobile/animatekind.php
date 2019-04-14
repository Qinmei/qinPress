<?php get_header();?>
<?php if (have_posts()) : the_post(); update_post_caches($posts); ?>
<div class="col-md-12">
 <div class="mobile-nav">
    <div class="mobile-nav-list">
      <div class="mobile-nav-list-main active"><?php single_cat_title();?>番剧</div>
    </div>
</div>
</div>
<div class="col-md-12 margin-top">
  <div class="row row-left">
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
				<div class="col-lg-2 col-md-3 col-sm-3 col-xs-4 list-left">
					<a href="<?php the_permalink() ?>"><div class="index-table-list"><img src="<?php echo get_post_meta($post->ID,"baseinfo_img_link",true); ?>" alt=""></div></a>
										<p class="index-table-list-title text-center"><?php the_title(); ?></p>
				</div>
                  <?php endwhile;}?>
</div>
</div>
<div class="col-md-12 display-box">
  <?php if ( function_exists('dw_pagination') ) { dw_pagination(); } ?>
</div>
<?php else : ?>
	<?php endif; ?>
<style>
	  .mobile-nav {
    border-bottom:none;
}
</style>
<?php get_footer(); ?>
