<?php
/**
 * api.as3gamegears.com
 * 
 */

require_once './restler/restler.php';

require_once dirname(__FILE__).'/Utils.php';
require_once dirname(__FILE__).'/Db.php';
require_once dirname(__FILE__).'/Categories.php';
require_once dirname(__FILE__).'/Item.php';
require_once dirname(__FILE__).'/Items.php';
require_once dirname(__FILE__).'/Licenses.php';
require_once dirname(__FILE__).'/Search.php';

Db::trackRequest();

spl_autoload_register('spl_autoload');

$r = new Restler();
$r->setSupportedFormats('JsonFormat', 'XmlFormat');

$r->addAPIClass('Items');
$r->addAPIClass('Item');
$r->addAPIClass('Categories');
$r->addAPIClass('Licenses');
$r->addAPIClass('Search');

$r->handle();

?>