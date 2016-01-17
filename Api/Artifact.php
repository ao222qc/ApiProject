<?php
    // Artifact()
    class Artifact{
        private $ID;
        private $Filename;
        private $Extension;

        public function __Construct($file)
        {
            $this->Filename = $file["name"];
            $this->ID = Helper::GenerateID();
            $this->Extension = pathinfo($file["name"])["extension"];

            move_uploaded_file($file["tmp_name"], Api::ARTIFACTPATH.$this->ID);
        }
        public function GetID()
        {
            return $this->ID;
        }
        public function GetFilename()
        {
            return $this->Filename;
        }
        public function GetExtension()
        {
            return $this->Extension;
        }

        public function Suicide()
        {
            if(file_exists(Api::ARTIFACTPATH.$this->ID))
                unlink(Api::ARTIFACTPATH.$this->ID);
        }

        public function Update($file)
        {
            $this->Suicide();
            move_uploaded_file($file["tmp_name"], Api::ARTIFACTPATH.$this->ID);
        }

        public function IsGhost()
        {
            return !file_exists(Api::ARTIFACTPATH.$this->ID);
        }
    }
