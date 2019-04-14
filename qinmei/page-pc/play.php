<?php get_header(); ?>
<link href="<?php bloginfo('template_url'); ?>/extents/DPlayer/DPlayer.min.css" rel="stylesheet">
<style>
  main{
    background-color: rgba(0,0,0,0.1);
  }
  .video-sidebar{

  }
  .video-sidebar-top{
    width: 100%;
  }
  .video-sidebar-con{
    margin: 0px 5px 0 15px;
    color: grey;
    overflow-y: scroll;
    overflow-x: hidden;
    height: calc(100% - 72px);
    display: none;
  }
  .video-sidebar-con.show{
    display: block;
  }
  .video-sidebar-list{
    width: 100%;
    height: 55px;
    background-color: grey;
    margin-top: 15px;
    color: white;
    border-radius: 5px;
    padding:0 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
  }
  .video-sidebar-list:hover{
    background-color: rgba(0,0,0,0.8);
  }
  .video-sidebar-list.active{
    background-color: rgba(0,0,0,0.8);
  }
  .video-sidebar-list strong,.video-sidebar-list i{
    margin: 0 5px;
  }
  .video-content-main::-webkit-scrollbar {
    height: 5px;
  }
  .foot-comment-right{
    width: 280px;
    background-color: transparent;
    border-radius: 0;
    padding: 0;
  }
  .foot-comment-left{
    width: calc(100% - 295px);
  }
  .video-html5-wrap{
    margin-bottom: 12px;
    margin: 15px;
  }
  .foot-comment-con{
    min-height: 100px;
  }
  .comments-con{
    margin-top: 15px;
  }
  .foot-comment-left{
    padding:15px;
  }
  .comments-pc-list-text{
    padding-left: 45px;
  }
  .pc-commments-list{
    margin-top: 0;
    border-radius: 0;
    border-bottom: solid 1px rgba(0,0,0,0.08);
    padding:10px  0;
  }
  .pc-discuss-con-main .comments-content{
    padding-left: 45px;
  }
/* 滚动槽 */
  .video-content-main::-webkit-scrollbar-track {
    border-radius:10px;
  }
