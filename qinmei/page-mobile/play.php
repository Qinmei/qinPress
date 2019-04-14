<?php get_header(); ?>
<link href="<?php bloginfo('template_url'); ?>/extents/DPlayer/DPlayer.min.css" rel="stylesheet">
<style>
  .mobile-fixed{
    display: none;
  }
  .main-section {
    margin-top: 0;
  }
  .video-bottom-main{
    width:100%;
  }
  .video-bottom-main-list-info{
    overflow: hidden;
    display: flex;
    justify-content: flex-start;
    flex-direction: row;
    flex-wrap: wrap;
    margin-right: -10px;
    padding-bottom: 10px;
  }
  .video-bottom-main-list-info a{
    color:black;
     width:calc((100% - 40px)/4);
     display: inline-block;
     margin: 4px 10px 4px 0;
     display: none;
  }

  .video-bottom-main-list-sec-list{
    width: 100%;
    height: 32px;
    border-radius:5px;
    text-align: center;
    line-height: 32px;
    background-color:white;
    font-size:0.9em;
    border: solid 1px rgba(0,0,0,0.6);
  }
  .video-bottom-main-list-sec-list strong{
    font-weight: normal;
    margin: 0 3px;
  }
  .video-bottom-main-list-sec-list.active{
    background-color: rgba(0,0,0,0.6);
    background-color: <?php $general_options = get_option('ashuwp_general');echo  $general_options['qinmei_base_color'];?>;
    color: white;
    border: none;
  }
  .video-bottom-list-head{
    margin-top:15px;
    font-size:1.3em;
    color:grey;
  }
  .video-bottom-list-head span{
    font-size:0.9em;
  }
  .index-table-list{
    opacity:0.8;
  }
  .video-bottom-info-content p{
    margin-bottom:10px;
  }

  .dplayer-controller .dplayer-icons.dplayer-comment-box .dplayer-comment-setting-box .dplayer-comment-setting-type span{
    width: auto;
  }
  .foot-comment-con{
    margin: 0 -5px;
  }
  .comments-children .form-submit{
    display: flex;
  }
  .pc-discuss-location{
    position: relative;
  }
  .pc-discuss-commentload{
    display: none;
  position: absolute;
    right: 0;
    line-height: 33px;
    height: 33px;
    top: 0;
    padding: 0 15px;
    background-color: rgba(0,0,0,0.2);
    border-radius: 5px;

  }
  .page-input-textarea {
    padding: 5px 15px;
    border-radius: 5px;
    background-color: rgba(0,0,0,0.8);
    color: rgba(255,255,255,0.8);
    cursor: pointer;
    border: none;
    width: 85px;
}
  .form-control-page {
    display: block;
    width: 100%;
    border-radius: 5px;
    padding: 6px 12px;
    font-size: 14px;
    line-height: 1.42857143;
    color: #555;
    background-image: none;
    border: 1px solid #ccc;
}
  .pc-discuss-commenterror{
    display: none;
  position: absolute;
    right: 0;
    line-height: 33px;
    height: 33px;
    top: 0;
    padding: 0 15px;
    background-color: rgba(0,0,0,0.2);
    border-radius: 5px;
  }
  .pc-commments-list{
  	width: 100%;
  	margin-top: 10px;
  	min-height: 80px;
  	background-color: white;
    border-bottom: solid 1px rgba(0,0,0,0.05);
  }
  .pc-commments-list:nth-child(1){
  	margin-top: 0;
  }
  .pc-discuss-con-main .comments-head{
  	width: 100%;
  	height: 40px;
  	display: flex;
  	justify-content: space-between;
  	align-items: center;
  }

 .pc-discuss-con-main .comments-head .comments-head-option{
  width: 36px;
  height: 36px;
  text-align: right;
  line-height: 36px;
  font-size: 0.8em;
  position: relative;
 }
 .head-option-con{
  position: absolute;
  display: none;
  right: 0;
  bottom: 0;
z-index: 6}
  .pc-discuss-con-main .user-info{
  	width: calc(100% - 36px);
  	display: flex;
  	justify-content: flex-start;
  	align-items: center;
  }
  .pc-discuss-con-main .user-info-logo{
  	width: 32px;
  	height: 32px;
  	border-radius: 50%;
  	overflow: hidden;
  }
  .pc-discuss-con-main .user-info-name{
    width: calc(100% - 80px);
  	margin-left: 15px;
  	color: rgba(0,0,0,0.8);
  	display: flex;
  	flex-direction: column;
  	justify-content: space-between;
  	align-items: flex-start;
  	color: rgba(0,0,0,0.6);
  	font-weight: bold;
  }
  .pc-discuss-con-main .user-info-name span{
  	font-size: 0.8em;
  	font-weight: normal;
  	color: rgba(0,0,0,0.4);
  }
  .pc-discuss-con-main .comments-content{
  	padding: 5px 0 5px 47px;
  	color: #1a1a1a;
  	line-height: 1.6;
  }
  .pc-discuss-con-main .comments-foot{
  	height: 30px;
  	width: 100%;
  	display: flex;
  	justify-content: flex-start;
  	align-items: center;
  }
  .pc-discuss-con-main .comments-foot-list{
  	min-width: 40px;
  	height: 30px;
  	color: rgba(0,0,0,0.5);
  	display: flex;
  	justify-content: flex-start;
  	align-items: center;
  	cursor: pointer;
  	margin-right: 30px;
  }
  .pc-discuss-con-main .comments-foot-list:hover{
  	color: rgba(0,0,0,0.8);
  }
  .pc-discuss-con-main .comments-foot-list i{
  	margin-right: 8px;
  }
  .pc-discuss-con-main .comments-children{
  	margin: 5px 0 5px 47px;
    background-color: rgba(0,0,0,0.03);
  }
  .pc-discuss-con-main .pc-comments-child-list{
  	padding: 5px;
  }
  .comments-child-parent{
    font-size: 10px;
    line-height: 10px;
    background-color: rgba(0,0,0,0.6);
    color: white;
    border-radius: 3px;
    padding: 2px 3px 1px 3px;
    position: relative;
    top: -2px;
  }

  .video-bottom-head{
    width: 100%;
    height: 40px;
    display: flex;
    justify-content: flex-start;
    align-items: center;
    padding: 10px 0;
  }
  .bottom-head-line{
    width: 4px;
    height: 1.2em;
    border-radius: 10px;
    background-color: rgba(0,0,0,0.8);
    background-color: <?php $general_options = get_option('ashuwp_general');echo  $general_options['qinmei_base_color'];?>
  }
  .bottom-head-title{
    font-size: 1.1em;
    font-weight: bold;
    line-height: 20px;
    height: 20px;
    margin-left: 8px;
    color: rgba(0,0,0,0.8);
    width: calc(100% - 60px);
  }
  .bottom-head-right-title,.bottom-head-right-extent{
    width: 56px;
    text-align: right;
    font-weight: bold;
  }
  .video-middle-title a{
    color: black;
  }
  .bottom-head-right-title{
    float: right;
  }
  .video-middle-title-text{
    font-size: 0.92em;
    color: grey;
  }
  .video-middle-btn{
    width: 100%;
    height: 40px;
    display: flex;
    margin-top: 10px;
    justify-content: space-between;
  }
  .post-error-report{
  width: calc((100% - 15px)/2);
  height: 32px;
  border-radius: 100px;
  color: rgba(0,0,0,0.8);
  border: solid 1px rgba(0,0,0,0.8);
  text-align: center;
  line-height: 32px;
  letter-spacing: 3px;
  overflow: hidden;
}
.post-error-report p{
  cursor: pointer;
}
.post-error-report p:hover{
  background-color: rgba(0,0,0,0.8);
  color: rgba(255,255,255,0.8);
}
.message-post-con{
  display: none;
}
.message-post-panel{
  width: 95vw;
  height: 270px;
  background-color: white;
  border-radius: 5px;
  position: fixed;
  top: 60px;
  left: 2.5vw;
  z-index: 9;
  padding: 15px;
}
.grey-bg{
  background-color: rgba(0,0,0,0.5);
  width: 100vw;
  height: 100vh;
  position: fixed;
  top: 0;
  left: 0;
  z-index: 8;
}
.message-post-panel-title{
  color: black;
  font-size: 1.5em;
}
.post-error-form-option{
  margin: 15px 0;
}
.post-error-submit-btn{
  width: calc((100% - 80px)/2);
  height: 32px;
  border-radius: 5px;
  background-color: rgba(0,0,0,0.8);
  color: rgba(255,255,255,0.8);
  border: none;
  overflow: hidden;
  text-align: center;
  cursor: pointer;
}
.post-error-submit-btn:nth-child(1){
  background-color: rgba(0,0,0,0.4);
}
.post-error-submit-btn:focus{
  border: none;
  outline: none;
}
.form-submit-btn{
  margin-top: 15px;
  width: 100%;
  display: flex;
  justify-content: space-between;
}
.comments-form{
  position:fixed;
  z-index:39;
  bottom:0;
  left:0;
  width:100vw;
  height:100px;
  background-color:white;
}
.discuss-form-top{
  width: 100%;
  padding-right:15px;
  height: 40px;
  border-bottom: solid 1px rgba(0,0,0,0.05);
  display: flex;
  align-items: center;
  justify-content: space-between;
}
.discuss-top-close{
  height: 40px;
  text-align: center;
  line-height: 40px;
  display: flex;
  justify-content: space-between;
  align-items: center;
}
.discuss-top-close i{
  font-size: 1.35em;
  width: 40px;
  margin-right: 10px;
}
.discuss-top-close span{
  font-size: 1.2em;
}
.discuss-submit-bottom{
  height: 35px;
  background-color: white;
  border-top: solid 1px rgba(0,0,0,0.04);
  position: fixed;
  bottom: 0;
  left: 0;
  width: 100%;
  padding: 0 10px;
}
.discuss-submit-bottom  i{
  font-size: 1.5em;
}
.discuss-submit-bottom span{
    width: 35px;
    height: 35px;
    display: inline-block;
    text-align: center;
    line-height: 35px;
}
.discuss-submit-item.item-link{
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%,-50%);
  width: 85vw;
  height: 220px;
  border-radius: 3px;
  background-color: white;
  box-shadow: 0 0 5px rgba(0,0,0,0.4);
  padding: 20px;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  align-items: center;
}
.user-comment-input{
    width:100%;
  }
  .user-comment-input textarea{
    width: 100%;
    padding: 10px;
    border: none;
    outline: none;
    appearance: none;
  }
  .comment-respond{
    line-height: 20px;
    height: 60px;
    overflow: hidden;
  }
  .user-comment-input textarea:focus {
     border: 0px solid green;
     outline: none;
  }
  .user-comment-input textarea::-webkit-input-placeholder {
    color: black;
    }

    .user-comment-input textarea:-moz-placeholder { /* Firefox 18- */
    color: black;
    }

    .user-comment-input textarea::-moz-placeholder {  /* Firefox 19+ */
    color: black;
    }

    .user-comment-input textarea:-ms-input-placeholder {
    color: black;
    }
  .comments-discuss-sec .form-submit{
    display: none;
  }
  .head-option-panel{
    width: 120px;
    background-color: white;
    border-radius: 3px;
    z-index: 6;
    padding: 0 10px;
    text-align: left;
  }
  .head-option-panel-list{
    height: 35px;
    padding-left:15px;
    font-size: 1.3em;
    display: flex;
    justify-content: flex-start;
    align-items: center;
  }
  .comments-discuss-sec-foot{
    width: 100vw;
    height: 40px;
    display: flex;
    justify-content: space-between;
    align-items: center;
  }
  .comments-discuss-sec-foot span{
    display: inline-block;
    width: 40px;
    height: 40px;
    text-align: center;
    line-height: 40px;
  }
  .comments-discuss-sec-foot span i{
    font-size: 1.5em;
  }
  .video-bottom-main-list-info a.show{
    display: inline-block;
  }
  .video-bottom-main-list-info a.active{
    display: inline-block;
  }
  .video-introduce{
    width: 100%;
    padding: 10px 0;
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
  }
  .video-info-img{
    width: 75px;
    height: 100px;
    border-radius: 5px;
    overflow: hidden;
  }
  .video-info-img img{
    width: 100%;
    height: 100%;
  }
  .video-info-text{
    width: calc(100% - 90px);
    height: 100px;
    overflow: hidden;
    display: flex;
    flex-direction:column;
    justify-content: space-around;
  }
  .video-info-title{
    font-size: 1.2em;
    font-weight: bold;
    color: black;
  }
  .video-info-context{
    margin-top: 5px;
    font-size: 0.85em;
    color: grey;
  }
  .video-iframe-wrap{
    width: 100vw;
  }
  #video-iframe{
    width: 100vw;
    height: 56vw;
    border:none;
  }
  .iframe-jiexi{
    width: 100%;
    display: flex;
    justify-content: flex-end;
    align-items: center;
    width: calc(100% - 140px);
    height: 40px;
  }
  .iframe-jiexi-list{
    display: inline-block;
    width: 60px;
    height: 32px;
    border-radius: 5px;
    text-align: center;
    line-height: 32px;
    background-color: white;
    font-size: 0.8em;
    border: solid 1px rgba(0,0,0,0.6);
    margin-right: 15px;
    cursor: pointer;
  }
  .iframe-jiexi-list.active{
    background-color: rgba(0,0,0,0.6);
    background-color: <?php $general_options = get_option('ashuwp_general');echo  $general_options['qinmei_base_color'];?>;
    color: white;
    border: none;
  }
  .page-download-button{
    color: rgba(0,0,0,0.8);
    border: solid 1px rgba(0,0,0,0.8);
    text-align: center;
    line-height: 32px;
    letter-spacing: 3px;
    overflow: hidden;
    border-radius: 30px;
  }
  .small-line{
    margin: 0 -15px;
    height: 6px;
    background-color: rgba(0,0,0,0.05);
  }
  .video-info-eposide{
    font-size: 1.1em;
    color:rgba(0,0,0,0.7);
  }
  .video-info-num{
    color: grey;
  }
  .video-info-num span{
    display: inline-block;
    width: 50px;
  }
  .video-info-num span i{
    margin-right: 5px;
  }
