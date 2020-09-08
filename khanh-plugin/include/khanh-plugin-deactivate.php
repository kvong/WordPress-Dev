<?php
/**
* @package KhanhPlugin
*/

class KhanhPluginDeactivate
{
    public static function deactivate(){
        flush_rewrite_rules();
    }
}
