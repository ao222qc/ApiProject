<?php

class Template
{
    static $Title = "No title";
    static $Body = "";

    static function Render()
    {
        self::$Body = self::$Body.ob_get_clean();
        include("_template.php");
    }

    static function Init()
    {
        ob_start();
    }
}
