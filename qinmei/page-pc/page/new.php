<?php get_header(); ?>
<style>
	  main{
    background-color: rgba(0,0,0,0.03);
  }
</style>
<?php if (have_posts()) : the_post(); update_post_caches($posts); ?>


<div class="container">
	<div class="pc-new-top-img">
		<div class="pc-new-top-img-bg" style="background-image: url(<?php echo get_post_meta($post->ID,'page_tab_head_img',true); ?>)">
			<div class="pc-new-top-head">
				新番更新
			</div>
		</div>
	</div>


	<div class="pc-new-con">
		<div class="pc-new-con-nav">
			<div class="new-nav-list active">新番连载</div>
			<div class="new-nav-list">完结更新</div>
		</div>
		<div class="pc-new-con-main">
			<div class="new-con-panel">
		        <?php 
		        $num = date("N") - 1;
		        $panellist = array(
		        	array("周一","day1"),
		        	array("周二","day2"),
		        	array("周三","day3"),
		        	array("周四","day4"),
		        	array("周五","day5"),
		        	array("周六","day6"),
		        	array("周日","day7"),
		        	array("周一","day1"),
		        	array("周二","day2"),
		        	array("周三","day3"),
		        	array("周四","day4"),
		        	array("周五","day5"),
		        	array("周六","day6"),
		        	array("周日","day7"),
		        );
		        $panellist2 = array($panellist[$num],$panellist[($num+1)],$panellist[($num+2)],$panellist[($num+3)],$panellist[($num+4)],$panellist[($num+5)],$panellist[($num+6)]);
		        foreach ($panellist2 as $panel): 
		        ?>
		        <div class="new-time-nobreak-list">
					<div class="new-time-list-left">
						<span></span>
						<?php echo $panel[0];?>
					</div>
					<div class="new-time-list-right">
                    <?php $the_query = new WP_Query( array( 
                    	'post_type' => 'animate',
                        'tax_query' => array(
							array(
							'taxonomy' => 'animatecat',
							'field' => 'slug',
							'terms' => array($panel[1]),
							'operator' => 'IN'
							)),
                        'orderby' => 'modified'
                    ));?>
                  	<?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
                  		<div class="new-item-list-right-li">
							<a href="<?php the_permalink() ?>"><div class="index-table-list"><img src="<?php echo get_post_meta($post->ID,"baseinfo_img_link",true); ?>"><p class="index-left-top"><?php 
										$meta_value = get_post_meta($post->ID,'baseinfo_episode_con',true);
										$last = end($meta_value);echo $last['baseinfo_episode_sort'];?><span class="day-list-none"><?php echo get_the_modified_date('c'); ?></span></p></div></a>
							<p class="text-center"><?php the_title(); ?></p>
						</div>	
					<?php endwhile; ?>
             		<?php wp_reset_postdata();; ?> 
					</div>
				</div>
		        <?php endforeach; ?>
			</div>
			<div class="new-con-panel new-con-panel2" style="display: none;">

             	<?php 
					$general_options = get_option('ashuwp_general');
					$prev = 0;
					$listnum = 0;
					$prevlistnum = -1;
					$left_start  = '';
					$right_start = '';
					$liststart = '<div class="new-time-nobreak-list">';
					$breaklist = '<div class="new-time-list-right">';
					$the_query = new WP_Query( array( 
                    	'post_type' => 'animate',
                        'showposts' => 30,
                        'orderby' => 'time'
                ));
                while ($the_query->have_posts()) : $the_query->the_post(); 
                	$img = get_post_meta($post->ID,"baseinfo_img_link",true);
	                $now =  get_the_time('n 月 j 日');
	                $datetime = '<div class="new-time-list-left2"><span></span>'.$now.'</div>';
	                $list = '<div class="new-item-list-right-li">
								<a href="'.get_the_permalink().'"><div class="index-table-list">
								<img src="'.$img.'"></div></a>
								<p class="text-center">'.get_the_title().'</p>
							</div>';
	                if($now != $prev ){
	                		$listnum = $listnum + 1;
		                	if(($listnum % 2) == 0){
		                		$conlist = $liststart.$datetime.$breaklist.$list;
		                		$right_start = $right_start.$conlist;
		                		if($prevlistnum != $listnum && $listnum > 1){
		                			$left_start = $left_start.'</div></div>';
		                		}
							}else{
								if($prevlistnum != $listnum && $listnum > 2){
									$right_start = $right_start.'</div></div>';}
								$conlist = $liststart.$datetime.$breaklist.$list;
								$left_start = $left_start.$conlist;
							}
					}else{
							if(($listnum % 2) == 0){
		                		$right_start = $right_start.$list;
							}else{
								$left_start = $left_start.$list;
							}
					};
					$prev = $now;
					$prevlistnum = $listnum;
				endwhile; 
					if(($listnum % 2) == 0){
						$right_start = $right_start.'</div></div>';
					}else{
						$left_start = $left_start.'</div></div>';
					}
				?>
             	<?php wp_reset_postdata();?>
             	<div class="new-con-panel2-left">
					<?php echo $left_start;?>
				</div>
             	<div class="new-con-panel2-right">
					<?php echo $right_start;?>
             	</div>
			</div>
		</div>
	</div>
</div>


<?php else : ?>
  <?php endif; ?>
<?php get_footer(); ?>