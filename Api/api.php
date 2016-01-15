<?php

class Api
{
    const $PATH = "Collections/";

    public function CreateCollection()
    {
        $collection = new Collection();

        $myfile = fopen("Collections/". $collection->GetID(),"w");

        fwrite($myfile, serialize($collection));
    }

    public function GetCollection()
    {

    }
    public function deleteCollection($ID)
    {

    }

}
