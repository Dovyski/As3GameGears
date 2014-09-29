<?php

@include_once dirname(__FILE__).'/config.local.php';
require_once dirname(__FILE__).'/config.php';

session_start();
session_name(SESSION_NAME);

require_once dirname(__FILE__).'/db.php';
require_once dirname(__FILE__).'/view.php';
?>
