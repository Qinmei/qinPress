/**
*Author: Ashuwp
*Author url: http://www.ashuwp.com
*Version: 6.2
**/
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
    event.preventDefault();
    
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
        console.log(input_name);
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
  var link = $("#baseinfo_douban_link").val();
  var pageinfo = <?php
/**
 * 
 * @authors Your Name (you@example.org)
 * @date    2017-12-24 12:01:25
 * @version $Id$
 */
function curl_get($url,$laiyuan='',$post='',$cookie='', $returnCookie=0){
   $mobile=isMobile();
        if($mobile){
          if(isset($_SERVER['HTTP_USER_AGENT'])){
            $useragent=$_SERVER['HTTP_USER_AGENT'];
          }else{
            $useragent='Mozilla/5.0 (iPhone; CPU iPhone OS 11_1_1 like Mac OS X) AppleWebKit/604.3.5 (KHTML, like Gecko) Version/11.0 Mobile/15B150 Safari/604.1';
          }
        }else{
          if(isset($_SERVER['HTTP_USER_AGENT'])){
            $useragent=$_SERVER['HTTP_USER_AGENT'];
          }else{
            $useragent='Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)';
          }
        }
        if(empty($laiyuan)){
            $laiyuan='http://www.baidu.com';
        }

        $ip=getUserIp();//获取用户IP
        $headers['CLIENT-IP'] = $ip; 
        $headers['X-FORWARDED-FOR'] = $ip;
        $headerArr = array(); 
        foreach( $headers as $n => $v ) { 
            $headerArr[] = $n .':' . $v;  
        }


        
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt ($curl, CURLOPT_HTTPHEADER ,$headerArr);  //构造IP
        curl_setopt($curl, CURLOPT_USERAGENT, $useragent);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($curl, CURLOPT_AUTOREFERER, 1);//当根据Location:重定向时，自动设置header中的Referer:信息。
        curl_setopt($curl, CURLOPT_REFERER, $laiyuan);//    在HTTP请求头中"Referer: "的内容。来
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);//i不验证ssl证书
        if($post) {
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($post));
        }
        if($cookie) {
            curl_setopt($curl, CURLOPT_COOKIE, $cookie);
        }
        curl_setopt($curl, CURLOPT_HEADER, $returnCookie);
        curl_setopt($curl, CURLOPT_TIMEOUT, 20);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);//在启用CURLOPT_RETURNTRANSFER的时候，返回原生的（Raw）输出。
        $data = curl_exec($curl);
        if (curl_errno($curl)) {
            return curl_error($curl);
        }
        curl_close($curl);
        if($returnCookie){
            list($header, $body) = explode("\r\n\r\n", $data, 2);
            preg_match_all("/Set\-Cookie:([^;]*);/", $header, $matches);
            $info['cookie']  = substr($matches[1][0], 1);
            $info['content'] = $body;
            return $info;
        }else{
            return $data;
        }
}

function getUserIp(){    //从用户中获取IP
    $ip = '';    
    if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])){        
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];    
    }elseif(isset($_SERVER['HTTP_CLIENT_IP'])){        
        $ip = $_SERVER['HTTP_CLIENT_IP'];    
    }else{        
        $ip = $_SERVER['REMOTE_ADDR'];    
    }
    $ip_arr = explode(',', $ip);
    return $ip_arr[0];
 }

 function randip(){  //随机生成IP
     $ip_long = array(  
        array('607649792', '608174079'), //36.56.0.0-36.63.255.255  
        array('1038614528', '1039007743'), //61.232.0.0-61.237.255.255  
        array('1783627776', '1784676351'), //106.80.0.0-106.95.255.255  
        array('2035023872', '2035154943'), //121.76.0.0-121.77.255.255  
        array('2078801920', '2079064063'), //123.232.0.0-123.235.255.255  
        array('-1950089216', '-1948778497'), //139.196.0.0-139.215.255.255  
        array('-1425539072', '-1425014785'), //171.8.0.0-171.15.255.255  
        array('-1236271104', '-1235419137'), //182.80.0.0-182.92.255.255  
        array('-770113536', '-768606209'), //210.25.0.0-210.47.255.255  
        array('-569376768', '-564133889'), //222.16.0.0-222.95.255.255  
    ); 
 $rand_key = mt_rand(0, 9); 
 $ip= long2ip(mt_rand($ip_long[$rand_key][0], $ip_long[$rand_key][1]));//随机生成国内某个ip 
 return $ip;
 }

