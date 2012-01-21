<?php

/**
 * Search for anything on As3GameGears database
 *
 */
class Search {
	const INVALID_QUERY	= 5001;
	
	public function index($text="") {
		
		if(empty($text)) {
			throw new RestException(self::INVALID_QUERY, "Invalid query");
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