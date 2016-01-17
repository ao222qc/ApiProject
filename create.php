<?php
error_reporting(E_ALL);
require_once("init.php");

$NAME = "name";
$PID = "pid";
$parentElement = "";

if (isset($_GET[$PID]))
{

    $parentElement = "Adding to collection: <a href='find.php?id={$_GET[$PID]}'><b>{$_GET[$PID]}</b></a><input type=hidden name='{$PID}' value='{$_GET[$PID]}'>";
}

if (isset($_GET[$NAME]))
{
    $collection = new Collection($_GET[$NAME]);

    if (isset($_GET[$PID]))
    {
        $parent = Api::GetCollection($_GET[$PID]);
        if ($parent != null)
        {
            $parent->AddCollection($collection);
        }
    }

    header("Location: find.php?id=".$collection->GetID());
}

$body = '
    <br>
    <form action="" method="GET">
        Collection name: <input name="'.$NAME.'">
        <br>
        '.$parentElement.'
        <br>
        <button>Create and open</button>
    </form>
';

echo $body;

Template::Render();
