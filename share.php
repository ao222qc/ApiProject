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
        $originalCollection = Api::GetCollection($collectionID);
        $targetCollection = Api::GetCollection($_GET["cid"]);

        if($originalCollection != NULL && $targetCollection != NULL)
        {
            $item = $originalCollection->GetArtifact($itemID);

            $targetCollection->AddArtifact($item);
        }
    }
}

echo '
     <br>
     <form action="?" method="GET">
        <input type=hidden value="'.$collectionID.'" name="fcid">
        <input type=hidden value="'.$itemID.'" name="id">
        Artifact <b>'.$itemID.'</b> from collection <b><a href="find.php?id='.$collectionID.'">'.$collectionID.'</a></b>
        <br>
        Collection ID <br>
        <input name="cid">
        <button>Share</button>
    </form>
';




Template::Render();
