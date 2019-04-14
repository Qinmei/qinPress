<?php
/**
 * The template for displaying search results pages.
 *
 */

get_header(); ?>
<!-- Column 1 / Content -->

<div class="col-md-12">
 <div class="mobile-nav">
    <div class="mobile-nav-list">
      <div class="mobile-nav-list-main active"></div>
    </div>
</div>
</div>

<div class="col-md-12 margin-top">
  <div class="row">
    
		<?php if ( have_posts() ) : ?>
			<?php
			while ( have_posts() ) : the_post(); ?>
				<div class="col-lg-2 col-md-2 col-sm-3 col-xs-6 xs-margin-bottom">
					<a href="<?php the_permalink() ?>"><div class="index-table-list"><img src="<?php echo get_post_meta($post->ID,"baseinfo_img_link",true); ?>" alt=""></div></a>
										<p class="index-table-list-title text-center"><?php the_title(); ?></p>	
				</div>			
				<?php
			endwhile;

		else :
			echo'<div class="col-lg-2 col-md-3 col-sm-4 col-xs-12 xs-margin-bottom" style="text-align:center;">暂无结果</div>';

		endif;
		?>
							
</div>                
</div>
<script>
  $(function(){
  var link =  window.location.href;
  var linkarr = link.split("=");
  link = decodeURI(linkarr[1]);
  $('.mobile-nav-list-main').html(link);
  if(link ==""){return};
  if(localStorage.playHistory == undefined ){
   	var history = [];
  }else{
    var history = JSON.parse(localStorage.playHistory);
  };
  if(history.length == 0){
    history.push(link);
  }else{
    for(var i=0;i< history.length;i++){
    	if(link == history[i]){
          history.splice(i, 1);   
        }
    };
    if(history.length == 6){
     	history.pop();
    };
    history.unshift(link);
  };
  localStorage.playHistory = JSON.stringify(history);
});
</script>
<?php get_footer(); ?>