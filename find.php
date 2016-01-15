<?php
error_reporting(E_ALL);
require_once("init.php");

$ID = "id";


echo '
    <br>
    <form action="" method="GET">
        <input name="'.$ID.'">
        <button>Find</button>
    </form>
';

if (isset($_GET[$ID]))
{
    $collection = $api->GetCollection($_GET[$ID]);
    echo "
    <i>{$collection->GetID()}</i>
    <h2>{$collection->GetName()}</h2>
    <ul>
    ";

    foreach($collection->GetList() as $item)
    {
        if ($item instanceof Artifact)
        {
            $path = Api::APIPATH.Api::ARTIFACTPATH.$item->GetID();
            echo "<li><a href='{$path}' download='{$item->GetFilename()}'><b>{$item->GetFilename()}</b></a> <i>({$item->GetID()})</i></li>";
        }
    }
    echo "<li><a href='upload.php?CollectionID={$collection->GetID()}'>Upload artifact</a></li>";
    echo "</ul>";
}

Template::Render();
