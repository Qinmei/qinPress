<?php
if( wp_is_mobile() ) {
	require("page-mobile/page/all.php");
} else {
	require("page-pc/page/all.php");
}
?>