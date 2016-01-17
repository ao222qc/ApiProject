<?php
error_reporting(E_ALL);
require_once("init.php");

$itemID = null;
$collectionID = null;

if(isset($_GET["id"]) && isset($_GET["fcid"]))
{
    $itemID = $_GET["id"];
    $collectionID = $_GET["fcid"];

    if(isset($_GET["cid"]))
    {
        $originalCollection = $api->GetCollection($collectionID);
        $targetCollection = $api->GetCollection($_GET["cid"]);

        if($originalCollection != NULL && $targetCollection != NULL)
        {
            $item = $originalCollection->GetArtifact($itemID);

            $targetCollection->AddArtifact($item);
        }
    }
}

echo '
     <br>
    <form action="" method="GET">
         Artifact or subcollection ID.<br>
        <input value="'. $itemID.'" name="id"> from collection <input value="'. $collectionID.'" name="fcid">
        <br>
        Collection ID <br>
        <input name="cid">
        <button>Share</button>
    </form>
';




Template::Render();
