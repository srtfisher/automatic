<?php
/**
 * Example of Logging in with the Automatic API
 */
require_once('../vendor/autoload.php');
require_once('./config.php');

if (empty($clientId) || empty($clientSecret)) {
  die('Example Client ID/Secret not set, see config.php');
}

// Should be something like http://localhost/examples/display.php
$redirectUri = 'http://'.$_SERVER['HTTP_HOST'].str_replace('login.php', 'display.php', $_SERVER['REQUEST_URI']);

$client = new Srtfisher\Automatic\Client($clientId, $clientSecret, null, $redirectUri);
header('Location: '.$client->getAuthentication()->getAuthorizationUrl());
