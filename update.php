<?php
error_reporting(E_ALL);
require_once("init.php");



$itemID = null;
$collectionID = null;
$extension = null;

if(isset($_GET["id"]) && isset($_GET["cid"]))
{
    $itemID = $_GET["id"];
    $collectionID = $_GET["cid"];

    $originalCollection = Api::GetCollection($collectionID);

    if($originalCollection != NULL)
    {
        $item = $originalCollection->GetArtifact($itemID);

        if($item != null)
        {
            $extension = $item->GetExtension();

            if(isset($_FILES["file"]))
            {
                $item->Update($_FILES["file"]);
            }
        }
    }
}



echo '
     <br>
     <form enctype="multipart/form-data" action="?cid='.$collectionID.'&id='.$itemID.'" method="POST">
        Artifact <b>'.$itemID.'</b> from collection <b><a href="find.php?id='.$collectionID.'">'.$collectionID.'</a></b>
        <br>
        <br>
        <input type="file" name="file" accept=".'.$extension.'">
        <button>Update</button>
    </form>
';






Template::Render();
