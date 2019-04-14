<?php
if( wp_is_mobile() ) {
	require("page-mobile/category.php");
} else {
	require("page-pc/animatecat.php");
}
?>