<?php
if( wp_is_mobile() ) {
	require("page-mobile/footer.php");
} else {
	require("page-pc/footer.php");
}
?>