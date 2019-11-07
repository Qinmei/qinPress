<?php
/**
*Author: Ashuwp
*Author url: http://www.ashuwp.com
*Version: 6.0
**/

class ashuwp_option_import_class {
  var $options;
  function __construct($options) {
    $this->options = $options;
    
    add_action( 'admin_menu', array(&$this, 'add_admin_menu') );
    
    add_action( 'admin_init', array( $this, 'export' ) );
		add_action( 'admin_init', array( $this, 'import' ) );
    
  }
  
  function add_admin_menu(){
    if( $this->options['child'] ){
      $parent_slug = $this->options['parent_slug'];
      add_submenu_page($parent_slug, $this->options['full_name'], $this->options['full_name'], 'edit_themes', $this->options['filename'], array(&$this, 'display'));
    }else{
      add_menu_page($this->options['full_name'], $this->options['full_name'], 'edit_themes', $this->options['filename'], array(&$this, 'display'));
    }
  }
  
  function display(){
  ?>
    <div class="wrap">
      <h2>Ashuwp-导入/导出</h2>
      <?php
      if ( isset( $_REQUEST['imported'] ) && 'true' === $_REQUEST['imported'] )
        echo '<div id="message" class="updated"><p><strong>设置数据导入成功。</strong></p></div>';
      elseif ( isset( $_REQUEST['error'] ) && 'true' === $_REQUEST['error'] )
        echo '<div id="message" class="error"><p><strong>导入失败，请重试。</strong></p></div>';
      ?>
      <table class="form-table">
      <tbody>
        <tr>
          <th scope="row"><b>导入设置选项数据</p></th>
          <td>
            <p>请上传一个.json格式的数据文件(数据文件应该是从ashuwp_framework框架中导出的)，请勿上传其它文件</p>
            <p>
              <form enctype="multipart/form-data" method="post" action="<?php echo menu_page_url( 'ashuwp_import', 0 ); ?>">
                <?php wp_nonce_field( 'ashuwp_import','ashuwp_import' ); ?>
                <input type="file" id="ashuwp_import_upload" name="ashuwp_import_upload" size="25" />
                <?php submit_button( 'Upload File and Import', 'primary', 'upload' ); ?>
              </form>
            </p>
          </td>
        </tr>
        <tr>
          <th scope="row"><b>导出设置选项数据</b></th>
          <td>
            <p>点击下载设置数据文件，下载的数据包含整个ashuwp_framework框架建立的设置页面的所有数据，不包括文章自定义字段和分类自定义字段数据。</p>
            <p>
              <form method="post" action="<?php echo menu_page_url( 'ashuwp_import', 0 ); ?>">
              <?php
              wp_nonce_field( 'ashuwp_export','ashuwp_export' );
              submit_button( 'Download Export File', 'primary', 'download' );
              ?>
              </form>
            </p>
          </td>
        </tr>
      </tbody>
      </table>
    </div>
  <?php
  }
  
  function import() {

		if ( empty( $_REQUEST['ashuwp_import'] ) )
			return;

		check_admin_referer( 'ashuwp_import','ashuwp_import' );

		$upload = file_get_contents( $_FILES['ashuwp_import_upload']['tmp_name'] );

		$options = json_decode( $upload, true );

		if ( ! $options || $_FILES['ashuwp_import_upload']['error'] ) {
      $url = admin_url('admin.php?page='.$this->options['filename'].'&error=true');
      wp_redirect($url);
			exit;
		}

		foreach ( $options as $key => $settings ) {
      update_option( 'ashuwp_'.$key, $settings );
		}

		$url = admin_url('admin.php?page='.$this->options['filename'].'&imported=true');
    wp_redirect($url); 
		exit;

	}
  
  function export() {
    $data = array();
    $option_name = '';

		if ( empty( $_REQUEST['ashuwp_export'] ) )
			return;
    
		check_admin_referer( 'ashuwp_export','ashuwp_export' );
    
    foreach($this->options['options'] as $str){
      $option_name = 'ashuwp_'.$str;
      $data[$str] = get_option($option_name);
    }
	  
    $output = json_encode( (array) $data );
    
    header( 'Content-Description: File Transfer' );
    header( 'Cache-Control: public, must-revalidate' );
    header( 'Pragma: hack' );
    header( 'Content-Type: text/plain' );
    header( 'Content-Disposition: attachment; filename="ashuwp-options-' . date( 'YmdHis' ) . '.json"' );
    header( 'Content-Length: ' . mb_strlen( $output ) );
    echo $output;
    exit;
	}

}