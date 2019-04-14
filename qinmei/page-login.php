<?php
if( wp_is_mobile() ) {
	require("page-mobile/page/login.php");
} else {
	require("page-pc/page/login.php");
}
?>