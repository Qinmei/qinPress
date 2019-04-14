<?php

if( wp_is_mobile() ) {
	require("page-mobile/header.php");
} else {
	require("page-pc/header.php");
}
?>