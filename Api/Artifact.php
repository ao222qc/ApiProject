<?php
    // Artifact()
    class Artifact{
        private $ID;
        private $Filename;
        private $Type;
        private $Size; ////testhg jhgj

        public function __Construct($file)
        {
            $this->Filename = $file["name"];
            $this->Size = $file["size"];
            $this->Type = $file["type"];
            $this->ID = Helper::GenerateID();

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
    }
