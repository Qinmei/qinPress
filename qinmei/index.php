<?php
if( wp_is_mobile() ) {
	require("page-mobile/index.php");
} else {
	require("page-pc/index.php");
}
?>