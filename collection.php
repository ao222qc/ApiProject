<?php
error_reporting(E_ALL);
require_once("init.php");

$ID = "id";


$body = '
    <br>
    <form action="" method="GET">
        <input name="'.$ID.'">
        <button>Find</button>
    </form>
';

echo $body;

if (isset($_GET[$ID]))
{
    var_dump($api->GetCollection($_GET[$ID]));
}

Template::Render();
