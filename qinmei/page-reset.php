<?php
if( wp_is_mobile() ) {
	require("page-mobile/page/reset.php");
} else {
	require("page-pc/page/reset.php");
}
?>