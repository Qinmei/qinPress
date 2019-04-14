<?php
if( wp_is_mobile() ) {
	require("page-mobile/page/discuss.php");
} else {
	require("page-pc/page/discuss.php");
}
?>