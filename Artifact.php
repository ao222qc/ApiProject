<?php>
    // Artifact()
    class Artifact{
        private $ID;
        private $Filename;
        private $TypeOfFile;
        private $Size; ////testhg jhgj

        public function __Construct()
        {
            // time to construct!
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
