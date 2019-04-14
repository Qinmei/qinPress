<?php
if( wp_is_mobile() ) {
	require("page-mobile/page/new.php");
} else {
	require("page-pc/page/new.php");
}
?>