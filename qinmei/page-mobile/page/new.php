
<?php get_header(); ?>
<?php if (have_posts()) : the_post(); update_post_caches($posts); ?>
              <div class="mobile-nav" style="border-bottom: solid 1px rgba(0,0,0,0.05);">
                      <a href="<?php bloginfo('url'); ?>/"><div class="mobile-nav-list">
                        <div class="mobile-nav-list-main">首页</div>
                      </div></a>
                      <a href="<?php bloginfo('url'); ?>/new"><div class="mobile-nav-list">
                        <div class="mobile-nav-list-main active">新番</div>
                      </div></a>
                      <a href="<?php bloginfo('url'); ?>/topic"><div class="mobile-nav-list">
                        <div class="mobile-nav-list-main">分类</div>
                      </div></a>
                    <a href="<?php bloginfo('url'); ?>/discuss"><div class="mobile-nav-list">
                        <div class="mobile-nav-list-main">动态</div>
                      </div></a>
                    
                      <a href="<?php bloginfo('url'); ?>/user"><div class="mobile-nav-list">
                        <div class="mobile-nav-list-main ">用户</div>
                      </div></a>
                </div>
<div class="col-md-12" style="margin-top:5px">
							<div class="row">
								<div class="col-md-10 col-sm-10 col-xs-12 index-underline">
									<div class="col-md-2 col-sm-2 col-xs-2 index-underline-list">
										<div class="text-center index-hot-play index-date">
											周一
										</div>
										<div class="index-trangle center-block"></div>
									</div>
									<div class="col-md-2 col-sm-2 col-xs-2 index-underline-list">
										<div class="text-center index-hot-play index-date">
											周二
										</div>
										<div class="index-trangle center-block"></div>
									</div><div class="col-md-2 col-sm-2 col-xs-2 index-underline-list">
										<div class="text-center index-hot-play index-date">
											周三
										</div>
										<div class="index-trangle center-block"></div>
									</div><div class="col-md-2 col-sm-2 col-xs-2 index-underline-list">
										<div class="text-center index-hot-play index-date">
											周四
										</div>
										<div class="index-trangle center-block"></div>
                                    </div><div class="col-md-2 col-sm-2 col-xs-2 index-underline-list">
										<div class="text-center index-hot-play index-date">
											周五
										</div>
										<div class="index-trangle center-block"></div>
                              		</div><div class="col-md-2 col-sm-2 col-xs-2 index-underline-list">
										<div class="text-center index-hot-play index-date">
											周六
										</div>
										<div class="index-trangle center-block"></div>
									</div><div class="col-md-2 col-sm-2 col-xs-2 index-underline-list">
										<div class="text-center index-hot-play index-date">
											周日
										</div>
										<div class="index-trangle center-block"></div>
									</div>
								</div>
								
							</div>
						</div>
                            
						<div class="col-md-12 col-md-12 margin-top index-play-page index-play index-date-page">

							<?php $days = array('day1','day2','day3','day4','day5','day6','day7');
                        		foreach ($days as  $day) {?>    

							<div class="row">
                               <?php 
        							$the_query = new WP_Query( array( 'post_type' => 'animate',
                                         'tax_query' => array(
											 array(
											 'taxonomy' => 'animatecat',
											 'field' => 'slug',
											 'terms' => array($day),
											 'operator' => 'IN'
											 )),
                                        'orderby' => 'modified'
                                        ));?>
                  				  <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
									<div class="col-lg-2 col-md-2 col-sm-3 col-xs-6">
										<a href="<?php the_permalink() ?>"><div class="index-table-list"><img src="<?php echo get_post_meta($post->ID,"baseinfo_img_link",true); ?>"><p class="index-left-top"><?php 
										$meta_value = get_post_meta($post->ID,'baseinfo_episode_con',true);
										$last = end($meta_value);echo $last['baseinfo_episode_sort'];?><span class="day-list-none"><?php echo get_the_modified_date('c'); ?></span></p></div></a>
										<p class="index-table-list-title text-center"><?php the_title(); ?></p>	
									</div>
									<?php endwhile; ?>
             						<?php wp_reset_postdata();; ?> 
							</div>
                          <?php }?>
						</div>
                          
<?php else : ?>
	<?php endif; ?>
<style>
.index-underline{
  padding:0 2px;
}
.index-underline-list{
  width:14.28%;
}
  .day-list-none{
  	display:none;
  }
</style>
<?php get_footer(); ?>