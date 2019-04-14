<?php
if( wp_is_mobile() ) {
	require("page-mobile/search.php");
} else {
	require("page-pc/search.php");
}
?>