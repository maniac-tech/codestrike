<?php 
require_once('imacConnect.php');

$regStatus="";

if ($_SERVER["REQUEST_METHOD"]=="POST"){
	$captcha = $_POST['g-recaptcha-response'];
	$captchaSecretKey=	getenv('GOOGLE_RECAPTCHA_SECRET');
	$clientIp = $_SERVER['REMOTE_ADDR'];
	$captchResponse = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$captchaSecretKey."&response=".$captcha."&remoteip=".$clientIp);
	$captchaResponseKeys = json_decode($response,true);
	if(intval($responseKeys["success"]) !== 1) {
		echo '<h2>SPAM</h2>';
	} else {
		echo '<h2>Genuine</h2>';
	}
}