<?php

require_once 'fb-api/src/Facebook/autoload.php';
require 'fb_secret.php'; // facebook secrets here

// Call Facebook API
$facebook_output = '';

$facebook_helper = $facebook->getRedirectLoginHelper();
if (isset($_GET['state'])) {
    $facebook_helper->getPersistentDataHandler()->set('state', $_GET['state']);
}
$code = isset($_GET['code']) ? $_GET['code'] : NULL;

session_start();