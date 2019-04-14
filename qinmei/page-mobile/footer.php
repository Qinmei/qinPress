
            <div class="footer">
            </div>
        </div>
      </div>
    </div>
  </div>
<div class="index-search">
  <div class="index-search-bg">
    <div class="index-search-tips">
      <div class="index-search-tips-hot">
        <p>热门搜索</p>
       <?php
       $general_options = get_option('ashuwp_general');
			if(empty($general_options['tab7_modules'])){
						  echo '<a href="/N037"><div class="bg">东京喰种</div></a>
								<a href="/N102"><div class="bg">国家队</div></a>
								<a href="/N108"><div class="bg">紫罗兰永恒花园</div></a>
								<a href="/N105"><div class="bg">Overlord</div></a>
								<a href="/N001"><div class="bg">进击的巨人</div></a>
								<a href="/N025"><div class="bg">一拳超人</div></a>
								<a href="/N054"><div class="bg">超电磁炮</div></a>
								<a href="/N032"><div class="bg">刀剑神域</div></a>';
									}else{
									foreach($general_options['tab7_modules'] as $list){?>
									<a href="<?php echo $list['tab7_modules_link']; ?>"><div class="bg"><?php echo $list['tab7_modules_title']; ?></div></a>
									<?php }}?>
        <div style="clear:both;height:0;overflow:hidden;"></div>
      </div>
    </div>
  </div>
</div>
<script>
$(function () {
  $('.nav-bar-search').click(function(){
    if($("#searchform").is(":hidden")){
      history.pushState({username: "serch"}, "search");
      $(".icon-qinmei").hide();
      $("#searchform").show();
      $('.search-kuang').animate({width:'100%'},function(){
        $(this).focus();
      });
      $('.index-search').slideDown();
    }else{
      if($(".search-kuang").val().length == 0){
        $('.search-kuang').animate({width:'0'},'fast',function(){
          $('#searchform').hide();
          $(".icon-qinmei").show();
        });
        $('.index-search').slideUp();
      }else{
      $("#searchform").submit();
    }
    }
  });

  window.onpopstate = function(event){
    $('.search-kuang').animate({width:'0'},'fast',function(){
          $('#searchform').hide();
          $(".icon-qinmei").show();
        });
    $('.index-search').slideUp();
    if($('.comments-discuss-sec').length > 0){
      $('.comments-discuss-sec').slideUp();
    }
  }

});

$(function () {
  if(localStorage.playHistory != undefined ){
    var history = JSON.parse(localStorage.playHistory);
    var listText1 = '<a href="/?s=';
    var listText2 = '">';
    var listText3 = '</a>';
    var ul = '<div class="index-search-tips-history index-search-tips-hot"><p style="display: flex;justify-content: space-between;align-items: center;">历史纪录<i class="fa fa-times" aria-hidden="true"></i></p><p>';
    for(var i=0;i<history.length;i++){
      var list = listText1 + history[i] + listText2 + history[i] + listText3;
        ul = ul + list;
    };
    ul = ul +'</p></div>'
    var node = $('.index-search-tips');
    node.append(ul);
  };

  $(".fa-times").click(function(){
    localStorage.removeItem('playHistory');
    $('.index-search-tips-history').remove();
  });
});
</script>
</body>
</html>
