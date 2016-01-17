<?php

class Collection
{
    private $ID;
    private $name;
    private $list = array();

    public function __construct($Name)
    {
        $this->ID = Helper::GenerateID();
        $this->name = $Name;

        $this->save();
    }
    //On unserialize
    public function __wakeup()
    {
        foreach ($this->list as $item)
        {
            if ($item instanceof Artifact)
            {
                if ($item->IsGhost())
                {
                    unset($this->list[$item->GetID()]);
                }
            }
        }
    }

    public function GetID()
    {
        return $this->ID;
    }

    public function GetName()
    {
        return $this->name;
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

    public function GetArtifact($artifactID)
    {

        if(isset($this->list[$artifactID]))
        {
            return $this->list[$artifactID];
        }
        return null;

    }

    public function Delete($id)
    {
        $this->list[$id]->Delete();
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
