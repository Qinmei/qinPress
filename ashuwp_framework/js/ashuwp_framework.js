/**
*Author: Ashuwp
*Author url: http://www.ashuwp.com
*Version: 6.2
**/

var baseurl = 'http://qinmeiss.com';


jQuery(document).ready(function($){
  var upload_frame,
      gallery_frame;

  //upload
  $('.ashuwp_field_area').on( 'click', 'a.ashu_upload_button', function( event ){

    event.preventDefault();

    upload_btn = $( this );

    if(upload_frame){
      upload_frame.open();
      return;
    }

    upload_frame = wp.media({
      title: 'Insert image',
      button: {
        text: 'Insert'
      },
      multiple: false
    });

    upload_frame.on('select',function(){
      var attachment = upload_frame.state().get('selection').first().toJSON();

      upload_btn.parent().find('.ashuwp_field_upload').val(attachment.url).trigger('change');


    });

    upload_frame.open();

  });

  $('.ashuwp_field_area').on('change focus blur onblur input', 'input.ashuwp_field_upload', function(){

    preview_div = $(this).parent().parent().find('.ashuwp_file_preview');;
    file_uri = $(this).val();

    if(file_uri){
      var index1 = file_uri.lastIndexOf('.'),
          index2 = file_uri.length,
          file_type = file_uri.substring(index1,index2),
          img_src = ashu_file_preview.img_base;

      if($.inArray(file_type,['.png','.jpg','.gif','.bmp','.svg'])!='-1'){
        img_src = file_uri;
      }else if($.inArray(file_type,['.zip','.rar','.7z','.gz','.tar','.bz','.bz2'])!='-1'){
        img_src += ashu_file_preview.img_path.archive;
      }else if($.inArray(file_type,['.mp3','.wma','.wav','.mod','.ogg','.au'])!='-1'){
        img_src += ashu_file_preview.img_path.audio;
      }else if($.inArray(file_type,['.avi','.mov','.wmv','.mp4','.flv','.mkv'])!='-1'){
        img_src += ashu_file_preview.img_path.video;
      }else if($.inArray(file_type,['.swf'])!='-1'){
        img_src += ashu_file_preview.img_path.interactive;
      }else if($.inArray(file_type,['.php','.js','.css','.json','.html','.xml'])!='-1'){
        img_src += ashu_file_preview.img_path.code;
      }else if($.inArray(file_type,['.doc','.docx','.pdf','.wps'])!='-1'){
        img_src += ashu_file_preview.img_path._document;
      }else if($.inArray(file_type,['.xls','.xlsx','.csv','.et','.ett'])!='-1'){
        img_src += ashu_file_preview.img_path.spreadsheet;
      }else if($.inArray(file_type,['.txt','.rtf'])!='-1'){
        img_src += ashu_file_preview.img_path._text;
      }else{
        img_src += ashu_file_preview.img_path._default;
      }

      $file_view = '<img src ="'+img_src+'" />';
      preview_div.html('').append($file_view);
    }else{
      preview_div.html('');
    }
  });

  //gallery
  $('.ashuwp_field_area').on('click', 'a.add_gallery', function(event){
    event.preventDefault();

    gallery_input = $(this).parent().find('.ashuwp_gallery_input');
    gallery_view = $(this).parent().find('.gallery_view');
    attachment_ids = gallery_input.val();

    if( gallery_frame ){
      gallery_frame.open();
      return;
    }

    gallery_frame = wp.media({
      title: 'Add to gallary',
      button: {
        text: 'Add to gallary'
      },
      multiple: true
    });

    gallery_frame.on('select', function(){
      var selection = gallery_frame.state().get('selection');
      selection.map( function( attachment ){
        attachment = attachment.toJSON();

        if ( attachment.id ) {
          attachment_ids = attachment_ids ? attachment_ids + "," + attachment.id : attachment.id;
          gallery_view.append('<div class="image" data-attachment_id="' + attachment.id + '"><img src="' + attachment.url + '" /><div class="actions"><a href="#" class="delete" title="Delete image">Delete</a></div></div>');
        }
      });

      gallery_input.val(attachment_ids);

    });

    gallery_frame.open();

  });
  $('.ashuwp_field_area').on('click', 'a.delete', function(event){

    gallery_container = $(this).closest('.gallery_container');

    $(this).closest('div.image').remove();

    var attachment_ids = '';
    gallery_container.find('div.image').css('cursor','default').each(function() {
      var attachment_id = $(this).attr( 'data-attachment_id' );
        attachment_ids = attachment_ids + attachment_id + ',';
    });

    gallery_container.find('.ashuwp_gallery_input').val( attachment_ids );

    return false;
  });
  function ashuwp_gallery_sortable(){
    $('.gallery_view').sortable({
      items: 'div.image',
      cursor: 'move',
      scrollSensitivity:40,
      forcePlaceholderSize: true,
      forceHelperSize: false,
      helper: 'clone',
      opacity: 0.65,
      placeholder: 'wc-metabox-sortable-placeholder',
      start:function(event,ui){
        ui.item.css('background-color','#f6f6f6');
      },
      stop:function(event,ui){
        ui.item.removeAttr('style');
      },
      update: function(event, ui) {
        var attachment_ids = '';
        $(this).find('div.image').css('cursor','default').each(function() {
          var attachment_id = $(this).attr( 'data-attachment_id' );
              attachment_ids = attachment_ids + attachment_id + ',';
        });
        $(this).parent().find('.ashuwp_gallery_input').val( attachment_ids );
      }
    });
  }
  ashuwp_gallery_sortable();

  //field multiple
  $('.ashuwp_field_area .multiple_wrap').on('click','a.add_item',function(){
    if(event){
      event.preventDefault();
    }


    multiple_wrap = $(this).closest('.multiple_wrap');
    data_name = $(this).attr('data_name');

    html_format = $('#' + data_name).html();
    count = 0;
    count = multiple_wrap.find('.multiple_item').length + 1;

    html_temp = html_format.replace(/({{i}})/g,count);

    $(this).before(html_temp);
    multiple_wrap.trigger('multiple_change');
    ashuwp_gallery_sortable();
  });

  $('.ashuwp_field_area .multiple_wrap').on('click','a.delete_item',function(){
    event.preventDefault();

    multiple_wrap = $(this).closest('.multiple_wrap');
    $(this).closest('.multiple_item').remove();
    multiple_wrap.trigger('multiple_change');
  });

  //colorpicker
  $('.ashuwp_color_picker input').wpColorPicker();
  $('.ashuwp_color_picker').on('multiple_change',function(){
    $('.ashuwp_color_picker input.ashuwp_field_input').each(function(){
      if( ! $(this).parent().hasClass('wp-picker-input-wrap') ){
        $(this).wpColorPicker();
      }
    });
  });

  //tab
  $( '.ashuwp_feild_tabs' ).tabs();

  //quick edit
  if(typeof(inlineEditPost)!='undefined'){
  var ashuwp_inline_edit = inlineEditPost.edit;
  inlineEditPost.edit = function( id ) {

		// "call" the original WP edit function
		// we don't want to leave WordPress hanging
		ashuwp_inline_edit.apply( this, arguments );

		// now we take care of our business

		// get the post ID
		var $post_id = 0;
		if ( typeof( id ) == 'object' ) {
			$post_id = parseInt( this.getId( id ) );
		}

		if ( $post_id > 0 ) {
			// define the edit row
			var $edit_row = $( '#edit-' + $post_id );
			var $post_row = $( '#post-' + $post_id );

			// get the data
			//var $book_author = $( '.column-book_author', $post_row ).text();
			//var $inprint = !! $('.column-inprint>*', $post_row ).prop('checked');

			// populate the data
			//$( ':input[name="book_author"]', $edit_row ).val( $book_author );
			//$( ':input[name="inprint"]', $edit_row ).prop('checked', $inprint );

      //text
      $( '.ashuwp_text_field .ashuwp_field_input', $edit_row ).each(function(){
        input_name = $(this).prop('name');
        col_name = '.column-'+input_name;
        input_val = $( col_name, $post_row ).text();
        $(this).val(input_val);
      });
      //numbers_array
      $( '.ashuwp_numbers_array_field .ashuwp_field_input', $edit_row ).each(function(){
        input_name = $(this).prop('name');
        col_name = '.column-'+input_name;
        input_val = $( col_name, $post_row ).text();
        $(this).val(input_val);
      });
      //color
      $( '.ashuwp_color_field .ashuwp_field_input', $edit_row ).each(function(){
        input_name = $(this).prop('name');
        col_name = '.column-'+input_name;
        color_data = $( col_name, $post_row ).find('span').attr('data-color');

        $(this).val(color_data);
        $(this).wpColorPicker();
      });
      //textarea
      $( '.ashuwp_textarea_field .ashuwp_field_textarea', $edit_row ).each(function(){
        input_name = $(this).prop('name');
        col_name = '.column-'+input_name;
        input_val = $( col_name, $post_row ).text();
        $(this).val(input_val);
      });
      //radio
      $( '.ashuwp_radio_field', $edit_row ).each(function(){
        input_name = $(this).find('.ashuwp_field_radio').eq(0).prop('name');
        col_name = '.column-'+input_name;
        input_val = $( col_name, $post_row ).text();
        $(this).find('.ashuwp_field_radio').each(function(){
          check_text = $(this).attr('data-text');
          if(input_val==check_text){
            $(this).prop('checked', true );
          }
        });
      });
      //checkbox
      $( '.ashuwp_checkbox_field', $edit_row ).each(function(){
        input_name = $(this).find('.ashuwp_field_checkbox').eq(0).prop('name');
        input_name = input_name.substr(0, input_name.length-2);
        col_name = '.column-'+input_name;
        input_val = $( col_name, $post_row ).text();
        check_values = input_val.split(',');

        $(this).find('.ashuwp_field_checkbox').each(function(){
          check_text = $(this).attr('data-text');

          if( $.inArray( check_text,check_values )!=-1){
            $(this).prop('checked', true );
          }
        });
      });

      //select
      $( '.ashuwp_select_field', $edit_row ).each(function(){
        input_name = $(this).find('.ashuwp_field_select').prop('name');
        col_name = '.column-'+input_name;
        input_val = $( col_name, $post_row ).text();
        $(this).find('option').each(function(){
          check_text = $(this).text();
          if(input_val==check_text){
            $(this).prop('selected', true );
          }
        });
      });
		}
	};
  }
});


