<?php

/**
 * Search for anything on As3GameGears database
 *
 */
class Search {
	public function index($text="") {
		
		if(empty($text)) {
			throw new RestException(400, "Invalid query");
		}

		$aRet			= new stdClass();
		$aRet->query	= $text;
		$aRet->items	= array();

		foreach(Db::search($text) as $aKey => $aInfo) {
			$aRet->items[] = Utils::createItem($aInfo); 
		}
		
		return $aRet;
	}
}