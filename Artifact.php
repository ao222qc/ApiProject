<?php>

    class Artifact{
        private $ID;
        private $Filename;
        private $TypeOfFile;
        private $Size;

        public function __Construct()
        {
            
        }
        public function setId($ID)
        {
            $this->ID = $ID;
        }
        public function getID()
        {
          return $this->ID;
        }
        public function setFilename($Filename)
        {
            $this->Filename = $Filename;
        }
        public function getFilename()
        {
          return $this->Filename;
        }
    }