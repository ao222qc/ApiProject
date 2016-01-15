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

    public function AddCollection(Collection $c)
    {
        $this->list[$c->GetID()] = $c;
        $this->save();
    }

    public function AddArtifact(Artifact $artifact)
    {
        $this->list[$artifact->GetID()] = $artifact;
        $this->save();
    }

    public function Delete($id)
    {
        unset($this->list[$id]);
        $this->save();
    }

    public function GetList()
    {
        return $this->list;
    }

    private function save()
    {
        file_put_contents(Api::COLLECTIONPATH . $this->GetID(), serialize($this));
    }

}