$("#baseinfo-daouban-get-btn").click(function(){
   $("#baseinfo-daouban-get-btn").text('获取中....');
  var link = $("#baseinfo_douban_link").val();
  link = 'https://api.douban.com/v2/movie/subject/' + link;
   var txt1 = $("#baseinfo_another_name");
    var txt2 = $("#baseinfo_introduce");
    var txt3 = $("#baseinfo_director");
    var txt4 = $("#baseinfo_actor");
    var txt5 = $("#baseinfo_website");
    var txt6 = $("#baseinfo_area");
    var txt7 = $("#baseinfo_year");
    var txt8 = $("#baseinfo_kind");
    var txt9 = $("#baseinfo_first_play");
    var txt10 = $("#baseinfo_play_date");
    var txt11 = $("#baseinfo_episode_num");
    var txt12 = $("#baseinfo_rate");
    var txt13 = $("#baseinfo_rate_num");
    var txt14 = $("#baseinfo_commend");
    var txt15 = $("#baseinfo_img_link");
  $.ajax({
        url: link,
        type: 'GET',
        dataType: 'JSONP',//here
        success: function (data) {
          txt1.val(data.aka.join("/"));
          txt2.val(data.summary);
          txt3.val(data.directors.map(function(item,index,array){return item.name}).join("/"));
          txt4.val(data.casts.map(function(item,index,array){return item.name}).join("/"));
          txt5.val(data.website);
          txt6.val(data.countries.join(","));
          txt7.val(data.year);
          txt8.val(data.genres.join(','));
          txt9.val(data.year);
          txt10.val('');
          txt11.val(data.episodes_count);
          txt12.val(data.rating.average);
          txt13.val(data.ratings_count);
          txt14.val('');
          txt15.val(data.images.large);
          addareacatinfo();
          addyearcatinfo();
          addkindcatinfo();
          addtagsinfo();
          $("#baseinfo-daouban-get-btn").text('获取豆瓣信息');
        },
     error: function(msg){
        $("#baseinfo-daouban-get-btn").text('获取豆瓣信息');
        alert("加载错误，请稍后重试");
       }
    });
})

