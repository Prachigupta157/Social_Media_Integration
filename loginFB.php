<?php
	session_start();
	require_once 'autoload.php';
	use Facebook\FacebookSession;
	use Facebook\FacebookRedirectLoginHelper;
	use Facebook\FacebookRequest;
	use Facebook\FacebookResponse;
	use Facebook\FacebookSDKException;
	use Facebook\FacebookRequestException;
	use Facebook\FacebookAuthorizationException;
	use Facebook\GraphObject;
	use Facebook\Entities\AccessToken;
	use Facebook\HttpClients\FacebookCurlHttpClient;
	use Facebook\HttpClients\FacebookHttpable;
	
	// Edit Following 2 Lines
	FacebookSession::setDefaultApplication( '244367880559079','69e0cacd782d8906b8fb16a1b0576e88' );
	$helper = new FacebookRedirectLoginHelper('http://localhost/Social_login/loginFB.php');
	
	try {$session = $helper->getSessionFromRedirect();} catch( FacebookRequestException $ex ) {} catch( Exception $ex ) {}
	if ( isset( $session ) ) 
	{
		$request = new FacebookRequest( $session, 'GET', '/me?fields=id,first_name,last_name,name,email' );
		$response = $request->execute();
		$graphObject = $response->getGraphObject();
		$fbid = $graphObject->getProperty('id');
		$fbfirstname = $graphObject->getProperty('first_name');
		$fblastname = $graphObject->getProperty('last_name');
		$fbfullname = $graphObject->getProperty('name');
		$femail = $graphObject->getProperty('email');
		if($femail==null || $femail=='' || $femail==' ')
		{
			$femail=$fbfirstname.$fblastname.$fbid.'@gmail.com';
		}
		$_SESSION['oauth_provider'] = 'Facebook'; 
		$_SESSION['oauth_uid'] = $fbid; 
		$_SESSION['first_name'] = $fbfirstname; 
		$_SESSION['last_name'] = $fblastname; 
		$_SESSION['email'] = $femail;
		$_SESSION['logincust']='yes';
		header("Location: index.php");
	} 
	else 
	{
		$loginUrl = $helper->getLoginUrl();
		header("Location: ".$loginUrl);
	}
?>