//判断是否移动端
function isMobile(){
    // 如果有HTTP_X_WAP_PROFILE则一定是移动设备
    if (isset ($_SERVER['HTTP_X_WAP_PROFILE'])){
        return true;
    }elseif (isset ($_SERVER['HTTP_VIA'])){ 
      // 如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息
        // 找不到为flase,否则为true
        return stristr($_SERVER['HTTP_VIA'], "wap") ? true : false;
    }else{
      $useragent=isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';  
      $useragent_commentsblock=preg_match('|\(.*?\)|',$useragent,$matches)>0?$matches[0]:'';        
    
      $mobile_os_list=array('Google Wireless Transcoder','Windows CE','WindowsCE','Symbian','Android','armv6l','armv5','Mobile','CentOS','mowser','AvantGo','Opera Mobi','J2ME/MIDP','Smartphone','Go.Web','Palm','iPAQ');
      $mobile_token_list=array('Profile/MIDP','Configuration/CLDC-','160×160','176×220','240×240','240×320','320×240','UP.Browser','UP.Link','SymbianOS','PalmOS','PocketPC','SonyEricsson','Nokia','BlackBerry','Vodafone','BenQ','Novarra-Vision','Iris','NetFront','HTC_','Xda_','SAMSUNG-SGH','Wapaka','DoCoMo','iPhone','iPod');  

            
      $found_mobile=CheckSubstrs($mobile_os_list,$useragent_commentsblock) || CheckSubstrs($mobile_token_list,$useragent);  
      if ($found_mobile){  
          return true;  
      }else{  
          return false;  
      }  
    }
    
 }
  function CheckSubstrs($substrs,$text){  
        foreach($substrs as $substr)  
            if(false!==strpos($text,$substr)){  
                return true;  
            }  
            return false;  
    }


function dump($vars, $label = '', $return = false)
{
    if (ini_get('html_errors')) {
        $content = "<pre>\n";
        if ($label != '') {
            $content .= "<strong>{$label} :</strong>\n";
        }
        $content .= htmlspecialchars(print_r($vars, true));
        $content .= "\n</pre>\n";
    } else {
        $content = $label . " :\n" . print_r($vars, true);
    }
    if ($return) { return $content; }
    echo $content;
    return null;
}


 /**
     * 判断是否为utf8字符串
     * @parem $str
     * @return bool
     */
