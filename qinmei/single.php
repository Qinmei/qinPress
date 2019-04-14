<?php
if( wp_is_mobile() ) {
	require("page-mobile/post/info.php");
} else {
	require("page-pc/post/info.php");
}
?>