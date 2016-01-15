<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');

require_once("Api/Collection.php");
require_once("Api/Helper.php");
require_once("Api/Artifact.php");
require_once("Api/api.php");

$api = new Api();

$api->CreateCollection();