function addyearcatinfo(){
  var year = $("#animateyeardiv #animateyearchecklist .selectit");
  var getlist = $("#baseinfo_year").val().split(',');
  getlist.forEach(function(item,index,array){
    var that = item;
    var count = 0;
    for(var i =0; i<year.length;i++){
      if(year.eq(i).text().trim() == that){
        year.eq(i).children("input").attr("checked", true);
        count ++;
        break;
      }
    };
    if(count == 0){
      $("#newanimateyear").val(that);
      $("#animateyear-add-submit").click();
    }
  })
}

function addareacatinfo(){
  var area = $("#animateareadiv #animateareachecklist .selectit");
  var getlist = $("#baseinfo_area").val().split(',');
  getlist.forEach(function(item,index,array){
    var that = item;
    var count = 0;
    for(var i =0; i<area.length;i++){
      if(area.eq(i).text().trim() == that){
        area.eq(i).children("input").attr("checked", true);
        count ++;
        break;
      }
    };
    if(count == 0){
      $("#newanimatearea").val(that);
      $("#animatearea-add-submit").click();
    }
  })
}

function addkindcatinfo(){
  var kind = $("#animatekinddiv #animatekindchecklist .selectit");
  var getlist = $("#baseinfo_kind").val().split(',');
  getlist.forEach(function(item,index,array){
    var that = item;
    var count = 0;
    for(var i =0; i<kind.length;i++){
      if(kind.eq(i).text().trim() == that){
        kind.eq(i).children("input").attr("checked", true);
        count ++;
        break;
      }
    }
  })
}

