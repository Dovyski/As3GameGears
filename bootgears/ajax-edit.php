<?php 
require_once dirname(__FILE__).'/inc/globals.php';

// TODO: fix it
//authAllowAuthenticated();

$aAction = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';
$aRet = array('status' => false);

header('Content-Type: text/javascript; charset=iso-8859-1');

switch($aAction) {
	case 'save':
		$aEntryId = isset($_REQUEST['id']) ? $_REQUEST['id'] : 'NULL';
		$aType	  = isset($_REQUEST['type']) ? $_REQUEST['type'] : 'item';
		$aData	  = null;
		
		if ($aType == 'item') {
			$aData = array(
				'id' 			=>  $aEntryId,
				'name' 			=>  isset($_REQUEST['name']) 			? $_REQUEST['name'] : '',
				'description' 	=>  isset($_REQUEST['description']) 	? $_REQUEST['description'] : '',
				//'category' 		=>  isset($_REQUEST['category']) 		? $_REQUEST['category'] : '',
				//'category2'		=>  isset($_REQUEST['category2']) 		? $_REQUEST['category2'] : '',
				'license' 		=>  isset($_REQUEST['license']) 		? $_REQUEST['license'] : '',
				'license2' 		=>  isset($_REQUEST['license2']) 		? $_REQUEST['license2'] : '',
				'site' 			=>  isset($_REQUEST['site']) 			? $_REQUEST['site'] : '',
				'repository' 	=>  isset($_REQUEST['repository']) 		? $_REQUEST['repository'] : '',
				'twitter' 		=>  isset($_REQUEST['twitter']) 		? $_REQUEST['twitter'] : '',
				'stats' 		=>  isset($_REQUEST['stats']) 			? $_REQUEST['stats'] : '',
				'sample' 		=>  isset($_REQUEST['sample']) 			? $_REQUEST['sample'] : '',
			);
			$aInfo = itemCreateOrUpdate($aEntryId, $aData);
			$aRet['status'] = $aInfo != 0;		
		
		} else if ($aType == 'text') {
			$aData = array(
				'id' 		=>  $aEntryId,
				'title' 	=>  isset($_REQUEST['title']) 		? $_REQUEST['title'] : '',
				'content' 	=>  isset($_REQUEST['content']) 	? $_REQUEST['content'] : '',
			);		
			
			$aInfo = textCreateOrUpdate($aEntryId, $aData);
			$aRet['status'] = $aInfo != 0;		
		}
		break;
		
	default:
		echo 'Unknown ajax option: ' + $aAction;
}

echo json_encode($aRet);

?>