/* 滚动条滑块 */
  .video-content-main::-webkit-scrollbar-thumb {
    border-radius:10px;
    background:rgba(0,0,0,0.4);
  }
  .video-content-main::-webkit-scrollbar-thumb:window-inactive {
    background:rgba(0,0,0,0.1);
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
  .ias-noneleft{
    font-weight: bold;
    width: 100%;
    margin: 15px 0 0;
    background-color: white;
    border-radius: 5px;
    text-align: center;
    padding: 10px;
    color: rgba(0,0,0,0.4);
  }
  .pc-discuss-login{
    float: right;
    margin-top: 10px;
    margin-right: 10px;
    padding: 8px 15px;
    background-color: rgba(0,0,0,0.8);
    color: rgba(255,255,255,0.8);
    border-radius: 5px
  }
  .pc-discuss-nav-head a{
    color: white;
  }
  .pc-discuss-con-main .comments-foot{
    padding-left: 45px;
    height: 20px;
    margin-top: 10px;
  }
  .pc-discuss-con-main{
    padding-top: 0;
  }
  .pc-discuss-con-main .comments-foot.comments-child-foot{
    padding-left: 10px;
  }
  .pc-discuss-con-main .comments-foot-list{
    height: 20px;
  }
  .pc-discuss-con-main .comments-children {
    margin: 10px 30px;
    width: auto;
  }
  .dplayer-controller .dplayer-icons.dplayer-comment-box .dplayer-comment-setting-box .dplayer-comment-setting-type span{
    width: auto;
  }
  .page-video-top{
    background-color: white;
  }
  .video-middle-main{
    margin-right: 15px;
    height: 120px;
    display: flex;
    justify-content: space-between;
    align-items: center;
  }
  .video-middle-con{
    width: calc(100% - 220px);
    display: flex;
    justify-content: flex-end;
  }

  .video-middle-btn{
    display: flex;
    flex-direction: row;
    justify-content: space-around;
    align-items: center;
    width: 250px;
    margin-right: -5px;
  }
  .video-middle-title{
    font-size: 1.6em;
    color: black;
  }
  .video-middle-title a{
    color: black;
  }
  .videp-middle-icon{
    font-size: 1.2em;
    color: grey;
  }
  .videp-middle-icon span{
    margin-right: 20px;
  }
  .videp-middle-icon i{
    margin-right: 5px;
  }
  .video-sidebar-con::-webkit-scrollbar {
  width: 6px;
  background: rgba(118,176,243,.3);
  border-radius: 5px;
}
.video-sidebar-con::-webkit-scrollbar-button {
    display: none;
}
.video-sidebar-con::-webkit-scrollbar-thumb {
    width: 8px;
    min-height: 15px;
    background: rgba(0,0,0,.2);
    border-radius: 5px;
}
.video-sidebar-con::-webkit-scrollbar-thumb:hover {
    background: rgba(0,0,0,.6);
}
.video-sidebar-con::-webkit-scrollbar-track {
    background-color: #fff;
}
.post-error-report{
  width: 118px;
  height: 40px;
  font-size:0.9em;
  border-radius: 100px;
  color: rgba(255,255,255,0.8);
  background-color: rgba(0,0,0,0.4);
  text-align: center;
  line-height: 40px;
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
  width: 600px;
  height: 300px;
  background-color: white;
  border-radius: 5px;
  position: fixed;
  top: 40%;
  left: 50%;
  transform: translate(-50%,-50%);
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
  width: 120px;
  height: 40px;
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
.foot-panel-show-list {
  float: left;
  overflow: hidden;
  margin: 0 10px 10px 0;
  width: 55px;
  min-width: 55px;
  height: 55px;
  background-color: rgba(255,255,255,0.2);
  color: rgba(255,255,255,0.8);
  border-radius: 5px;
  display: flex;
  justify-content: center;
  align-items: center;
  cursor: pointer;

}
.foot-panel-show-list.active,.foot-panel-show-list:hover{
  background-color: rgba(255,255,255,0.4);
}
.eposide-list{
  padding-top: 15px;
  margin-right: -15px;
  overflow-x: hidden;
}
.eposide-list .foot-panel-show-list {
  background-color: rgba(0,0,0,0.4);
}
.eposide-list .foot-panel-show-list.active,.eposide-list .foot-panel-show-list:hover{
  background-color: rgba(0,0,0,0.8);
}
.page-main-foot-panel{
  margin-top: 15px;
}
.danmu-top-bar{
    height: 40px;
    display:  flex;
    justify-content: space-between;
    padding: 0 15px;
    align-items:  center;
    color: grey;
    font-size: 0.9em;
}
.danmu-bar-setting{
  font-size: 1.8em;
}
.danmu-top-tab{
  height: 32px;
  width: 100%;
  display: flex;
  justify-content: space-around;
  border-top: 1px solid rgba(0,0,0,0.1);
}
.danmu-top-tab-time{
  width: 45px;
  height: 32px;
  line-height: 32px;
  font-size: 0.85em;
  cursor: pointer;
}
.danmu-top-tab-text{
  width: calc(100% - 45px);
  height: 32px;
  line-height: 32px;
  font-size: 0.85em;
  cursor: pointer;
  overflow: hidden;
  text-overflow: ellipsis;
}
.video-sidebar-con ul li{
  width: 100%;
  display: flex;
  justify-content: center;
  align-items: center;
  height: 24px;
}
.video-sidebar-con ul li .danmu-top-tab-time,
.video-sidebar-con ul li .danmu-top-tab-text{
  height: 24px;
  line-height: 24px;
}
.page-main-count{
  width: 100%;
  display: flex;
  justify-content: flex-start;
  color: rgba(255,255,255,0.9);
  align-items: center;
  height: 60px;
  margin: 10px 0;
}
.page-main-count-list{
  height: 45px;
  line-height: 20px;
}
.page-main-count-list span{
  display: inline-block;
  margin-top: 8px;
  }
.page-main-count-line{
  width: 2px;
  height: 40px;
  background-color: rgba(255,255,255,0.8);
  border-radius: 5px;
  margin: 0 20px;
}
.page-main-title{
  margin-bottom: 0;
  font-weight: bold;
  display: flex;
  justify-content: flex-start;
  align-items: center;
}
.page-main-title span{
  font-size: 12px;
    display: inline-block;
    vertical-align: middle;
    margin-left: 15px;
    height: 20px;
    padding: 0 4px;
    line-height: 18px;
    color: #fff;
    border: 1px solid #fff;
    border-radius: 3px;
}
.page-main-info{
  font-size: 0.9em;
}
.page-top{
  height: 400px;
}
.page-main-playinfo{
  color: rgba(255,255,255,0.8);
  height: 35px;
}
.page-main-playinfo span{
  margin-right: 30px;
}
.page-action-button{
  height: 48px;
  min-width: 128px;
  background-color: #f36392;
  border-radius: 5px;
  color: rgba(255,255,255,0.95);
  display: flex;
  justify-content: center;
  align-items: center;
  font-size: 20px;
  cursor: pointer;
  float: left;
  margin-right: 20px;
  padding: 0 15px;
}
.page-action-button:hover{
  background-color: #ff85ad;
}
.page-action-button i{
  margin-right: 10px;
  font-size: 24px;
}
.page-main-rate{
  height: 60px;
  font-size: 3em;
  color: #ffa726;
}
.page-main-rate span{
  margin-left: 10px;
  font-size: 0.2em;
  color: rgba(255,255,255,0.8)
}
.right-list{
  border-radius: 5px;
  overflow: hidden;
  margin-bottom: 15px;
}
.all-top-con{
  padding: 5px 15px;
}
.all-top-con-list{
  line-height: 30px;
}
.iframe-player{
  width: 100%;
  height: 100%;
    position: relative;
}
#iframe-player-con{
  width: 100%;
  height: 100%;
  display:block;
}
.iframe-jiexi{
  position: absolute;
  top: 0;
  left: -75px;
  width: 60px;
  background-color: rgba(255,255,255,0.7);
  border-radius: 5px;
  overflow: hidden;
}
.iframe-jiexi-list{
  text-align:center;
  height: 35px;
  line-height: 35px;
  cursor: pointer;
}
.iframe-jiexi-list:hover,.iframe-jiexi-list.active{
  background-color: #00a1d6;
  color: white;
}
.foot-panel-show-list{
  background-color: <?php
  $general_options = get_option("ashuwp_general");
  echo $general_options['qinmei_base_color'];?>
}
.play-header{
	margin: 15px;
	background-color: white;
	border-radius: 5px;
	height: 60px;
	font-size: 1.2em;
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 0 15px;
}
.play-header span{
	margin-right: 10px;
}
.play-header-title{
  font-weight: bold;
}
.iframe-container{
    display: flex;
    margin: 15px
}

.iframe-left{
  width:calc(100% - 280px);
}
.iframe-right{
  width: 280px;
  background-color: black;
  overflow-y: scroll;
}
.iframe-right::-webkit-scrollbar{
  width: 1px;
}
.right-title{
  color: white;
  padding: 15px;
  font-size: 1.2em;
  display:flex;
  justify-content: space-between;
}
.iframe-right-toggle{
  cursor: pointer;
}
.right-main{
    padding-left: 15px;
    width: 100%;
}
.video-sidebar-tab{
  display: flex;
  justify-content: space-around;
  align-items: center;
  height: 25px;
}
.video-sidebar-tab span{
  padding: 0 15px;
  line-height: 25px;
}
.video-sidebar-tab span.active{
  border-bottom: solid 2px black;
}
</style>

<?php
	$id = $_GET['l'];
	$sort = (int)$_GET['n'] -1;
    $the_query = new WP_Query( array( 'post_type' => 'animate','post__in' => array($id) ));
 while ($the_query->have_posts()) : $the_query->the_post();
	setPostViews(get_the_ID());
$meta_value = array_values(array_filter(get_post_meta($post->ID,'baseinfo_episode_con',true)));
?>


<div class="add-area" style="position: relative;width: 100%;">
  <div class="ad-play-left" style="position: absolute;left: 0;top: 0;z-index: 3">
  <?php $html = $general_options['qinmei_ad_pc_16'];echo html_entity_decode($html, ENT_QUOTES);?>
</div>

<div class="ad-play-right" style="position: absolute;right: 0;top: 0;z-index: 3">
  <?php $html = $general_options['qinmei_ad_pc_17'];echo html_entity_decode($html, ENT_QUOTES);?>
</div>

<?php $html = $general_options['qinmei_ad_pc_13'];echo html_entity_decode($html, ENT_QUOTES);?>
</div>


<div class="container">

<?php
$play_confirm = get_post_meta($post->ID,"baseinfo_play_setting",true);
if($play_confirm == 'true'){?>

    <div class="video-html5-wrap">
          <div class="video-html5-con">
            <div class="video-html5">
              <div id="dplayer"></div>
            </div>
          </div>

          <div class="video-sidebar">
            <div class="video-sidebar-top">
               <div class="danmu-top-bar">
                <div class="danmu-bar-text"><span style="font-size: 1.6em;color: black;font-weight: bold;">10</span>人正在看，<span class="danmu-num"></span>条弹幕</div>
                <div class="danmu-bar-setting"><i class="fa fa-cog" aria-hidden="true"></i></div>
              </div>
            </div>
            <div class="video-sidebar-tab">
              <span class="active">弹幕列表</span>
              <span>其他选集</span>
            </div>
            <div class="video-sidebar-con show">
               <div class="danmu-top-tab">
                <div class="danmu-top-tab-time">时间</div>
                <div class="danmu-top-tab-text">弹幕内容</div>
               </div>
               <div class="danmu-con">

               </div>
            </div>

             <div class="video-sidebar-con">
                <div class="eposide-list">
                     <?php $general_options = get_option('ashuwp_general');
                      $count = 1;
                          foreach($meta_value as $pagelist) { ?>
                             <a href="<?php echo site_url().'/play?l='.$post->ID.'&n='.$count;?>"  class="page-change-link-btn" data-url="<?php echo $pagelist["baseinfo_episode_link"];?>">
                              <div class="foot-panel-show-list <?php if($count == ($sort+1)){echo 'active';}?>"><?php echo $pagelist["baseinfo_episode_sort"]?></div>
                            </a>
                        <?php $count++;}; ?>
                </div>
            </div>
          </div>
    </div>

<?php }else{?>
<div class="iframe-container">

<div class="iframe-left">

<?php $jiexi_confirm = $general_options['qinmei_play_jiexi_setting'];
if($jiexi_confirm == 'true'){
?>

  <div class="iframe-player">
    <iframe src='<?php
    $jiexi = $general_options["qinmei_play_jiexi1"];
    echo $jiexi.$meta_value[$sort]["baseinfo_episode_link"]; ?>' frameborder="0" border="0" marginwidth="0" marginheight="0" scrolling="no" id="iframe-player-con" allowfullscreen="true">
    </iframe>
    <div class="iframe-jiexi">
      <div class="iframe-jiexi-list active" data-jiexi="<?php echo $general_options['qinmei_play_jiexi1'];?>">线路一</div>
      <div class="iframe-jiexi-list" data-jiexi="<?php echo $general_options['qinmei_play_jiexi2'];?>">线路二</div>
      <div class="iframe-jiexi-list" data-jiexi="<?php echo $general_options['qinmei_play_jiexi3'];?>">线路三</div>
    </div>
  </div>
<?php }else{ ?>

<div class="iframe-player">
  <iframe src='<?php
    $str =$meta_value[$sort]["baseinfo_episode_link"];
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
    echo $jiexi.$str;?>' frameborder="0" border="0" marginwidth="0" marginheight="0" scrolling="no" id="iframe-player-con" allowfullscreen="true">
  </iframe>
  <div class="iframe-jiexi">
    <?php if($patterncount > 1){?>
    <?php $eachcount = 1;foreach($jiexiarr as $jiexilist){?>
      <div class="iframe-jiexi-list" data-jiexi="<?php echo $jiexilist;?>">线路<?php echo $eachcount;?></div>
    <?php $eachcount++;}?>
    <?php } ?>
    </div>

</div>

<?php }?>
</div>
<div class="iframe-right">
  <div class="right-title">
    <span class='iframe-right-select'>选集</span>
    <span class="iframe-right-toggle">收起</span>
  </div>
  <div class="right-main">
    <?php $general_options = get_option('ashuwp_general');
    $count = 1;
        foreach($meta_value as $pagelist) { ?>
           <a href="<?php echo site_url().'/play?l='.$post->ID.'&n='.$count;?>"  class="page-change-link-btn" data-url="<?php echo $pagelist["baseinfo_episode_link"];?>">
            <div class="foot-panel-show-list <?php if($count == ($sort+1)){echo 'active';}?>"><?php echo $pagelist["baseinfo_episode_sort"]?></div>
          </a>
      <?php $count++;}; ?>
    <div style="clear: both;"></div>
  </div>
</div>
</div>
<?php }?>
<?php $html = $general_options['qinmei_ad_pc_14'];echo html_entity_decode($html, ENT_QUOTES);?>


<div class="play-header">
  <div class="play-header-title video-info-title video-info-eposide">
    <a href="<?php echo get_permalink();?>"><?php the_title(); ?></a>
  	<span>第<?php
    echo $meta_value[$sort]['baseinfo_episode_sort']?>话</span>
  </div>
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
                <textarea id="comment" class="form-control-page" name="comment" rows="4" maxlength="65525" placeholder="请尽量详细描述集数等信息以便能够尽早解决" aria-required="true" required="required"></textarea>
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
<?php $html = $general_options['qinmei_ad_pc_15'];echo html_entity_decode($html, ENT_QUOTES);?>


<?php endwhile; ?>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/extents/DPlayer/hls.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/extents/DPlayer/DPlayer.min.js"></script>
<script>
<?php
$play_confirm = get_post_meta($post->ID,"baseinfo_play_setting",true);
if($play_confirm == 'true'){?>
const dp = new DPlayer({
    container: document.getElementById('dplayer'),
    screenshot: false,
    volume: 0.7,
    video: {
        url: '<?php echo $meta_value[$sort]['baseinfo_episode_link'];?>',
        pic: '<?php echo bloginfo('template_url').'/extents/DPlayer/video'.rand(1,4).'.jpeg';?>'
    },
    danmaku: {
      id: '<?php echo get_post_meta($post->ID,"baseinfo_dplayer_id",true).($sort+1);?>',
      api: 'https://api.prprpr.me/dplayer/',
      <?php
      if(!empty($meta_value[$sort]['baseinfo_episode_danmu'])){?>
      addition: ['https://api.prprpr.me/dplayer/bilibili?aid=<?php echo $page_play_bili;?>'],
      <?php }?>
      bottom: '15%',
    }
});

$(function(){
  showDanmu("<?php echo get_post_meta($post->ID,"baseinfo_dplayer_id",true).($sort+1);?>");
})



$(function(){
  $(".video-sidebar").height($(".video-html5-con").width()*0.5625);
  $()
});

<?php }else if($play_confirm == 'm3u8'){?>

const dp = new DPlayer({
    container: document.getElementById('dplayer'),
    screenshot: false,
    volume: 0.7,
    video: {
        url: '<?php echo $meta_value[$sort]['baseinfo_episode_link'];?>',
        type: 'hls',
        pic: '<?php echo bloginfo('template_url').'/extents/DPlayer/video'.rand(1,4).'.jpeg';?>'
    },
    danmaku: {
      id: '<?php echo get_post_meta($post->ID,"baseinfo_dplayer_id",true).($sort+1);?>',
      api: 'https://api.prprpr.me/dplayer/',
      <?php
      if(!empty($meta_value[$sort]['baseinfo_episode_danmu'])){?>
      addition: ['https://api.prprpr.me/dplayer/bilibili?aid=<?php echo $page_play_bili;?>'],
      <?php }?>
      bottom: '15%',
    }
});

$(function(){
  showDanmu("<?php echo get_post_meta($post->ID,"baseinfo_dplayer_id",true).($sort+1);?>");
})


$(function(){
  $(".video-sidebar").height($(".video-html5-con").width()*0.5625);
  $()
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
    var playurl = $(".foot-panel-show-list.active").parent().attr("data-url");
    playurl = $(this).attr("data-jiexi") + playurl;
    $("#iframe-player-con").attr("src",playurl);
  }
});
<?php }else{?>


$(document).on("click",".iframe-jiexi-list", function() {
  if($(this).hasClass("active")){
  }else{
    $(".iframe-jiexi-list").removeClass("active");
    $(this).addClass("active");
    var playurl = $(".foot-panel-show-list.active").parent().attr("data-url");
    playurl = $(this).attr("data-jiexi") + playurl;
    $("#iframe-player-con").attr("src",playurl);
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
  link[1] = $(".play-header a").html().trim();
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


$(function(){
  var height = $('.iframe-left').width()*0.5625;
  $('.iframe-left').css({'height':height});
  $('.iframe-right').css({'height':height})
})

$(function(){
  $('.iframe-right-toggle').click(function(){
    if($(this).hasClass("active")){
      $(this).removeClass("active");
      $(".iframe-left").css({"width":'calc(100% - 280px)'});
      var height =  $(".iframe-left").width()*0.5625;
      $(".iframe-left").css({'height':height +'px'});
      $(".iframe-right").css({"width":'280px','height':height});
      $(".iframe-right-select").show();
      $(this).text('收起');
    }else{
      $(this).addClass("active");
      $(".iframe-left").css({"width":'calc(100% - 85px)'});
      var height =  $(".iframe-left").width()*0.5625 + 95;
      $(".iframe-left").css({'height':height});
      $(".iframe-right").css({"width":'85px','height':height +'px'});
      $(".iframe-right-select").hide();
      $(this).text('展开');
    }
  })
});

$(function(){
  $('.video-sidebar-tab span').click(function(){
    $('.video-sidebar-tab span').removeClass('active');
    $(this).addClass('active');
    var index = $(this).index();
    $('.video-sidebar-con').removeClass('show');
    $('.video-sidebar-con').eq(index).addClass('show');
  })
});


$(document).on("click",".post-error-submit-btn-cancel", function() {
  $(this).parents(".message-post-con").hide();
});

$(document).on("click",".grey-bg", function() {
  $(this).parents(".message-post-con").hide();
});

$(document).on("click",".post-error-report .panel-toggle-btn", function() {
  $(this).next().show();
});

function showDanmu(danmuid){
  $.get("https://api.prprpr.me/dplayer/", { id: danmuid },
    function(data){
      var danmuData = data.danmaku;
      $(".danmu-num").html(danmuData.length);
      var listCon = '<ul>';
      for(var i=0; i<danmuData.length;i++){
        var list = '<li><div class="danmu-top-tab-time">' + timerefer(danmuData[i].time) + '</div><div class="danmu-top-tab-text">' + danmuData[i].text + '</div></li>';
        console.log(list);
        listCon += list;
      }
      listCon += '</ul>';
      $(".danmu-con").append(listCon);
  });
}
function timerefer(time){
  var min = (((Math.floor(time/60))/100).toFixed(2)).slice(2);
  var sec = (((Math.floor(time - min*60))/100).toFixed(2)).slice(2);
  return min + ":" + sec;
}
function arrsort(propertyName){
  return function(obj1,obj2){
    var value1 = obj1[propertyName];
    var value2 = obj2[propertyName];
    window.scrollTo(0,0);
    if(value1 < value2){
      return -1;
    }else if(value1 > value2){
      return 1
    }else{
      return 0;
    }
  }
}


</script>
<?php get_footer(); ?>
