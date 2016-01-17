<?php
error_reporting(E_ALL);
require_once("init.php");

$FILE = "file";
$CID = "CollectionID";

$preCollectionID = null;

if (isset($_GET[$CID]))
{
    $preCollectionID = $_GET[$CID];
}

$body = '
    <br>
   <form enctype="multipart/form-data" action="?CollectionID='.$preCollectionID.'" method="POST">
        Upload artifact to collection <b><a href="find.php?id='.$preCollectionID.'">'.$preCollectionID.'</a></b>
        <br>
        <input type="file" name="'.$FILE.'">
        <br>
        <button>Upload</button>
    </form>
';
if (isset($_FILES[$FILE]) && isset($_GET[$CID]))
{

    $collectionID = $_GET[$CID];

    $collection = Api::GetCollection($collectionID);

    if ($collection != null)
    {
        $collection->AddArtifact( new Artifact($_FILES[$FILE]) );
        echo "Upload successfull!";
    }
    else
    {
        echo "Collection does not exist";
    }

}

echo $body;

Template::Render();
