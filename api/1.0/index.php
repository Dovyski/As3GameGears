<?php
/**
 * api.as3gamegears.com
 * 
 */

require_once './restler/restler.php';

spl_autoload_register('spl_autoload');

$r = new Restler();
$r->setSupportedFormats('JsonFormat', 'XmlFormat');

$r->addAPIClass('Items');
$r->addAPIClass('Item');
$r->addAPIClass('Categories');
$r->addAPIClass('Licenses');
$r->addAPIClass('Search');

$r->handle();