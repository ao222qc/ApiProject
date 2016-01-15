<?php

class Collection
{
    private $ID;
    private $name;
    private $list = array();

    public function __construct()
    {
        $this->ID = Helper::GenerateID();
        $this->save();
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
        $this->list[] = $artifact;
    }

    public function Delete($id)
    {
        unset($this->list[$id]);
    }

    public function GetList()
    {
        return $this->list;
    }

    private function save()
    {
        file_put_contents(Api::PATH . $this->GetID(), serialize($this));
    }

}
