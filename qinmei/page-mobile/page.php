<?php get_header(); ?>
<!-- Column 1 / Content -->
<?php if (have_posts()) : the_post(); update_post_caches($posts); ?>
<?php the_content(); ?>
<?php endif;?>
<?php get_footer(); ?>