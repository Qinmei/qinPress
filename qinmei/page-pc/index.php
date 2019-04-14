<?php get_header();
$general_options = get_option('ashuwp_general');
?>
<?php if (have_posts()) : the_post(); update_post_caches($posts); ?>

<div class="main-bg" style="background-image: url(<?php
	if( $general_options['tab1_header_img']){
		echo $general_options['tab1_header_img'];
	}else{
		echo bloginfo('template_url').'/images/index.jpg';
	}?>)">
	<div class="index-slogan">
		<div class="slogan-logo" style="font-size: 3.5em;color: white;font-weight: bold;margin-bottom: 15px;"><?php echo $general_options['web-title'];?></div>
		<div class="slogan-content"><?php echo $general_options['tab1_slogan'];?></div>
	</div>
</div>

<div class="container">
	<?php $html = $general_options['qinmei_ad_pc_1'];echo html_entity_decode($html, ENT_QUOTES);?>
	<?php $html = $general_options['qinmei_ad_pc_2'];echo html_entity_decode($html, ENT_QUOTES);?>
	<?php $html = $general_options['qinmei_ad_pc_3'];echo html_entity_decode($html, ENT_QUOTES);?>
</div>




<div class="container">
<div class="row">
	<div class="index-top">
						<div class="index-top-left">
							<div class="main-pic-container">
								<div class="main-picture">
									<ul>
                                      <?php
                                      $query_post = array(
                                        'orderby' => 'rand',
                      					'showposts' => '5',
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
<li><a href="<?php the_permalink(); ?>"><img src='
<?php $img =get_the_post_thumbnail_url();
if(!empty($img)){
	echo $img;
}else{
	echo get_post_meta($post->ID,"baseinfo_img_link",true);
}; ?>' alt=""></a></li>
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

						<div class="index-top-right">
                              <?php
        $the_query = new WP_Query( array( 'post_type' => 'animate',
                                         'orderby' => 'random',
                                         'tax_query' => array(
											 array(
											 'taxonomy' => 'animatecat',
											 'field' => 'slug',
											 'terms' => array('top'),
											 'operator' => 'IN'
											 )),
                                         'showposts' => 6 ));?>
                  <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
									<div class="index-top-right-list">
										<a href="<?php the_permalink() ?>"><div class="main-side-list" style="background-image: url(<?php $img =get_the_post_thumbnail_url();
if(!empty($img)){
	echo $img;
}else{
	echo get_post_meta($post->ID,"baseinfo_img_link",true);
}; ?>);"><p><?php the_title(); ?></p></div></a>
									</div>
								<?php endwhile; ?>

             <?php wp_reset_postdata();; ?>
						</div>
        </div>
        <div class="col-md-12">
						<div class="col-md-12 margin-top">
							<div class="row">
								<div class="col-md-2 col-sm-2 col-xs-6 index-title" style="padding-right: 0"><i class="fa fa-cogs" aria-hidden="true"></i>新番连载</div>
								<div class="col-md-10 col-sm-10 col-xs-12 index-underline">
									<div class="col-md-2 col-sm-2 col-xs-2">
										<div class="text-center index-hot-play index-date">
											周一
										</div>
										<div class="index-trangle center-block"></div>
									</div>
									<div class="col-md-2 col-sm-2 col-xs-2">
										<div class="text-center index-hot-play index-date">
											周二
										</div>
										<div class="index-trangle center-block"></div>
									</div><div class="col-md-2 col-sm-2 col-xs-2">
										<div class="text-center index-hot-play index-date">
											周三
										</div>
										<div class="index-trangle center-block"></div>
									</div><div class="col-md-2 col-sm-2 col-xs-2">
										<div class="text-center index-hot-play index-date">
											周四
										</div>
										<div class="index-trangle center-block"></div>
                                    </div><div class="col-md-2 col-sm-2 col-xs-2">
										<div class="text-center index-hot-play index-date">
											周五
										</div>
										<div class="index-trangle center-block"></div>
                              		</div><div class="col-md-2 col-sm-2 col-xs-2">
										<div class="text-center index-hot-play index-date">
											周六
										</div>
										<div class="index-trangle center-block"></div>
									</div>
									<div class="col-md-2 col-sm-2 col-xs-2">
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
                                        'orderby' => 'modified',
                                        'showposts' => '-1',
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

						<?php $html = $general_options['qinmei_ad_pc_4'];echo html_entity_decode($html, ENT_QUOTES);?>
						<?php
						$index_modules = array(
							array('好评推荐','fa-map-signs','recommend','animatecat'),
							array('搞笑轻松','fa-coffee','fun','animatekind'),
							array('战斗热血','fa-gavel','fight','animatekind'),
							array('日常卖萌','fa-futbol-o','daily','animatekind'),
							array('治愈感动','fa-medkit','cure','animatekind'),
							array('致郁惊悚','fa-heartbeat','depress','animatekind'),
							array('异界幻想','fa-shield"','world','animatekind')
						);
						$ad_count = 4;
						foreach($index_modules as $list) { ?>
						 <div class="col-md-12 margin-top">
							<div class="row">
								<div class="col-md-2 col-xs-6 index-title"><i class="fa <?php echo $list[1];?>" aria-hidden="true"></i><?php echo $list[0];?></div>
								<div class="col-md-8"></div>
								<div class="col-md-2 col-xs-6 index-button">
									<a style="background-color: <?php echo $general_options['qinmei_base_color'];?>"
										href="<?php if($list[3] == 'animatecat'){
											echo '/'.$list[2];
										}else{echo '/'.$list[3].'/'.$list[2];}?>">查看更多</a></div>
						    </div>

                          <div class="row margin-top row-left">
								<?php
        							$the_query = new WP_Query( array( 'post_type' => 'animate',
                                         'showposts' => '12',
                                         'tax_query' => array(
																						 array(
																						 'taxonomy' => $list[3],
																						 'field' => 'slug',
																						 'terms' => array($list[2]),
																						 'operator' => 'IN'
																						 )),
                                        'orderby' => 'time'
                                        ));?>
                  					<?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
									<div class="col-lg-2 col-md-3 col-sm-4 col-xs-6 list-left">
										<a href="<?php the_permalink() ?>"><div class="index-table-list"><img src="<?php echo get_post_meta($post->ID,"baseinfo_img_link",true); ?>"></div></a>
										<p class="index-table-list-title text-center"><?php the_title(); ?></p>
									</div>
									<?php endwhile; ?>
             						<?php wp_reset_postdata();; ?>
							</div>
                          </div>
                      	<?php
                      	$ad_count++;
                      	$ad_modeule = 'qinmei_ad_pc_'.$ad_count;
                      	$html = $general_options[$ad_modeule];echo html_entity_decode($html, ENT_QUOTES);?>
					<?php }; ?>
		</div>
	</div>
</div>
<?php else : ?>
<?php endif; ?>
<?php get_footer(); ?>
