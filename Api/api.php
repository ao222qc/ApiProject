<?php

class Api
{

    public function CreateCollection()
    {
        $collection = new Collection();

        $myfile = fopen("Collections/". $collection->GetID(),"w");

        fwrite($myfile, serialize($collection));
    }

    public function GetCollection()
    {

    }

}
