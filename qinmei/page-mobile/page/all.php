<?php get_header(); ?>
<?php if (have_posts()) : the_post(); update_post_caches($posts); ?>

  <div class="col-md-12">
   <div class="mobile-nav">
      <div class="mobile-nav-list">
        <div class="mobile-nav-list-main active">全部番剧</div>
      </div>
  </div>
  </div>

<div class="col-md-12 margin-top">
  <div class="row row-left">

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
    };
     if ( $the_query->have_posts() ) {
        while ( $the_query->have_posts() ) : $the_query->the_post();?>
				<div class="col-lg-2 col-md-3 col-sm-3 col-xs-4 list-left">
					<a href="<?php the_permalink() ?>"><div class="index-table-list"><img src="<?php the_post_thumbnail_url(thumbnail); ?>" alt=""></div></a>
					<p class="index-table-list-title text-center"><?php the_title(); ?></p>
				</div>
      <?php endwhile; }?>
    <?php wp_reset_postdata(); ?>
</div>
</div>
<div class="col-md-12 display-box">
  <?php if ( function_exists('dw_pagination') ) { dw_pagination(); } ?>
</div>

<?php else : ?>
	<?php endif; ?>
<?php get_footer(); ?>
