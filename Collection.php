<?php

class Collection
{
    private $ID;
    private $name;
    private $list = array();
    
    public function __construct()
    {
       
    }
    
    public function AddToList()
    {
        //$this->list[] = whatever you want bb
    }
    
    public function Delete()
    {
        
    }
    
    public function GetList()
    {
        return $this->list;
    }
    
}