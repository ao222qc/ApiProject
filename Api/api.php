<?php
chdir("Api");
require_once("Collection.php");
require_once("Helper.php");
require_once("Artifact.php");

class Api
{
    const COLLECTIONPATH = "Collections/";
    const ARTIFACTPATH = "Artifacts/";
    const APIPATH = "Api/";

    public function __construct()
    {
        if (!is_dir(self::COLLECTIONPATH))
        {
            mkdir(self::COLLECTIONPATH);
        }
        if (!is_dir(self::ARTIFACTPATH))
        {
            mkdir(self::ARTIFACTPATH);
        }
    }

    public function GetCollection($ID)
    {
        $files = scandir(self::COLLECTIONPATH);

        if(!in_array($ID, $files))
        {
            return null;
        }

        $raw = file_get_contents(self::COLLECTIONPATH.$ID);
        return unserialize($raw);
    }

    public function DeleteCollection($ID)
    {
        unlink(self::PATH.$ID);
    }
}