function addtagsinfo(){
  var kind = $("#tagsdiv-animatetag #animatetag #new-tag-animatetag");
  var getlist = $("#baseinfo_kind").val();
  kind.val(getlist);
  $("#tagsdiv-animatetag #animatetag .tagadd").click();
}



$("#baseinfo-play-dilidili-btn").click( function(){
  getepisodeinfo('dilidili');
});

$("#baseinfo-play-qq-btn").click( function(){
  getepisodeinfo('qq');
});

$("#baseinfo-play-iqiyi-btn").click( function(){
  getepisodeinfo('iqiyi');
});


$("#baseinfo-play-letv-btn").click( function(){
  getepisodeinfo('letv');
});

$("#baseinfo-play-pptv-btn").click( function(){
  getepisodeinfo('pptv');
});


$("#baseinfo-play-bilibili-btn").click( function(){
  getepisodeinfo('bilibili');
});

$("#baseinfo-bangumi-get-btn").click( function(){
  getbgminfo();
});

function getbgminfo(){
  $("#baseinfo-bangumi-get-btn").text('获取信息中..');
  var subjectID = $('#baseinfo_play_bangumi').val();
  $.ajax({
   type: "POST",
   url: baseurl + '/wp-json/wp/v2/qinmei/getwebinfo',
   data:{
    type:'bgm',
    kind:'index',
    url:subjectID
   },
   success: function(msg){
    var resdata = JSON.parse(msg);
    var txt1 = $("#baseinfo_another_name");
    var txt2 = $("#baseinfo_introduce");
    var txt3 = $("#baseinfo_director");
    var txt4 = $("#baseinfo_actor");
    var txt5 = $("#baseinfo_website");
    var txt6 = $("#baseinfo_area");
    var txt7 = $("#baseinfo_year");
    var txt8 = $("#baseinfo_kind");
    var txt9 = $("#baseinfo_first_play");
    var txt10 = $("#baseinfo_play_date");
    var txt11 = $("#baseinfo_episode_num");
    var txt12 = $("#baseinfo_rate");
    var txt13 = $("#baseinfo_rate_num");
    var txt14 = $("#baseinfo_commend");
    var txt15 = $("#baseinfo_img_link");

    txt1.val( resdata.name_cn );
    txt2.val( resdata.summary );

    try {
        var staff = resdata.staff.map(function(item){
      return item.name_cn + ':' + item.jobs[0];
        });
        txt3.val(staff.join('/') );

        var crt = resdata.staff.map(function(item){
          return item.name_cn + ':' + item.actors[0].name;
        });

        txt4.val( crt.join('/') );
        txt14.val( resdata.topic[0].title );
    }
    catch(err) {
        console.log('error')
    };

    txt5.val( '' );
    txt6.val( '日本' );
    txt7.val( resdata.air_date.split("-")[0] + '-' + resdata.air_date.split("-")[1] );
    txt8.val( resdata.tag );
    txt9.val( resdata.air_date );
    txt10.val( resdata.air_weekday );
    txt11.val( resdata.eps_count );
    txt12.val( resdata.rating.score );
    txt13.val( resdata.rating.total );
    txt15.val( resdata.images.large );

    var episode = $("#baseinfo_episode .ashuwp_field.ashuwp_group_field.ashuwp_field_group");
    var confirm = episode.find(".multiple_item.multiple_group_item");
    for(var i = 0; i<resdata.eps.length;i++){

     if(resdata.eps[i].status == 'Air'){
       if(confirm.eq(i).length >0){

       }else{
         $("#baseinfo_episode a.add_item").click();
         confirm = episode.find(".multiple_item.multiple_group_item");
       };

       var input1 = confirm.eq(i).find(".ashuwp_field_input").eq(0);
       var input2 = confirm.eq(i).find(".ashuwp_field_input").eq(1);
       var input3 = confirm.eq(i).find(".ashuwp_field_input").eq(3);

       var sort = fixed(i+1,2);

      confirm.eq(i).find(".ashuwp_field_input").eq(0).val(i+1);
      confirm.eq(i).find(".ashuwp_field_input").eq(1).val(sort + ' ' + resdata.eps[i].name_cn);
      };
    };

    addyearcatinfo();
    addareacatinfo();
    addkindcatinfo();
    addtagsinfo();
    $("#baseinfo-bangumi-get-btn").text('获取ID信息');

   },
   error: function(msg){
    $("#baseinfo-bangumi-get-btn").text('获取ID信息');
    alert("加载错误，请稍后重试");
   }
 });
}

