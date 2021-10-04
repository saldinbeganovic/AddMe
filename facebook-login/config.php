<?php

require_once 'vendor/autoload.php';

if (!session_id())
{
    session_start();
}

// Call Facebook API

$facebook = new \Facebook\Facebook([
  'app_id'      => '238460851567620',
  'app_secret'     => 'a1aee403c07a6f14fecd567847efa731',
  'default_graph_version'  => 'v2.10'
]);

?>
