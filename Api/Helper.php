<?php

class Helper
{
   static function GenerateID()
    {
        return substr(md5(microtime().rand()), 0, 6);
       //An added comment and alittle more!
       //Rasmus told me to do this
    }
}
