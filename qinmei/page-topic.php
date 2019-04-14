<?php
if( wp_is_mobile() ) {
	require("page-mobile/page/topic.php");
} else {
	require("page-pc/page/topic.php");
}
?>