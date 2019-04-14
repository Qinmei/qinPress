<?php
if( wp_is_mobile() ) {
	require("page-mobile/animatekind.php");
} else {
	require("page-pc/animatekind.php");
}
?>