</style>
<!-- Column 1 /Content -->
<?php
  $id = $_GET['l'];
  $sort = (int)$_GET['n'] -1;
  $the_query = new WP_Query( array( 'post_type' => 'animate','post__in' => array($id) ));
  while ($the_query->have_posts()) : $the_query->the_post();
  setPostViews(get_the_ID());
  $meta_value = array_values(array_filter(get_post_meta($post->ID,'baseinfo_episode_con',true)));
?>

<?php
$play_confirm = get_post_meta($post->ID,"baseinfo_play_setting",true);
if($play_confirm == 'true'){?>

<div class="video-html5-wrap">
    <div class="video-html5-con">
				<div class="video-html5">
						<div id="dplayer"></div>
			  </div>
    </div>
</div>

<?php }else{
$jiexi_confirm = $general_options['qinmei_play_jiexi_setting'];
if($jiexi_confirm == 'true'){
?>

<div class="video-iframe-wrap">
  <iframe src='<?php
    $general_options = get_option("ashuwp_general");
    $jiexi = $general_options["qinmei_play_jiexi1"];
    echo $jiexi.$meta_value[$sort]["baseinfo_episode_link"]; ?>' frameborder="0" border="0" marginwidth="0" marginheight="0" scrolling="no" id="video-iframe" allowfullscreen="true"></iframe>
</div>


 <div class="video-bottom-head" style="width: 140px;float: left;padding-left: 15px">
      <div class="bottom-head-line"></div>
      <div class="bottom-head-title">线路切换</div>
    </div>
<div class="iframe-jiexi">
      <div class="iframe-jiexi-list active" data-jiexi="<?php echo $general_options['qinmei_play_jiexi1'];?>">线路一</div>
      <div class="iframe-jiexi-list" data-jiexi="<?php echo $general_options['qinmei_play_jiexi2'];?>">线路二</div>
      <div class="iframe-jiexi-list" data-jiexi="<?php echo $general_options['qinmei_play_jiexi3'];?>">线路三</div>
</div>

<?php }else{?>

<div class="video-iframe-wrap">
  <iframe src='<?php
    $str = $meta_value[$sort]["baseinfo_episode_link"];
    $patterns = $general_options['qinmei_play_jiexi_pattern'];
    $jiexiarr =array();
    $patterncount = 0;
    if(!empty($patterns)){
      foreach($patterns as $pattern){
          $pattern_p = $pattern['qinmei_play_jiexi_pattern_p'];
          if (preg_match($pattern_p,$str)) {
            $jiexiarr[] = $pattern['qinmei_play_jiexi_pattern_j'];
            $patterncount ++;
          };
      };
    if($patterncount == 0){$jiexi = $general_options['qinmei_play_jiexi1'];}else{
      $jiexi = $jiexiarr[0];
    }
    }else{
      $jiexi = $general_options['qinmei_play_jiexi1'];
    }
    echo $jiexi.$str;?>' frameborder="0" border="0" marginwidth="0" marginheight="0" scrolling="no" id="video-iframe" allowfullscreen="true"></iframe>
</div>
<?php if($patterncount > 1){?>

<div class="video-bottom-head" style="width: 140px;float: left;padding-left: 15px">
      <div class="bottom-head-line"></div>
      <div class="bottom-head-title">线路切换</div>
</div>
<div class="iframe-jiexi">

    <?php $eachcount = 1;foreach($jiexiarr as $jiexilist){?>
      <div class="iframe-jiexi-list" data-jiexi="<?php echo $jiexilist;?>">线路<?php echo $eachcount;?></div>
    <?php $eachcount++;}?>

</div>

<?php } ?>
<?php }}?>
<?php $html = $general_options['qinmei_ad_pc_25'];echo html_entity_decode($html, ENT_QUOTES);?>
<div class="video-bottom-main">
  <div class="col-md-12 video-bottom-main-list">

