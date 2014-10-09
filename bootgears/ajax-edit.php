<?php 
require_once dirname(__FILE__).'/inc/globals.php';

// TODO: fix it
//authAllowAuthenticated();

$aAction = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';
$aRet = array('status' => false);

header('Content-Type: text/javascript; charset=iso-8859-1');

switch($aAction) {
	case 'savetext':
		$aItemId = isset($_REQUEST['id']) ? $_REQUEST['id'] : 'NULL';
		
		$aData = array(
			'id' 		=>  $aItemId,
			'content' 	=>  isset($_REQUEST['content']) 	? $_REQUEST['content'] : '',
		);
		
		$aInfo = itemCreateOrUpdate($aItemId, $aData);
		$aRet['status'] = $aInfo != 0;		
		break;
		
	default:
		echo 'Unknown ajax option: ' + $aAction;
}

echo json_encode($aRet);

?>