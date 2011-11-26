<?php
/**
 * api.as3gamegears.com
 * 
 */

require_once './restler/restler.php';

spl_autoload_register('spl_autoload');

$r = new Restler();
$r->setSupportedFormats('JsonFormat');
$r->addAPIClass('Items');
$r->handle();