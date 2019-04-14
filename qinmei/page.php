<?php
if( wp_is_mobile() ) {
	require("page-mobile/page.php");
} else {
	require("page-pc/page.php");
}
?>