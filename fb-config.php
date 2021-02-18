<?php

require_once 'fb-api/src/Facebook/autoload.php';

// Call Facebook API

$facebook = new \Facebook\Facebook([
  'app_id'      => '2773002732929934',
  'app_secret'     => '454648468bb37b2142eff2b887c211ea',
  'default_graph_version'  => 'v3.0'
]);

$facebook_output = '';

$facebook_helper = $facebook->getRedirectLoginHelper();
if (isset($_GET['state'])) {
    $facebook_helper->getPersistentDataHandler()->set('state', $_GET['state']);
}
$code = isset($_GET['code']) ? $_GET['code'] : NULL;

session_start();