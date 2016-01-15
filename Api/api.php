<?php

class Api
{
    const PATH = "Collections/";

    public function CreateCollection()
    {
        $collection = new Collection();
    }

    public function GetCollection($ID)
    {
        $raw = file_get_contents(self::PATH.$ID);
        return unserialize($raw);
    }

    public function DeleteCollection($ID)
    {
        unlink(self::PATH.$ID);
    }
}