function getepisodeinfo(type){
  var link = $('#baseinfo_play_'+ type).val();
  switch (type){
    case 'qq':
      link = 'https://v.qq.com/detail/'+link+'.html';
      break;
    case 'iqiyi':
      link = 'https://www.iqiyi.com/'+link+'.html';
      break;
    case 'letv':
      link = 'https://www.le.com/comic/'+link+'.html';
      break;
    case 'pptv':
      link = 'http://v.pptv.com/page/'+link+'.html';
      break;
    case 'bilibili':
      link = 'https://bangumi.bilibili.com/anime/'+link;
      break;
  }

  var episode = $("#baseinfo_episode .ashuwp_field.ashuwp_group_field.ashuwp_field_group");
  var confirm = episode.find(".multiple_item.multiple_group_item");
   $.ajax({
        url: baseurl + '/wp-json/wp/v2/qinmei/getwebinfo',
        type: 'POST',
        data:{
          url:link,
          type:type,
          kind:'index',
        },
        success: function (data) {
          console.log("succes",data);
          var video = JSON.parse(data);
         for(var i = 0;i<video.length;i++){
          if(confirm.eq(i).length >0){}else{
            $("a.add_item").click();
            confirm = episode.find(".multiple_item.multiple_group_item");
          };
          confirm.eq(i).find(".ashuwp_field_input").eq(0).val(i+1);
          confirm.eq(i).find(".ashuwp_field_input").eq(1).val(video[i].title);
          confirm.eq(i).find(".ashuwp_field_input").eq(3).val(video[i].link);
         }
        },
        error:function(msg){
             alert("域名未授权");
        }
    });
}

