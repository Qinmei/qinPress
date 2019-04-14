<?php
if( wp_is_mobile() ) {
	require("page-mobile/page/register.php");
} else {
	require("page-pc/page/register.php");
}
?>