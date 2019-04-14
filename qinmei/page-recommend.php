<?php
if( wp_is_mobile() ) {
	require("page-mobile/page/recommend.php");
} else {
	require("page-pc/page/recommend.php");
}
?>