$(function(){
  var create = '<a class="page-title-action qinmei-search-action">聚合搜索</a>'
  var animate = $(".wp-heading-inline").text();
  if(animate === '编辑动漫' || animate === '新建一个动漫'){
    $(".wp-heading-inline").append(create);
  }
});


var tab = '<div class="qinmei-tab" style="position:fixed;bottom:30px;left:30px;width:600px;height:400px;box-shadow:0 0 15px grey;z-index:9999;background-color:rgba(255,255,255,0.96);">\
    <div class="container" style="position:relative">\
        <div class="qinmei-close-btn" style="position:absolute;top:0;right:0;width:60px;height:40px;background-color:rgba(0,0,0,0.8);color:white;text-align:center;line-height:40px;">关闭</div>\
        <div class="qinmei-tab-title" style="height:40px;line-height:40px;padding-left:20px;border-bottom:solid 1px rgba(0,0,0,.2);">搜索结果: <span></span></div>\
        <div class="qinmei-tab-main" style="width:600px;height:360px;position:relative;">\
            <div class="qinmei-tab-main-left" style="width:120px;left:0;top:0;position: absolute;height:100%;border-right: solid 1px rgba(0,0,0,.2);">\
             <div class="main-left-list" style="width:120px;height:40px;border-bottom:solid 1px rgba(0,0,0,.2);text-align:center;line-height:40px;cursor:pointer">Bangumi</div>\
                <div class="main-left-list" style="width:120px;height:40px;border-bottom:solid 1px rgba(0,0,0,.2);text-align:center;line-height:40px;cursor:pointer">B站</div>\
                <div class="main-left-list" style="width:120px;height:40px;border-bottom:solid 1px rgba(0,0,0,.2);text-align:center;line-height:40px;cursor:pointer">嘀哩嘀哩</div>\
                 <div class="main-left-list" style="width:120px;height:40px;border-bottom:solid 1px rgba(0,0,0,.2);text-align:center;line-height:40px;cursor:pointer">新世界动漫</div>\
                <div class="main-left-list" style="width:120px;height:40px;border-bottom:solid 1px rgba(0,0,0,.2);text-align:center;line-height:40px;cursor:pointer">风车动漫</div>\
                <div class="main-left-list" style="width:120px;height:40px;border-bottom:solid 1px rgba(0,0,0,.2);text-align:center;line-height:40px;cursor:pointer">PPTV</div>\
                <div class="main-left-list" style="width:120px;height:40px;border-bottom:solid 1px rgba(0,0,0,.2);text-align:center;line-height:40px;cursor:pointer">乐视</div>\
                <div class="main-left-list" style="width:120px;height:40px;border-bottom:solid 1px rgba(0,0,0,.2);text-align:center;line-height:40px;cursor:pointer">爱奇艺</div>\
                <div class="main-left-list" style="width:120px;height:40px;border-bottom:solid 1px rgba(0,0,0,.2);text-align:center;line-height:40px;cursor:pointer">优酷</div>\
                <div class="main-left-list" style="width:120px;height:40px;border-bottom:solid 1px rgba(0,0,0,.2);text-align:center;line-height:40px;cursor:pointer">腾讯视频</div>\
            </div>\
            <div class="qinmei-tab-main-right" style="width:480px;height:360px;padding:15px;margin-left:120px;overflow-y:scroll;">\
                <div class="main-right-list">加载中.....</div>\
                <div class="main-right-list" style="display:none;">加载中.....</div>\
                <div class="main-right-list" style="display:none;">加载中.....</div>\
                <div class="main-right-list" style="display:none;">加载中.....</div>\
                <div class="main-right-list" style="display:none;">加载中.....</div>\
                <div class="main-right-list" style="display:none;">加载中.....</div>\
                <div class="main-right-list" style="display:none;">加载中.....</div>\
                <div class="main-right-list" style="display:none;">加载中.....</div>\
                <div class="main-right-list" style="display:none;">加载中.....</div>\
                <div class="main-right-list" style="display:none;">加载中.....</div>\
            </div>\
        </div>\
    </div>\
</div>'