function is_utf8($str)
    {
        if ($str === mb_convert_encoding(mb_convert_encoding($str, "UTF-32", "UTF-8"), "UTF-8", "UTF-32"))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    /**
     * 获取文件编码
     * @param $string
     * @return string
     */
    function get_encoding($string)
    {
        $encoding = mb_detect_encoding($string, array('UTF-8', 'GBK', 'GB2312', 'LATIN1', 'ASCII', 'BIG5'));
        return strtolower($encoding);
    }

    /**
     * 转换数组值的编码格式
     * @param  array $arr           
     * @param  string $toEncoding   
     * @param  string $fromEncoding 
     * @return array                
     */
  function array_iconv($arr, $from_encoding, $to_encoding)
    {
        eval('$arr = '.iconv($from_encoding, $to_encoding.'//IGNORE', var_export($arr,TRUE)).';');
        return $arr;
    }

class selector
{
    /**
     * 版本号
     * @var string
     */
    const VERSION = '1.0.2';
    public static $dom = null;
    public static $dom_auth = '';
    public static $xpath = null;
    public static $error = null;

    public static function select($html, $selector, $selector_type = 'xpath')
    {
        if (empty($html) || empty($selector)) 
        {
            return false;
        }

        $selector_type = strtolower($selector_type);
        if ($selector_type == 'xpath') 
        {
            return self::_xpath_select($html, $selector);
        }
        elseif ($selector_type == 'regex') 
        {
            return self::_regex_select($html, $selector);
        }
        elseif ($selector_type == 'css') 
        {
            return self::_css_select($html, $selector);
        }
    }

    public static function remove($html, $selector, $selector_type = 'xpath')
    {
        if (empty($html) || empty($selector)) 
        {
            return false;
        }

        $remove_html = "";
        $selector_type = strtolower($selector_type);
        if ($selector_type == 'xpath') 
        {
            $remove_html = self::_xpath_select($html, $selector, true);
        }
        elseif ($selector_type == 'regex') 
        {
            $remove_html = self::_regex_select($html, $selector, true);
        }
        elseif ($selector_type == 'css') 
        {
            $remove_html =  self::_css_select($html, $selector, true);
        }
        $html = str_replace($remove_html, "", $html);
        return $html;
    }

    /**
     * xpath选择器
     * 
     * @param mixed $html
     * @param mixed $selector
     * @return void
     * @author seatle <seatle@foxmail.com> 
     * @created time :2016-10-26 12:53
     */
    private static function _xpath_select($html, $selector, $remove = false)
    {
        if (!is_object(self::$dom))
        {
            self::$dom = new DOMDocument();
        }

        // 如果加载的不是之前的HTML内容，替换一下验证标识
        if (self::$dom_auth != md5($html)) 
        {
            self::$dom_auth = md5($html);
            @self::$dom->loadHTML('<?xml encoding="UTF-8">'.$html);
            self::$xpath = new DOMXpath(self::$dom);
        }

        //libxml_use_internal_errors(true);
        //self::$dom->loadHTML('<?xml encoding="UTF-8">'.$html);
        //$errors = libxml_get_errors();
        //if (!empty($errors)) 
        //{
            //print_r($errors);
            //exit;
        //}

        $elements = @self::$xpath->query($selector);
        if ($elements === false)
        {
            self::$error = "the selector in the xpath(\"{$selector}\") syntax errors";
            return false;
        }

        $result = array();
        if (!is_null($elements)) 
        {
            foreach ($elements as $element) 
            {
                // 如果是删除操作，取一整块代码
                if ($remove) 
                {
                    $content = self::$dom->saveXml($element);
                }
                else 
                {
                    $nodeName = $element->nodeName;
                    $nodeType = $element->nodeType;     // 1.Element 2.Attribute 3.Text
                    //$nodeAttr = $element->getAttribute('src');
                    //$nodes = util::node_to_array(self::$dom, $element);
                    //echo $nodes['@src']."\n";
                    // 如果是img标签，直接取src值
                    if ($nodeType == 1 && in_array($nodeName, array('img'))) 
                    {
                        $content = $element->getAttribute('src');
                    }
                    // 如果是标签属性，直接取节点值
                    elseif ($nodeType == 2 || $nodeType == 3 || $nodeType == 4) 
                    {
                        $content = $element->nodeValue;
                    }
                    else 
                    {
                        // 保留nodeValue里的html符号，给children二次提取
                        $content = self::$dom->saveXml($element);
                        //$content = trim(self::$dom->saveHtml($element));
                        $content = preg_replace(array("#^<{$nodeName}.*>#isU","#</{$nodeName}>$#isU"), array('', ''), $content);
                    }
                }
                $result[] = $content;
            }
        }
        if (empty($result)) 
        {
            return false;
        }
        // 如果只有一个元素就直接返回string，否则返回数组
        return count($result) > 1 ? $result : $result[0];
    }

    /**
     * css选择器
     * 
     * @param mixed $html
     * @param mixed $selector
     * @return void
     * @author seatle <seatle@foxmail.com> 
     * @created time :2016-10-26 12:53
     */
    private static function _css_select($html, $selector, $remove = false)
    {
        $selector = self::css_to_xpath($selector);
        //echo $selector."\n";
        //exit("\n");
        return self::_xpath_select($html, $selector, $remove);
        // 如果加载的不是之前的HTML内容，替换一下验证标识
        //if (self::$dom_auth['css'] != md5($html)) 
        //{
            //self::$dom_auth['css'] = md5($html);
            //phpQuery::loadDocumentHTML($html); 
        //}
        //if ($remove) 
        //{
            //return phpQuery::pq($selector)->remove(); 
        //}
        //else 
        //{
            //return phpQuery::pq($selector)->html(); 
        //}
    }

    /**
     * 正则选择器
     * 
     * @param mixed $html
     * @param mixed $selector
     * @return void
     * @author seatle <seatle@foxmail.com> 
     * @created time :2016-10-26 12:53
     */
    private static function _regex_select($html, $selector, $remove = false)
    {
        if(@preg_match_all($selector, $html, $out) === false)
        {
            self::$error = "the selector in the regex(\"{$selector}\") syntax errors";
            return false;
        }
        $count = count($out);
        $result = array();
        // 一个都没有匹配到
        if ($count == 0) 
        {
            return false;
        }
        // 只匹配一个，就是只有一个 ()
        elseif ($count == 2) 
        {
            // 删除的话取匹配到的所有内容
            if ($remove) 
            {
                $result = $out[0];
            }
            else 
            {
                $result = $out[1];
            }
        }
        else 
        {
            for ($i = 1; $i < $count; $i++) 
            {
                // 如果只有一个元素，就直接返回好了
                $result[] = count($out[$i]) > 1 ? $out[$i] : $out[$i][0];
            }
        }
        if (empty($result)) 
        {
            return false;
        }
        
        return count($result) > 1 ? $result : $result[0];
    }

    public static function find_all($html, $selector)
    {
    }

    
    public static function css_to_xpath($selectors) 
    {
    $queries = self::parse_selector($selectors);
        $delimiter_before = false;
        $xquery = '';
        foreach($queries as $s) 
        {
            // TAG
            $is_tag = preg_match('@^[\w|\||-]+$@', $s) || $s == '*';
            if ($is_tag) 
            {
                $xquery .= $s;
            } 
            // ID
            else if ($s[0] == '#') 
            {
                if ($delimiter_before)
                {
                    $xquery .= '*';
                }
                // ID用精确查询
                $xquery .= "[@id='".substr($s, 1)."']";
            }
            // CLASSES
            else if ($s[0] == '.') 
            {
                if ($delimiter_before)
                {
                    $xquery .= '*';
                }
                // CLASS用模糊查询
                $xquery .= "[contains(@class,'".substr($s, 1)."')]";
            }
            // ATTRIBUTES
            else if ($s[0] == '[') 
            {
                if ($delimiter_before)
                {
                    $xquery .= '*';
                }
                // strip side brackets
                $attr = trim($s, '][');
                // attr with specifed value
                if (mb_strpos($s, '=')) 
                {
                    $value = null;
                    list($attr, $value) = explode('=', $attr);
                    $value = trim($value, "'\"");
                    if (self::is_regexp($attr)) 
                    {
                        // cut regexp character
                        $attr = substr($attr, 0, -1);
                        $xquery .= "[@{$attr}]";
                    } 
                    else 
                    {
                        $xquery .= "[@{$attr}='{$value}']";
                    }
                } 
                // attr without specified value
                else 
                {
                    $xquery .= "[@{$attr}]";
                }
            } 
            // ~ General Sibling Selector
            else if ($s[0] == '~')
            {
            }
            // + Adjacent sibling selectors
            else if ($s[0] == '+') 
            {
            } 
            // PSEUDO CLASSES
            else if ($s[0] == ':') 
            {
            }
            // DIRECT DESCENDANDS
            else if ($s == '>') 
            {
                $xquery .= '/';
                $delimiter_before = 2;
            } 
            // ALL DESCENDANDS
            else if ($s == ' ') 
            {
                $xquery .= '//';
                $delimiter_before = 2;
            } 
            // ERRORS
            else 
            {
                exit("Unrecognized token '$s'");
            }
            $delimiter_before = $delimiter_before === 2;
        }
        return $xquery;
    }

  /**
   * @access private
   */
    public static function parse_selector($query) 
    {
        $query = trim( preg_replace( '@\s+@', ' ', preg_replace('@\s*(>|\\+|~)\s*@', '\\1', $query) ) );
        $queries = array();
        if ( !$query )
        {
            return $queries;
        }

        $special_chars = array('>',' ');
        $special_chars_mapping = array();
        $strlen = mb_strlen($query);
        $class_chars = array('.', '-');
        $pseudo_chars = array('-');
        $tag_chars = array('*', '|', '-');
        // split multibyte string
        // http://code.google.com/p/phpquery/issues/detail?id=76
        $_query = array();
        for ( $i=0; $i<$strlen; $i++ )
        {
            $_query[] = mb_substr($query, $i, 1);
        }
        $query = $_query;
        // it works, but i dont like it...
        $i = 0;
        while( $i < $strlen ) 
        {
            $c = $query[$i];
            $tmp = '';
            // TAG
            if ( self::is_char($c) || in_array($c, $tag_chars) ) 
            {
                while(isset($query[$i]) && (self::is_char($query[$i]) || in_array($query[$i], $tag_chars))) 
                {
                    $tmp .= $query[$i];
                    $i++;
                }
                $queries[] = $tmp;
            } 
            // IDs
            else if ( $c == '#' ) 
            {
                $i++;
                while( isset($query[$i]) && (self::is_char($query[$i]) || $query[$i] == '-') ) 
                {
                    $tmp .= $query[$i];
                    $i++;
                }
                $queries[] = '#'.$tmp;
            } 
            // SPECIAL CHARS
            else if ( in_array($c, $special_chars) ) 
            {
                $queries[] = $c;
                $i++;
                // MAPPED SPECIAL MULTICHARS
                //      } else if ( $c.$query[$i+1] == '//') {
                //        $return[] = ' ';
                //        $i = $i+2;
            } 
            // MAPPED SPECIAL CHARS
            else if ( isset($special_chars_mapping[$c])) 
            {
                $queries[] = $special_chars_mapping[$c];
                $i++;
            } 
            // COMMA
            else if ( $c == ',' ) 
            {
                $i++;
                while( isset($query[$i]) && $query[$i] == ' ')
                {
                    $i++;
                }
            } 
            // CLASSES
            else if ($c == '.') 
            {
                while( isset($query[$i]) && (self::is_char($query[$i]) || in_array($query[$i], $class_chars))) 
                {
                    $tmp .= $query[$i];
                    $i++;
                }
                $queries[] = $tmp;
            } 
            // ~ General Sibling Selector
            else if ($c == '~')
            {
                $space_allowed = true;
                $tmp .= $query[$i++];
                while( isset($query[$i])
                    && (self::is_char($query[$i])
                    || in_array($query[$i], $class_chars)
                    || $query[$i] == '*'
                    || ($query[$i] == ' ' && $space_allowed)
                )) 
                {
                    if ($query[$i] != ' ')
                    {
                        $space_allowed = false;
                    }
                    $tmp .= $query[$i];
                    $i++;
                }
                $queries[] = $tmp;
            }
            // + Adjacent sibling selectors
            else if ($c == '+') 
            {
                $space_allowed = true;
                $tmp .= $query[$i++];
                while( isset($query[$i])
                    && (self::is_char($query[$i])
                    || in_array($query[$i], $class_chars)
                    || $query[$i] == '*'
                    || ($space_allowed && $query[$i] == ' ')
                )) 
                {
                    if ($query[$i] != ' ')
                        $space_allowed = false;
                    $tmp .= $query[$i];
                    $i++;
                }
                $queries[] = $tmp;
            } 
            // ATTRS
            else if ($c == '[') 
            {
                $stack = 1;
                $tmp .= $c;
                while( isset($query[++$i])) 
                {
                    $tmp .= $query[$i];
                    if ( $query[$i] == '[') 
                    {
                        $stack++;
                    } 
                    else if ( $query[$i] == ']')
                    {
                        $stack--;
                        if (! $stack )
                        {
                            break;
                        }
                    }
                }
                $queries[] = $tmp;
                $i++;
            } 
            // PSEUDO CLASSES
            else if ($c == ':') 
            {
                $stack = 1;
                $tmp .= $query[$i++];
                while( isset($query[$i]) && (self::is_char($query[$i]) || in_array($query[$i], $pseudo_chars))) 
                {
                    $tmp .= $query[$i];
                    $i++;
                }
                // with arguments ?
                if ( isset($query[$i]) && $query[$i] == '(') 
                {
                    $tmp .= $query[$i];
                    $stack = 1;
                    while( isset($query[++$i])) 
                    {
                        $tmp .= $query[$i];
                        if ( $query[$i] == '(') 
                        {
                            $stack++;
                        } 
                        else if ( $query[$i] == ')')
                        {
                            $stack--;
                            if (! $stack )
                            {
                                break;
                            }
                        }
                    }
                    $queries[] = $tmp;
                    $i++;
                } 
                else 
                {
                    $queries[] = $tmp;
                }
            }
            else
            {
                $i++;
            }
        }

        if (isset($queries[0])) 
        {
            if (isset($queries[0][0]) && $queries[0][0] == ':')
            {
                array_unshift($queries, '*');
            }
            if ($queries[0] != '>')
            {
                array_unshift($queries, ' ');
            }
        }

        return $queries;
    }

    public static function is_char($char)
    {
        return preg_match('@\w@', $char);
    }

    /**
     * 模糊匹配
     * ^ 前缀字符串
     * * 包含字符串
     * $ 后缀字符串
   * @access private
   */
    protected static function is_regexp($pattern) 
    {
    return in_array(
      $pattern[ mb_strlen($pattern)-1 ],
      array('^','*','$')
    );
  }
}
// if(isset($_GET['url'])){
//  $dburl=$_GET['url'];
//  $json=getbt($dburl);
//  echo $json;
// }else{
//  return;
// }

$dburl='https://movie.douban.com/subject/26769449/';
// $dburl='https://movie.douban.com/subject/27055685/';
$json=getdouban($dburl);

function getdouban($dburl){
    $con_rex='//div[contains(@class,"subjectwrap")]';
    $title_rex ='//span[contains(@property,"v:itemreviewed")]/text()';
    // $year_rex='//div[@class="year"]/text()';
    $year_rex="span.year";
    $director_rex='//div[@id="info"]/span[1]/span[@class="attrs"]/a';//*[@id="info"]/span[1]/span[2]
    $scenarist_rex='//div[@id="info"]/span[2]/span[@class="attrs"]/a';
    $performer_rex='//span[@class="actor"]//span[@class="attrs"]/a';
    $tags_rex = '//span[@property="v:genre"]';
    $time_shang_rex='//span[@property="v:initialReleaseDate"]';

    $connet_rex='//span[@property="v:summary"]';
    $rating_num_rex='//strong[@property="v:average"]';

    $img_rex = '//img[@rel="v:image"]/@src';

    $jieguo=curl_get($dburl,'https://movie.douban.com/');

    $select=new selector();
    $con=$select->select($jieguo,$con_rex);

    $title=$select->select($jieguo,$title_rex);
    $year=$select->select($jieguo,$year_rex,'css');
    $director=$select->select($jieguo,$director_rex);
    $scenarist=$select->select($jieguo,$scenarist_rex);
    $performer=$select->select($jieguo,$performer_rex);
    $tags=$select->select($jieguo,$tags_rex);

    preg_match('#制片国家/地区:[^>]+>([^<]+)<br\/>#i',$con,$mach);
    if(isset($mach[1])){
      $cat=explode('/',$mach[1]);
      foreach ($cat as $key => $value) {
        $cat[$key]=trim($value);
      }
    }
    $time_shang=$select->select($jieguo,$time_shang_rex);

    preg_match('#又名:[^>]+>([^<]+)<br\/>#i',$con,$mach_en);
    if(isset($mach_en[1])){
      $english_name=explode('/',$mach_en[1]);
      foreach ($english_name as $key => $value) {
        $english_name[$key]=preg_replace('/\([^\)]+\)/','',trim($value));
      }
    }

    preg_match('#IMDb链接:[^h]+href[^>]+>([^<]+)#i',$con,$mach_imdb);
    if(isset($mach_imdb[1])){
      $imdb=$mach_imdb[1];
    }
    $connet=$select->select($jieguo,$connet_rex);
    $connet=trim($connet);

    $rating_num=$select->select($jieguo,$rating_num_rex);
    $img=$select->select($jieguo,$img_rex);
    //https://img3.doubanio.com/view/photo/s_ratio_poster/public/p2507566212.webp
    //https://img3.doubanio.com/view/photo/m/public/p2507566212.webp
    $img=str_replace('s_ratio_poster','m',$img);
    $img=str_replace('webp','jpg',$img);
    var_dump($img);die;
    
    // $info=$select->select($con,$info_rex);
    // $info_txt = strip_tags($info,'<br>'); 
    // $info_txt =trim($info_txt);
    
    

    var_dump($data);
    //JSON_UNESCAPED_SLASHES
    // $jsondata=json_encode($data);
      // echo $jsondata;
}
  echo getdouban(link);?>
})