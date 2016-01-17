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
    $collection = Api::GetCollection($_GET[$ID]);

    if(isset($_GET['delete']) && isset($_GET["type"]))
    {
        if ($_GET["type"] == "artifact")
        {
            $artifact = $collection->GetArtifact($_GET['delete']);

            if($artifact != NULL)
            {
                $collection->DeleteArtifact($artifact->GetID());
            }
        }
        elseif ($_GET["type"] == "collection")
        {
            $ctd = Api::GetCollection($_GET['delete']);
            if($ctd != NULL)
            {
                $collection->DeleteCollection($ctd->GetID());
                header("Location: ?id=".$collection->GetID());
                die();
            }
        }
    }

    echo "
    <i>{$collection->GetID()}</i>
    <h2>{$collection->GetName()}</h2>
    <ul>
    ";

    foreach($collection->GetList() as $item)
    {
        echo '<li>';
        if ($item instanceof Artifact)
        {
            $path = Api::APIPATH.Api::ARTIFACTPATH.$item->GetID();
            echo "<a href='{$path}' download='{$item->GetFilename()}'><b>{$item->GetFilename()}</b></a> <i>({$item->GetID()})</i>";
            echo " <a href='share.php?id={$item->GetID()}&fcid={$collection->GetID()}'>Share</a>";
            echo " <a href='update.php?cid={$collection->GetID()}&id={$item->GetID()}'>Update</a>";
            echo " <a href='find.php?id={$collection->GetID()}&delete={$item->GetID()}&type=artifact'>Delete</a>";
        }
        elseif($item instanceof Collection)
        {
            echo "<a href='find.php?id={$item->GetID()}'>{$item->GetName()}</a>";
            echo " <a href='find.php?id={$collection->GetID()}&delete={$item->GetID()}&type=collection'>Delete</a>";
        }

        echo "</li>";

    }
    echo "<li><a href='upload.php?CollectionID={$collection->GetID()}'>Upload artifact</a></li>";
    echo "<li><a href='create.php?pid={$collection->GetID()}'>Create subcollection</a></li>";
    echo "</ul>";
}

Template::Render();
