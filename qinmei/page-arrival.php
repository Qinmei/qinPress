<?php
if( wp_is_mobile() ) {
	require("page-mobile/page/arrival.php");
}else{
	require("page-pc/page/new.php");
}
?>