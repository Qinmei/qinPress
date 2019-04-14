<?php get_header();
$general_options = get_option('ashuwp_general');
?>
<style>
.index-left-top{
	height: 2em;
	width: 4em;
	line-height: 2em;
	background-color: rgba(0,0,0,0.5);
}
</style>
<?php if (have_posts()) : the_post(); update_post_caches($posts); ?>
	             <div class="mobile-nav" style="border-bottom: solid 1px rgba(0,0,0,0.05);">
                      <a href="<?php bloginfo('url'); ?>/"><div class="mobile-nav-list">
                        <div class="mobile-nav-list-main active">首页</div>
                      </div></a>
                      <a href="<?php bloginfo('url'); ?>/new"><div class="mobile-nav-list">
                        <div class="mobile-nav-list-main">新番</div>
                      </div></a>
                      <a href="<?php bloginfo('url'); ?>/topic"><div class="mobile-nav-list">
                        <div class="mobile-nav-list-main">分类</div>
                      </div></a>
                    <a href="<?php bloginfo('url'); ?>/discuss"><div class="mobile-nav-list">
                        <div class="mobile-nav-list-main">动态</div>
                      </div></a>
                   <a href="<?php bloginfo('url'); ?>/user"><div class="mobile-nav-list">
                        <div class="mobile-nav-list-main">用户</div>
                      </div></a>
                </div>
						<div class="col-md-8 margin-top">
							<div class="main-pic-container">
								<div class="main-picture">
									<ul>
                                      <?php $query_post = array(
                                        'orderby' => 'rand',
                    										'showposts' => 5,
                                        'tax_query' => array(
                                             array(
                                             'taxonomy' => 'animatecat',
                                             'field' => 'slug',
                                             'terms' => array('scroll'),
                                             'operator' => 'IN'
                                             )),
                    										'post_type' => 'animate',
                                      );
                                      query_posts($query_post);
                                      ?>
                          <?php while(have_posts()):the_post(); ?>
                          <li><a href="<?php the_permalink(); ?>">
                            <img src="<?php $img =get_the_post_thumbnail_url();
if(!empty($img)){
  echo $img;
}else{
  echo get_post_meta($post->ID,"baseinfo_img_link",true);
}; ?>" alt=""></a></li>
                                      <?php endwhile; ?>
