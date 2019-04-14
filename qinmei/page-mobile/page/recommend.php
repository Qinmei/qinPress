<?php get_header(); ?>
<?php if (have_posts()) : the_post(); update_post_caches($posts); ?>
<div class="col-md-12">
 <div class="mobile-nav">
    <div class="mobile-nav-list">
      <div class="mobile-nav-list-main active">站长推荐</div>
    </div>
</div>
</div>
<div class="col-md-12 margin-top-10">
  <div class="row row-left">
     <?php
     $general_options = get_option('ashuwp_general');
     $query_post = array( 'post_type' => 'animate',
                                      'showposts' => -1,
                                      'tax_query' => array(
                                        array(
                                        'taxonomy' => 'animatecat',
                                        'field' => 'slug',
                                        'terms' => array('recommend'),
                                        'operator' => 'IN'
                                        )),
                                      'orderby' => 'time',
                                      'order' => 'DESC'
                                     );
                    query_posts($query_post);?>
                  <?php while(have_posts()):the_post(); ?>
				<div class="col-lg-2 col-md-3 col-sm-3 col-xs-4 list-left">
					<a href="<?php the_permalink() ?>"><div class="index-table-list"><img src="<?php echo get_post_meta($post->ID,"baseinfo_img_link",true); ?>" alt=""></div></a>
										<p class="index-table-list-title text-center"><?php the_title(); ?></p>
				</div>
                  <?php endwhile; ?>

             <?php wp_reset_postdata();; ?>
</div>
</div>

<?php else : ?>
	<?php endif; ?>
<?php get_footer(); ?>
