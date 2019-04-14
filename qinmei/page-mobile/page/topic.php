
<?php get_header(); ?>
<?php if (have_posts()) : the_post(); update_post_caches($posts); ?>
              <div class="mobile-nav" style="border-bottom: solid 1px rgba(0,0,0,0.05);">
                      <a href="<?php bloginfo('url'); ?>/"><div class="mobile-nav-list">
                        <div class="mobile-nav-list-main">首页</div>
                      </div></a>
                      <a href="<?php bloginfo('url'); ?>/new"><div class="mobile-nav-list">
                        <div class="mobile-nav-list-main">新番</div>
                      </div></a>
                      <a href="<?php bloginfo('url'); ?>/topic"><div class="mobile-nav-list">
                        <div class="mobile-nav-list-main active">分类</div>
                      </div></a>
                    <a href="<?php bloginfo('url'); ?>/discuss"><div class="mobile-nav-list">
                        <div class="mobile-nav-list-main">动态</div>
                      </div></a>

                      <a href="<?php bloginfo('url'); ?>/user"><div class="mobile-nav-list">
                        <div class="mobile-nav-list-main ">用户</div>
                      </div></a>
                </div>

<div class="col-md-12">
  <div class="row">
     <div class="col-md-12">
        <div class="row margin-top row-left index-cat-top">
        <?php $catlist = array(
              array('搞笑轻松','fa-coffee','fun','purple'),
              array('战斗热血','fa-gavel','fight','red'),
              array('日常卖萌','fa-futbol-o','daily','orange'),
              array('治愈感动','fa-medkit','cure','orange2'),
              array('致郁惊悚','fa-heartbeat','depress','green2'),
              array('异界幻想','fa-shield"','world','blue')
            ); foreach($catlist as $list) { ?>
          <div class="col-lg-2 col-md-3 col-sm-4 col-xs-4 list-left">
                <a href="/animatekind/<?php echo $list[2];?>"><div class="index-xs-list">
                     <div class="index-xs-list-main">
                          <p><?php echo $list[0];?></p>
                      </div>
                     </div>
                </a>
            </div>
          <?php }?>
       </div>
     </div>
  </div>
</div>


			<?php foreach($catlist as $list2) { ?>

              <div class="col-md-12">
							<div class="row">
								<div class="col-md-2 col-xs-6 index-title index-title-<?php echo $list2[3];?>"><a><?php echo $list2[0];?></a></div>
								<div class="col-md-8"></div>
								<div class="col-md-2 col-xs-6 index-button index-button-<?php echo $list2[3];?>"><a href="/animatekind/<?php echo $list2[2];?>">查看更多</a></div>
						    </div>

                          <div class="row margin-top-10 row-left">
									<?php
        $the_query = new WP_Query( array( 'post_type' => 'animate',
                                         'showposts' => 6,
                                         'tax_query' => array(
                                             array(
                                             'taxonomy' => 'animatekind',
                                             'field' => 'slug',
                                             'terms' => array($list2[2]),
                                             'operator' => 'IN'
                                             )),
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

              <?php }; ?>



						<div class="col-md-12">
							<div class="row">
								<div class="col-md-2 col-xs-6 index-title index-title-green"><a>全部分类</a></div>
								<div class="col-md-8"></div>
								<div class="col-md-2 col-xs-6 index-button index-button-green"><a href="<?php bloginfo('url'); ?>/all">查看更多</a></div>
							</div>
            </div>


						<div class="col-md-12 margin-top-10">
							<div class="row row-left" >
                <?php $general_options = get_option('ashuwp_general');
                  $the_query = new WP_Query( array( 'post_type' => 'animate','orderby' => 'title','showposts' => 6 ));?>
                  <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
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
