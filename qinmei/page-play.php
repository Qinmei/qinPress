<?php
if( wp_is_mobile() ) {
	require("page-mobile/play.php");
} else {
	require("page-pc/play.php");
}
?>