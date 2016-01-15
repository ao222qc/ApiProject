<?php

class Collection
{
    private $ID;
    private $name;
    private $list = array();

    public function __construct()
    {
       $this->ID = Helper::GenerateID();
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

}
