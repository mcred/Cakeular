<?php
/**
 * ... connect Cakeular RESTful URLs to JSON API.
 */
	$host = explode('.', $_SERVER["HTTP_HOST"]);
	$subdomain = $host[0];
	if($subdomain == 'api'){
		Router::connect('/:controller/*', array('action' => 'api'));
	}
	Router::connect('/:controller/*', array('action' => 'index'));