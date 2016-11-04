<?php
	// include template('hugs:message');
	loadcache('plugin');
	
	var_dump($_G['cache']['plugin']['hugs']);	
	$groupid = unserialize($_G['cache']['plugin']['hugs']['groupid']);

	var_dump($groupid);

?>