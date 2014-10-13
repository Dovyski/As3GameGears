<?php

require_once dirname(__FILE__).'/config.php';

function utilsMakePrettyWebsiteLink($theUrl, $theUrlLimit = 16) {
	$aReturn 	= '';

	if($theUrl != '') {
		$aParts = explode('.', $theUrl);

		if(preg_match('$https?://www?$i', $aParts[0])) {
			unset($aParts[0]);

		} else if(preg_match('$https?://$i', $aParts[0])) {
			$aParts[0] = substr($aParts[0], strpos($aParts[0], ':') + 3, 999);
		}

		$aText	= implode('.', $aParts);
		$aText 	= strlen($aText) > $theUrlLimit ? substr($aText, 0, $theUrlLimit) . '...' : $aText;
		$aReturn = '<a href="'.$theUrl.'" target="_blank">'.$aText.'</a>';
	}

	return $aReturn;
}

function utilsMakePrettyDeveloperLink($theItem) {
	return $theItem['twitter'] != '' ? '<a href="http://twitter.com/'.$theItem['twitter'].'" target="_blank">'.$theItem['twitter'].'</a>' : 'Unkown';
}

function utilsMakePrettyRepoLink($theRepoUrl) {
	$aRet = array('url', 'icon');

	if($theRepoUrl != '') {
	$aRepoInfo 		= getRepoInfo($theRepoUrl);
		$aRet['url'] 	= '<a href="'.(strpos($theRepoUrl, 'git://') === false ? 'git://' . $theRepoUrl : $theRepoUrl).'" target="_blank">'.$aRepoInfo['name'].'</a>';
		$aRet['icon'] = $aRepoInfo['icon'];
		$aRet['name'] = $aRepoInfo['name'];
	}

	return $aRet;
}

function utilsGetRepoInfo($theRepoUrl) {
	$aMaps = array(
		'googlecode.com' 	=> array('icon' => 'google', 		'name' => 'Google Code'),
		'sourceforge.net' 	=> array('icon' => 'code', 			'name' => 'SourceForge'),
		'github.com' 		=> array('icon' => 'github', 		'name' => 'GitHub'),
		'bitbucket.org' 	=> array('icon' => 'bitbucket', 	'name' => 'Bitbucket')
	);

	$aRet = array('icon' => 'code', 'name' => '???');

	if($theRepoUrl != '') {
		$aParts = parse_url($theRepoUrl);
		
		if(!isset($aParts['host'])) {
			preg_match_all('$(.+@)*([\w\d\.]+):(.*)$', $theRepoUrl, $aParts);
			$aParts['host'] = $aParts[2][0];
		}
		
		$aDomain 	= explode('.', $aParts['host']);
		$aName		= $aDomain[count($aDomain) - 2];
		$aDomain 	= $aName . '.' . $aDomain[count($aDomain) - 1];

		$aRet = isset($aMaps[$aDomain]) ? $aMaps[$aDomain] : array('icon' => 'code', 'name' => ucwords($aName));
	}

	return $aRet;
}

function utilsGetSocialRepoStuff($theRepoUrl) {
	$aContent = '';
	$aMatches = array();

	if(stripos($theRepoUrl, 'github.com') !== false) {
		$aType = 0;

		if(strpos($theRepoUrl, 'git://') !== false) {
			preg_match_all("$.*github.com\/(.+)\/(.+)\.git$", $theRepoUrl, $aMatches);
		} else {
			$aType = 1;
			preg_match_all("$(.+@)*([\w\d\.]+):(.*)/(.*)\.git$", $theRepoUrl, $aMatches);
		}

		if(count($aMatches) > 1) {
			$aUser  = $aType == 0 ? $aMatches[1][0] : $aMatches[3][0];
			$aRepo  = $aType == 0 ? $aMatches[2][0] : $aMatches[4][0];

			$aContent .= '<iframe src="http://ghbtns.com/github-btn.html?user='.$aUser.'&repo='.$aRepo.'&type=watch&count=true&size=small" allowtransparency="true" frameborder="0" scrolling="0" style="border: 0; width: 100px; height: 30px; overflow: hidden; margin-top: 10px;"></iframe>';
			$aContent .= '<iframe src="http://ghbtns.com/github-btn.html?user='.$aUser.'&repo='.$aRepo.'&type=fork&count=true&size=small" allowtransparency="true" frameborder="0" scrolling="0" style="border: 0; width: 100px; height: 30px; overflow: hidden; margin-top: 10px;"></iframe>';
		}
	}

	return $aContent;
}

?>
