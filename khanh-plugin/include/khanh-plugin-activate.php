<?php
/**
* @package KhanhPlugin
*/

class KhanhPluginActivate
{
    public static function activate(){
        flush_rewrite_rules();
    }
}
