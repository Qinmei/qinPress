<?php
if( wp_is_mobile() ) {
	require("page-mobile/page/info.php");
} else {
	require("page-pc/page/info.php");
}
?>