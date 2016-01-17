<?php

class Collection
{
    private $ID;
    private $name;
    private $list = array();

    public $IsSnapshot = false;

    public function __construct($Name)
    {
        $this->ID = Helper::GenerateID();
        $this->name = $Name;
        $this->save();
    }
    //On unserialize
    public function __wakeup()
    {
        $this->Update();
    }

    private function Update()
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
            elseif ($item instanceof Collection)
            {
                if ($item->IsGhost())
                {
                    unset($this->list[$item->GetID()]);
                }
                else
                {
                    $this->list[$item->GetID()]->IsSnapshot = true;
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

    public function GetCollection($id)
    {
        if (isset($this->list[$id]))
        {
            if ($this->list[$id]->IsSnapshot)
            {
                $this->list[$id] = Api::GetCollection($id);
            }

            return $this->list[$id];
        }

        return null;
    }

    public function Suicide()
    {
        if ($this->IsSnapshot)
        {
            $tmp = Api::GetCollection(Api::COLLECTIONPATH.$this->GetID());
            $this->list = $tmp->GetList();
            $this->IsSnapshot = false;
        }

        foreach ($this->list as $item)
        {
            if ($item instanceof Artifact)
            {
                $this->list[$item->GetID()]->Suicide();
                unset($this->list[$item->GetID()]);
            }
            elseif ($item instanceof Collection)
            {
                $item->Suicide();
            }
        }
        unlink(Api::COLLECTIONPATH.$this->GetID());
    }

    public function DeleteArtifact($id)
    {
        $this->list[$id]->Suicide();
        unset($this->list[$id]);

        $this->save();
    }

    public function DeleteCollection($id)
    {
        $this->GetCollection($id)->Suicide();
        unset($this->list[$id]);

        $this->save();
    }

    public function Remove($id)
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

    public function IsGhost()
    {
        return !file_exists(Api::COLLECTIONPATH.$this->GetID());
    }
}
