<?php
	session_start();
	if(isset($_SESSION['logincust']))
	{
		header('Location: Home.php');
	}
	else
	{
		session_unset();
	}
?>
<!DOCTYPE html>
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
	<head>
		<title>Login with Facebook and Google | Login</title>
		<link rel="stylesheet" href="style.css">
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
	</head>
	<body>
  <div class="bg-img">
  <div class="content">
    <header>Login Form</header>
    <form action="#">
      <div class="field">
        <span class="fa fa-user"></span>
        <input type="text" required placeholder="Email or Phone">
      </div>
      <div class="field space">
        <span class="fa fa-lock"></span>
        <input type="password" class="pass-key" required
placeholder="Password">
        <span class="show">SHOW</span>
      </div>
      <div class="pass">
        <a href="#">Forgot Password?</a>
      </div>
      <div class="field">
        <input type="submit" value="LOGIN">
      </div>
    </form>
    <div class="login">Or login with</div>
    <div class="links">
    <?php

		echo '<a href="loginFB.php"><img src="images/loginfb.png" alt="Login with Facebook" width=150 height=40></a><br>';
		include_once 'loginG.php';
		if(isset($_GET['code'])){
			$gClient->authenticate($_GET['code']);
			$_SESSION['token'] = $gClient->getAccessToken();
			header('Location: ' . filter_var($redirectURL, FILTER_SANITIZE_URL));
		}
		if (isset($_SESSION['token'])) {
			$gClient->setAccessToken($_SESSION['token']);
		}
		if ($gClient->getAccessToken())
		{
			$gpUserProfile = $google_oauthV2->userinfo->get();
			$_SESSION['oauth_provider'] = 'Google';
			$_SESSION['oauth_uid'] = $gpUserProfile['id'];
			$_SESSION['first_name'] = $gpUserProfile['given_name'];
			$_SESSION['last_name'] = $gpUserProfile['family_name'];
			$_SESSION['email'] = $gpUserProfile['email'];
			$_SESSION['logincust']='yes';
		} else {
			$authUrl = $gClient->createAuthUrl();
			$output= '<a href="'.filter_var($authUrl, FILTER_SANITIZE_URL).'"><img src="images/loging.png" alt="Sign in with Google+" width=150 height=40/></a>';
		}
		echo $output;
	?>
      <!-- <div class="facebook"> -->
        <!-- <i class="fab fa-facebook-f"><span>Facebook</span></i> -->
      <!-- </div> -->
      <!-- <div class="instagram"> -->
        <!-- <i class="fab fa-instagram"><span>Instagram</span></i> -->
      <!-- </div> -->
    </div>
    <div class="signup">Don't have account?
      <a href="#">Signup Now</a>
    </div>
  </div>
</div>
<script>
  const pass_field = document.querySelector('.pass-key');
  const showBtn = document.querySelector('.show');
  showBtn.addEventListener('click', function(){
   if(pass_field.type === "password"){
     pass_field.type = "text";
     showBtn.textContent = "HIDE";
     showBtn.style.color = "#3498db";
   }else{
     pass_field.type = "password";
     showBtn.textContent = "SHOW";
     showBtn.style.color = "#222";
   }
  });
</script>
	</body>
</html>