$(document).on("click",".qinmei-search-action", function() {
  var title = $("#titlewrap input").val();
  $.ajax({
   type: "GET",
   url: baseurl + '/wp-json/wp/v2/qinmei/search',
   data: "title=" + title,
   success: function(msg){
    console.log(msg);
    $(".main-right-list").empty();
     var data = msg;
     var dilidili = data.dilidili;
     var bilibili = data.bilibili;
     var xsjdm = data.xsjdm;
     var fcdm = data.fcdm;
     var pptv = data.pptv;
     var letv = data.letv;
     var iqiyi = data.iqiyi;
     var youku = data,youku;
     var qq = data.tecenttv;
     var bgm = data.bgm;


     var dilidiv = '';
     var bilidiv = '';
     var xsjdmdiv = '';
     var fcdmdiv = '';
     var pptvdiv = '';
     var letvdiv ='';
     var iqiyidiv ='';
     var youkudiv = '';
     var qqdiv = '';
     var bgmdiv = '';

    if(bgm != undefined){
      if(bgm.list.length > 0){
      for(var i = 0;i<bgm.list.length;i++){
       bgmdiv+= '<a style="display:block;width:100%;line-height:1.6em;" target="_blank" href="'  + bgm.list[i].url + '">' +bgm.list[i].name + '/' + bgm.list[i].name_cn + '</a>';
      };
      $(".main-right-list").eq(0).append(bgmdiv);
    }
    }else{$(".main-right-list").eq(0).append('暂无搜索结果')};



    if(dilidili != undefined){
      if(dilidili.length > 0){
      for(var i = 0;i<dilidili.length;i++){
       dilidiv+= '<a style="display:block;width:100%;line-height:1.6em;" target="_blank" href="'  + dilidili[i].link + '">' + dilidili[i].title + '</a>';
      };
      $(".main-right-list").eq(2).append(dilidiv);
    }
    }else{$(".main-right-list").eq(2).append('暂无搜索结果')};
    if(bilibili != undefined){
      if(bilibili.length > 0){
       for(var i = 0;i<bilibili.length;i++){
       bilidiv+= '<a style="display:block;width:100%;line-height:1.6em;" target="_blank" href="'  + bilibili[i].link + '">' + bilibili[i].title + '</a>';
     };
     $(".main-right-list").eq(1).append(bilidiv);
   }
    }else{$(".main-right-list").eq(1).append('暂无搜索结果')};
    if(xsjdm != undefined){
     if(xsjdm.length > 0){
      for(var i = 0;i<xsjdm.length;i++){
       xsjdmdiv+= '<a style="display:block;width:100%;line-height:1.6em;" target="_blank" href="'  + xsjdm[i].link + '">' + xsjdm[i].title + '</a>';
     };
      $(".main-right-list").eq(3).append(xsjdmdiv)
    }
    }else{$(".main-right-list").eq(3).append('暂无搜索结果')};
    if(fcdm != undefined){
     if(fcdm.length > 0){
      for(var i = 0;i<fcdm.length;i++){
       fcdmdiv+= '<a style="display:block;width:100%;line-height:1.6em;" target="_blank" href="'  + fcdm[i].link + '">' + fcdm[i].title + '</a>';
     };
      $(".main-right-list").eq(4).append(fcdmdiv);
    }
    }else{$(".main-right-list").eq(4).append('暂无搜索结果')};
    if(pptv != undefined){
     if(pptv.length > 0){
       for(var i = 0;i<pptv.length;i++){
       pptvdiv+= '<a style="display:block;width:100%;line-height:1.6em;" target="_blank" href="'  + pptv[i].link + '">' + pptv[i].title + '</a>';
     };
      $(".main-right-list").eq(5).append(pptvdiv);
    }
    }else{$(".main-right-list").eq(5).append('暂无搜索结果')};
    if(letv != undefined){
     if(letv.length > 0){
      for(var i = 0;i<letv.length;i++){
       letvdiv+= '<a style="display:block;width:100%;line-height:1.6em;" target="_blank" href="'  + letv[i].link + '">' + letv[i].title + '</a>';
     };
      $(".main-right-list").eq(6).append(letvdiv)
    }
    }else{$(".main-right-list").eq(6).append('暂无搜索结果')};
    if(iqiyi != undefined){
     if(iqiyi.length > 0){
      for(var i = 0;i<iqiyi.length;i++){
       iqiyidiv+= '<a style="display:block;width:100%;line-height:1.6em;" target="_blank" href="'  + iqiyi[i].link + '">' + iqiyi[i].title + '</a>';
     };
      $(".main-right-list").eq(7).append(iqiyidiv)
    }
    }else{$(".main-right-list").eq(7).append('暂无搜索结果')};
    if(youku != undefined){
     if(youku.length > 0){
      for(var i = 0;i<youku.length;i++){
       youkudiv+= '<a style="display:block;width:100%;line-height:1.6em;" target="_blank" href="'  + youku[i].link + '">' + youku[i].title + '</a>';
     };
      $(".main-right-list").eq(8).append(youkudiv)
    }
    }else{$(".main-right-list").eq(8).append('暂无搜索结果')};
    if(qq != undefined){
     if(qq.length > 0){
           for(var i = 0;i<qq.length;i++){
       qqdiv+= '<a style="display:block;width:100%;line-height:1.6em;" target="_blank" href="'  + qq[i].link + '">' + qq[i].title + '</a>';
     };
      $(".main-right-list").eq(9).append(qqdiv)
    }
    }else{$(".main-right-list").eq(9).append('暂无搜索结果')};
   },
    error:function(msg){
        $(".main-right-list").append('搜索失败，可能没有结果');
    }
});
  $("html").append(tab);
    $(".qinmei-tab-title span").html(title);
});