<?php $html = $general_options['qinmei_ad_pc_22'];echo html_entity_decode($html, ENT_QUOTES);?>
    <div class="small-line"></div>
    <div class="video-bottom-head">
      <div class="bottom-head-line"></div>
      <div class="bottom-head-title">选集(<span><?php echo get_post_meta($post->ID,"baseinfo_episode_num",true);?></span>)</div>
      <div class="bottom-head-right-extent" column-id="<?php echo $count;?>">展开</div>
    </div>
	  <div class="video-bottom-main-list-info">
      <?php $general_options = get_option('ashuwp_general');
        $count = 1;
            foreach($meta_value as $pagelist) { ?>
              <a href="<?php echo site_url().'/play?l='.$post->ID.'&n='.$count;?>" data-url="<?php echo $pagelist["baseinfo_episode_link"]; ?>">
                <div class="video-bottom-main-list-sec-list">
                  <strong><?php echo $pagelist["baseinfo_episode_sort"]; ?></strong></div>
              </a>
      <?php $count++;}; ?>
    </div>
    <?php $html = $general_options['qinmei_ad_pc_23'];echo html_entity_decode($html, ENT_QUOTES);?>
    <div class="small-line"></div>
    <div class="video-bottom-main">
      <div class="video-introduce">
        <div class="video-info-img">
            <img src="<?php echo get_post_meta($post->ID,"baseinfo_img_link",true);?>" alt="">
        </div>
        <div class="video-info-text">
          <div class="video-info-title page-main-title">
            <a href="<?php echo get_permalink();?>"><?php the_title(); ?></a>
          </div>
          <div class="video-info-eposide">
            <span><?php echo $meta_value[$sort]['baseinfo_episode_title'];?></span>
          </div>
          <div class="video-info-num">
            <span><i class="fa fa-youtube-play" aria-hidden="true"></i><?php echo get_post_meta($post->ID,"post_views_count",true);?></span>
            <span><i class="fa fa-comment" aria-hidden="true"></i><?php $id=$post->ID; echo get_post($id)->comment_count;?></span>
          </div>
        </div>
      </div>
    </div>

      <div class="small-line"></div>
    <div class="video-bottom-head">
      <div class="bottom-head-line"></div>
      <div class="bottom-head-title">视频报错</div>
    </div>
    <div class="video-bottom-main" style="margin-bottom:15px;">
      <div class="video-middle-title-text">
      1.无法播放请使用chrome浏览器，其他问题请提交信息;<br />
      2.如果想看的番剧没有搜到，可以点击投稿提交信息;<br />
      3.欢迎进QQ群反馈探讨，<a href="<?php 
						if( $general_options['tab9_qq_link']){
							echo $general_options['tab9_qq_link'];
						}else{
							echo 'https://jq.qq.com/?_wv=1027&k=5EjZVCO';
						}?>" style="color: black">点此加群</a>;
      </div>
      <div class="video-middle-title">
        <div class="video-middle-btn">
          <div class="post-error-report" id="message-post-error">
            <p class="panel-toggle-btn">视频报错</p>
             <div class="message-post-con">
                <div class="message-post-panel">
                  <div class="message-post-panel-title">视频报错</div>
                  <form action="/wp-comments-post.php" method="post"  class="comment-form form-horizontal pc-multi-form">
                    <div class="post-error-form-option">
                      <select class="form-control">
                        <option value ="video-error-1">视频加载错误，无法播放</option>
                        <option value ="video-error-2">没有声音或者有声音无画面</option>
                        <option value ="video-error-3">视频集数错误等信息不正确</option>
                        <option value ="video-error-4">播放过程卡顿，无法顺利观看</option>
                        <option value ="video-error-5">圣光暗牧水印太多，影响观看体验</option>
                        <option value ="video-error-6">其他原因</option>
                      </select>
                    </div>
                    <div class="post-error-form-text">
                      <textarea id="comment" class="form-control-page" name="comment" rows="4" maxlength="65525" placeholder="请尽量详细描述以便能够尽早解决" aria-required="true" required="required"></textarea>
                    </div>
                    <div class="form-submit-btn">
                      <div id="cancel" class="post-error-submit-btn post-error-submit-btn-cancel">取消</div>
                      <input name="submit" type="submit" id="form-submit-btn-submit" class="post-error-submit-btn" value="提交">
                      <input type="hidden" name="comment_post_ID" value="<?php echo $general_options["tab2_error_link"];?>" id="comment_post_ID">
                      <input type="hidden" name="comment_parent" id="comment_parent" value="0">
                    </div>
                  </form>
                </div>
                <div class="grey-bg"></div>
              </div>
          </div>
          <div class="post-error-report" id="message-post-upload">
            <p class="panel-toggle-btn">投稿上架</p>
            <div class="message-post-con">
                <div class="message-post-panel">
                  <div class="message-post-panel-title">请求上架</div>
                  <form action="/wp-comments-post.php" method="post"  class="comment-form form-horizontal pc-multi-form" confirm="ask">
                    <div class="post-error-form-option">
                      <select class="form-control">
                        <option value ="video-error-1">想看的番剧没有搜到</option>
                        <option value ="video-error-2">此番剧OVA或者季数未更新完</option>
                      </select>
                    </div>
                    <div class="post-error-form-text">
                      <textarea id="comment" class="form-control-page" name="comment" rows="4" maxlength="65525" placeholder="请输入想要上架的番剧名，若有链接则更好，上架结果请在新番页面查看" aria-required="true" required="required"></textarea>
                    </div>
                    <div class="form-submit-btn">
                      <div id="cancel" class="post-error-submit-btn post-error-submit-btn-cancel">取消</div>
                      <input name="submit" type="submit" id="form-submit-btn-submit" class="post-error-submit-btn" value="提交">
                      <input type="hidden" name="comment_post_ID" value="<?php echo $general_options["tab2_upload_link"];?>" id="comment_post_ID">
                      <input type="hidden" name="comment_parent" id="comment_parent" value="0">
                    </div>
                  </form>
                </div>
                <div class="grey-bg"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php $html = $general_options['qinmei_ad_pc_24'];echo html_entity_decode($html, ENT_QUOTES);?>

