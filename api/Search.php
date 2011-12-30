<?php

/**
 * Search for anything on As3GameGears database
 *
 */
class Search {
	const INVALID_QUERY					= 5001;
	const INVALID_CATEGORY				= 5002;
	
	public function index($category="", $text="") {
		
		if(empty($category)) {
			throw new RestException(self::INVALID_QUERY, "Invalid query");
		}
		
		if(!empty($text) && Db::categoryExists($category) == false) {
			throw new RestException(self::INVALID_CATEGORY, "Unknown category " . $category);
		}
		
		$aFilterCat		= !empty($text); 
		$text			= empty($text) ? $category : $text;
		$category		= $aFilterCat ? $category : null;
		$aRet			= new stdClass();
		
		$aRet->query	= $text;

		if($aFilterCat) {
			$aRet->category	= $category;
		}
		
		$aRet->items	= array();

		foreach(Db::search($text, $category) as $aKey => $aInfo) {
			$aEntry					= new stdClass();
			$aEntry->id 			= $aInfo['id'];
			$aEntry->name 			= $aInfo['name'];
			$aEntry->description 	= $aInfo['description'];
			$aEntry->excerpt 		= "Complete description.";
			$aEntry->license 		= "MIT";
			$aEntry->site 			= "http://toolsite.com";
			$aEntry->repository		= "git://github.com/account/project-as3.git";
			$aEntry->twitter		= "TwitterLogin";
			$aEntry->stats 			= "OhlhoID";

			$aRet->items[]			= $aEntry; 
		}
		
		return $aRet;
	}
}