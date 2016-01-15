<?php
error_reporting(E_ALL);
require_once("init.php");

$FILE = "file";
$CID = "CollectionID";

$body = '
    <br>
    <form enctype="multipart/form-data" action="" method="POST">
        <input type="file" name="'.$FILE.'">
        <br>
        Collection ID:
        <input name="' .$CID. '">
        <button>Upload</button>
    </form>
';
if (isset($_FILES[$FILE]) && isset($_POST[$CID]))
{

    $collectionID = $_POST[$CID];

    $collection = $api->GetCollection($collectionID);

    if ($collection != null)
    {
        $collection->AddArtifact($_FILES[$FILE]);
    }
    echo "Collection does not exist";

}

echo $body;

Template::Render();
