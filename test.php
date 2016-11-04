<?php
	define('CURSCRIPT','forum');
	define('CURMODULE','viewthread');

	include 'source/class/class_core.php';

	C::app()->init();
	runhooks();
	$str = avatar('1','big');

	var_dump($str);

