<?php

@include_once dirname(__FILE__).'/config.local.php';
require_once dirname(__FILE__).'/config.php';

session_start();
session_name(SESSION_NAME);

require_once dirname(__FILE__).'/db.php';
require_once dirname(__FILE__).'/view.php';
require_once dirname(__FILE__).'/category.php';
require_once dirname(__FILE__).'/item.php';
require_once dirname(__FILE__).'/license.php';
require_once dirname(__FILE__).'/navigation.php';
require_once dirname(__FILE__).'/text.php';
require_once dirname(__FILE__).'/author.php';
require_once dirname(__FILE__).'/utils.php';

require_once(dirname(__FILE__).'/libs/markdown/markdown_extended.php');
?>
