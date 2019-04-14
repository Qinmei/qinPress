<?php
if( wp_is_mobile() ) {
	require("page-mobile/animate.php");
} else {
	require("page-pc/animate.php");
}
?>