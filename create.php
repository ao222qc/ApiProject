<?php
error_reporting(E_ALL);
require_once("init.php");

$NAME = "name";
$PID = "pid";

$body = '
    <br>
    <form action="" method="GET">
        Collection name: <input name="'.$NAME.'">
        Add to collection: <input name="'.$PID.'">
        <button>Create and open</button>
    </form>
';

echo $body;

if (isset($_GET[$NAME]))
{
    $collection = new Collection($_GET[$NAME]);
    api->AddCollection($collection);

    if (isset($_GET[$PID]))
    {
        $parent = api->GetCollection($_GET[$PID]);
        if ($parent != null)
        {
            $parent->AddCollection($collection);
        }
    }
}

Template::Render();
