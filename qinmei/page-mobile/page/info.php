<?php get_header(); ?>  
<!-- Column 1 /Content -->
	<?php if (have_posts()) : the_post(); update_post_caches($posts); ?>
<?php  setPostViews(get_the_ID());?>

<div class="col-md-12">
		<div class="video-html5">
				<?php the_content(); ?>
		</div>
</div>
					
         
<?php else : ?>
	<?php endif; ?>
<style>
.video-html5{
  margin-bottom: 30px;
}
.video-html5 p{
  margin:20px 0 !important;
  font-size: 1.1em;
  line-height: 1.8em;
  text-align:left;
  word-break: break-all;
}
.video-html5 span{
  font-weight:bold;
  color:green !important;
}

.video-html5 img{
  width: 100%;
  height: auto;
  border-radius: 5px;
  padding: 3px;
  border: solid 1px #cdcfcf;
  overflow: hidden;
}
h1,h2,h3,h4,h5,h6{
  font-weight: bold;
}
</style>
<?php get_footer(); ?>	