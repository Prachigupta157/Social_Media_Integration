<?php
	include_once 'src/Google_Client.php';
	include_once 'src/contrib/Google_Oauth2Service.php';
	
	// Edit Following 3 Lines
	$clientId = '427138243029-gbdhe6k7dp5ggtmlj4mhafjrquqrjfc4.apps.googleusercontent.com'; //Application client ID
	$clientSecret = 'b7V72wGOtMuHroTKKONItqn0'; //Application client secret
	$redirectURL = 'http://localhost/Social_login/'; //Application Callback URL
	
	$gClient = new Google_Client();
	$gClient->setApplicationName('Your Application Name');
	$gClient->setClientId($clientId);
	$gClient->setClientSecret($clientSecret);
	$gClient->setRedirectUri($redirectURL);
	$google_oauthV2 = new Google_Oauth2Service($gClient);
?>