$(document).on("click",".qinmei-close-btn", function() {
  $(".qinmei-tab").hide();
});

$(document).on("click",".main-left-list", function() {
  $('.main-left-list').css({"background-color":'transparent'});
  $(this).css({"background-color":'orange'});
  index = $(this).index();
  $(".main-right-list").hide();
  $(".main-right-list").eq(index).show();
});


$("#baseinfo-link_transfer_btn").click(function(){
    var data = $("#baseinfo_link_transfer").val();
    data = parseInt(data);

    var episode = $("#baseinfo_episode .ashuwp_field.ashuwp_group_field.ashuwp_field_group");
    var confirm = episode.find(".multiple_item.multiple_group_item");

    for(var i = 0; i<data;i++){
     if(confirm.eq(i).length >0){

     }else{
       $("#baseinfo_episode a.add_item").click();
       confirm = episode.find(".multiple_item.multiple_group_item");
     };
     var input1 = confirm.eq(i).find(".ashuwp_field_input").eq(0);
     var input2 = confirm.eq(i).find(".ashuwp_field_input").eq(1);
     var input3 = confirm.eq(i).find(".ashuwp_field_input").eq(3);

     var sort = fixed(i+1,2);

     if(input1.val() == ''){
      confirm.eq(i).find(".ashuwp_field_input").eq(0).val(i+1);
     }

     if(input2.val() == ''){
      confirm.eq(i).find(".ashuwp_field_input").eq(1).val(sort);
     }

     if(input3.val() == ''){
      confirm.eq(i).find(".ashuwp_field_input").eq(3).val(sort + '.mp4');
     }
    }
})

function fixed(num, length) {
  return (Array(length).join("0") + num).slice(-length);
}
