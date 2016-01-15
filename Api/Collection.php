<?php

class Collection
{
    private $ID;
    private $name;
    private $list = array();

    public function __construct($folderID = NULL)
    {
        if($folderID == NULL)
        {
            $this->ID = Helper::GenerateID();
            $this->save();
        }
        else
        {
            $this->ID = $folderID;
            $this->load();
        }


    }

    public function GetID()
    {
        return $this->ID;
    }

    public function AddCollectionToList()
    {
        $this->list[] = new Collection();
    }

    public function AddArtifactToList(Artifact $artifact)
    {
        $this->list = $artifact;
    }

    public function Delete()
    {

    }

    public function GetList()
    {
        return $this->list;
    }

    private function save()
    {
        $myfile = fopen("Collections/". $this->GetID(),"w+");
        fwrite($myfile, serialize($this));
        fclose($myfile);
    }

    private function load()
    {
        $myfile = fopen("Collections/" . $this->GetID(), "r+");



        fclose($myfile);
    }

}
