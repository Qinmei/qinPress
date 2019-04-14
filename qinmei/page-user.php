<?php
if( wp_is_mobile() ) {
	require("page-mobile/page/user.php");
} else {
	require("page-pc/page/user.php");
}
?>