<?php endwhile; ?>
<script src="<?php bloginfo('template_url'); ?>//extents/DPlayer/DPlayer.min.js"></script>
<script>

<?php
$play_confirm = get_post_meta($post->ID,"baseinfo_play_setting",true);
if($play_confirm == 'true'){?>

const dp = new DPlayer({
    container: document.getElementById('dplayer'),
    screenshot: false,
    volume: 0.7,
    video: {
        url: '<?php $meta_value[$sort]['baseinfo_episode_link'];?>',
        pic: '<?php echo bloginfo('template_url').'/extents/DPlayer/video'.rand(1,4).'.jpeg';?>'
    },
    danmaku: {
        id: '<?php echo get_post_meta($post->ID,"baseinfo_dplayer_id",true).($sort+1);?>',
        api: 'https://api.prprpr.me/dplayer/',
        <?php if(!empty($meta_value[$sort]['baseinfo_episode_danmu'])){?>
        addition: ['https://api.prprpr.me/dplayer/bilibili?aid=<?php echo $page_play_bili;?>'],
        <?php }?>
        bottom: '15%',
    }
});

<?php }else{
$jiexi_confirm = $general_options['qinmei_play_jiexi_setting'];
if($jiexi_confirm == 'true'){
?>

$(document).on("click",".iframe-jiexi-list", function() {
  if($(this).hasClass("active")){
  }else{
    $(".iframe-jiexi-list").removeClass("active");
    $(this).addClass("active");
    var playurl = $(".video-bottom-main-list-sec-list.active").parent().attr("data-url");
    playurl = $(this).attr("data-jiexi") + playurl;
    $("#video-iframe").attr("src",playurl);
  }
});

<?php }else{?>


$(document).on("click",".iframe-jiexi-list", function() {
  if($(this).hasClass("active")){
  }else{
    $(".iframe-jiexi-list").removeClass("active");
    $(this).addClass("active");
    var playurl = $(".video-bottom-main-list-sec-list.active").parent().attr("data-url");
    playurl = $(this).attr("data-jiexi") + playurl;
    $("#video-iframe").attr("src",playurl);
  }
});

<?php }}?>