<?php
wp_reset_query();?>

									</ul>
								</div>
								<div class="main-list">
									<ul>
									</ul>
								</div>
							</div>
						</div>


            <?php $html = $general_options['qinmei_ad_pc_18'];echo html_entity_decode($html, ENT_QUOTES);?>

					 <div class="col-md-12">
						<div class="row margin-top-10 row-left">
									<?php
        $the_query = new WP_Query( array( 'post_type' => 'animate',
                                         'showposts' => 6,
                                         'tax_query' => array(
                                           array(
                                           'taxonomy' => 'animatecat',
                                           'field' => 'slug',
                                           'terms' => array('top'),
                                           'operator' => 'IN'
                                           )),
                                         'orderby' => 'rand'
                                        ));?>
                  <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
									<div class="col-lg-2 col-md-3 col-sm-3 col-xs-4 list-left">
										<a href="<?php the_permalink() ?>"><div class="index-table-list"><img src="<?php echo get_post_meta($post->ID,"baseinfo_img_link",true); ?>" alt=""></div></a>
										<p class="index-table-list-title text-center" style="margin:0 ;"><?php the_title(); ?></p>
									</div>
									<?php endwhile; ?>
             						<?php wp_reset_postdata();; ?>
							</div>
                          </div>
              <?php $html = $general_options['qinmei_ad_pc_19'];echo html_entity_decode($html, ENT_QUOTES);?>
                           <div class="col-md-12 margin-top">
							<div class="row">
								<div class="col-md-2 col-xs-6 index-title index-title-blue"><a>最近上架</a></div>
								<div class="col-md-8"></div>
								<div class="col-md-2 col-xs-6 index-button index-button-blue"><a href="<?php bloginfo('url'); ?>/arrival">查看更多</a></div>
						    </div>

                          <div class="row margin-top row-left">
									<?php
        $the_query = new WP_Query( array( 'post_type' => 'animate',
                                         'showposts' => 12,
                                         'orderby' => 'time'
                                        ));?>
                  <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
									<div class="col-lg-2 col-md-3 col-sm-3 col-xs-4 list-left">
										<a href="<?php the_permalink() ?>"><div class="index-table-list"><img src="<?php echo get_post_meta($post->ID,"baseinfo_img_link",true); ?>" alt=""></div></a>
										<p class="index-table-list-title text-center"><?php the_title(); ?></p>
									</div>
									<?php endwhile; ?>
             						<?php wp_reset_postdata();; ?>
							</div>
                          </div>

                       <?php $html = $general_options['qinmei_ad_pc_20'];echo html_entity_decode($html, ENT_QUOTES);?>
                           <div class="col-md-12 margin-top">
							<div class="row">
								<div class="col-md-2 col-xs-6 index-title index-title-red"><a>站长推荐</a></div>
								<div class="col-md-8"></div>
								<div class="col-md-2 col-xs-6 index-button index-button-red"><a href="<?php bloginfo('url'); ?>/recommend">查看更多</a></div>
						    </div>

                          <div class="row margin-top row-left">
									<?php
        $the_query = new WP_Query( array( 'post_type' => 'animate',
                                         'showposts' => 12,
                                         'tax_query' => array(
                                           array(
                                           'taxonomy' => 'animatecat',
                                           'field' => 'slug',
                                           'terms' => array('recommend'),
                                           'operator' => 'IN'
                                           )),
                                         'orderby' => 'time',
                                         'order' => 'DESC'
                                        ));?>
                  <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
									<div class="col-lg-2 col-md-3 col-sm-3 col-xs-4 list-left">
										<a href="<?php the_permalink() ?>"><div class="index-table-list"><img src="<?php echo get_post_meta($post->ID,"baseinfo_img_link",true); ?>"></div></a>
										<p class="index-table-list-title text-center"><?php the_title(); ?></p>
									</div>
									<?php endwhile; ?>
             						<?php wp_reset_postdata();; ?>
							</div>
                          </div>


                          <?php $html = $general_options['qinmei_ad_pc_21'];echo html_entity_decode($html, ENT_QUOTES);?>
                           <div class="col-md-12 margin-top">
							<div class="row">
								<div class="col-md-2 col-xs-6 index-title index-title-purple"><a>评分排行</a></div>
								<div class="col-md-8"></div>
								<div class="col-md-2 col-xs-6 index-button index-button-purple"><a href="<?php bloginfo('url'); ?>/rate">查看更多</a></div>
						    </div>

                  <div class="row margin-top row-left">
									<?php $args = array('post_type' => 'animate',
                    'showposts' => 30,
                  	'orderby'   => array(
                        'meta_value_num'=>'DESC'
                    ),
                    'meta_key'  => 'baseinfo_rate',);
          $techs = new WP_Query( $args );
           if ( $techs -> have_posts() ) {
              while ( $techs -> have_posts() ) : $techs ->the_post();?>
							<?php $ratenum = get_post_meta($post->ID,"baseinfo_rate_num",true);
							if($ratenum > 1000){?>
                  <div class="col-lg-2 col-md-3 col-sm-3 col-xs-4 list-left">
          <a href="<?php the_permalink() ?>"><div class="index-table-list"><img src="<?php echo get_post_meta($post->ID,"baseinfo_img_link",true); ?>" alt=""><p class="index-left-top"><?php echo get_post_meta($post->ID,"baseinfo_rate",true);?></div></a>
                    <p class="index-table-list-title text-center"><?php the_title(); ?></p>
        </div>
			<?php };endwhile;}?>
           <?php wp_reset_postdata();?>
							</div>
          </div>



<?php else : ?>
	<?php endif; ?>
  <script src="https://cdn.bootcss.com/jquery.touchswipe/1.6.18/jquery.touchSwipe.min.js"></script>
<?php get_footer(); ?>
