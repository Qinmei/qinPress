<div style="clear:both"></div>
</main>
<footer style="background-color: <?php 
						$general_options = get_option('ashuwp_general');
						echo $general_options['qinmei_base_color'];?>">
	<div class="container footer-container">
			<div class="qinmei-footer-left">
				<div class="footer-left-logo" style="font-size: 3em;color: white;font-weight: bold;margin-bottom: 15px;margin-left: 0px;"><?php $general_options = get_option('ashuwp_general');echo $general_options['web-title'];?></div>
				<div class="footer-left-text">
					<p><?php echo $general_options['tab1_slogan'];?></p>
					<p>本站主题基于Qinmei视频主题, github项目地址：<a href="https://github.com/qinvz/qinmeivideo" style="color: rgba(255,255,255,0.6);">Qinmei</a></p>
				</div>
				<div class="footer-left-text">
					<p>建立初衷仅仅作为个人项目，并不包含任何商业信息。</p>
					<p>本站不提供任何视听上传服务，所有内容均来自视频分享站点所提供的公开引用资源。</p>
				</div>
			</div>
			<div class="qinmei-footer-right">
				<div class="footer-right-title">官方</div>
				<div class="footer-right-link">
					<?php 
					if(empty($general_options['tab9_modules'])){
						echo '<a href="/">关于我们</a><a href="/">问题反馈</a>';
					}else{	
					foreach($general_options['tab9_modules'] as $list){?>
					<a href="<?php echo $list['tab9_modules_link']; ?>"><?php echo $list['tab9_modules_title']; ?></a>
					<?php }}?>
				</div>
				<div class="footer-right-icon">
					<a title="微信公众号" class="weixin-icon"><i class="fa fa-weixin" aria-hidden="true"></i>
						<div class="weixin-icon-img"><img src="<?php bloginfo('template_url')?>/images/weixin.jpg" alt=""></div>
					</a>
					<a href="
					<?php 
						if( $general_options['tab9_qq_link']){
							echo $general_options['tab9_qq_link'];
						}else{
							echo 'https://jq.qq.com/?_wv=1027&k=5EjZVCO';
						}?>" title="QQ群"><i class="fa fa-qq" aria-hidden="true"></i></a>
					<a href="mailto:<?php 
						if( $general_options['tab9_mail_link']){
							echo $general_options['tab9_mail_link'];
						}else{
							echo '123456789@qq.com';
						}?>" title="邮件"><i class="fa fa-envelope" aria-hidden="true"></i></a>
				</div>
			</div>
</footer>
<script>
	$(".weixin-icon").hover(function(){
		$(".weixin-icon-img").show();
	},function(){
		$(".weixin-icon-img").hide()
	});
</script>
</body>
</html>