$(function(){
  if(localStorage.record == undefined ){
   	var record = [];
  }else{
    var record = JSON.parse(localStorage.record);
  };
  var link =  [];
  link[0] = window.location.href;
  link[1] = $(".video-info-title.page-main-title a").html().trim();
  link[2] = '<?php echo $sort+1;?>';
  var time = new Date();
  time = time.getFullYear()+'年'+time.getMonth()+'月'+time.getDate()+'日';
  link[3] = time;

  if(record.length == 0){
    record.push(link);
  }else{
    for(var i=0;i< record.length;i++){
    	if(link[1] == record[i][1]){
          record.splice(i, 1);
        }
    };
    if(record.length == 30){
     	record.pop();
    };
    record.unshift(link);
  };
  localStorage.record = JSON.stringify(record);
});




$(document).on("click",".post-error-submit-btn-cancel", function() {
  $(this).parents(".message-post-con").hide();
});

$(document).on("click",".grey-bg", function() {
  $(this).parents(".message-post-con").hide();
});

$(document).on("click",".post-error-report .panel-toggle-btn", function() {
  history.pushState({username: "serch"}, "search");
  $(this).next().show();
});

$(function(){
  var list = $(".video-bottom-main-list-sec-list strong");
    for(var i=0;i<list.length;i++){
      if(i == <?php echo $sort;?>){
          list.eq(i).parents(".video-bottom-main-list-sec-list").addClass("active");
            break;
        }
    }
    var column = Math.floor(<?php echo $sort;?>/4);
    $(".video-bottom-main-list-info a").eq(column*4).addClass("show");
    $(".video-bottom-main-list-info a").eq(column*4+1).addClass("show");
    $(".video-bottom-main-list-info a").eq(column*4+2).addClass("show");
    $(".video-bottom-main-list-info a").eq(column*4+3).addClass("show");
});


$(document).on("click",".bottom-head-right-extent", function() {
  if($(this).hasClass("active")){
    $(this).removeClass("active");
    $(this).html("展开");
    $(".video-bottom-main-list-info a").removeClass("active");
  }else{
    $(this).addClass("active");
    $(this).html("收起");
    $(".video-bottom-main-list-info a").addClass("active");
  }
});

</script>
<?php get_footer(); ?>
