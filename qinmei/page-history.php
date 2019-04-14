<?php
if( wp_is_mobile() ) {
	require("page-mobile/page/history.php");
} else {
	require("page-pc/page/history.php");
}
?>