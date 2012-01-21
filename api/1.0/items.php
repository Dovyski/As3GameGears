<?php
class Items {
	const INVALID_NAME 					= 5001;
	const NOTHING_FOUND 				= 5002;
	
	public function index($name="", $props="") {
		
		if(empty($name)) {
			throw new RestException(self::INVALID_NAME, "Name is empty or too short");
		}
		
		$aItems = Db::findItemByName($name);

		if(count($aItems) > 0) {
			return Utils::createItem($aItems[0]);
			 
		} else {
			throw new RestException(self::NOTHING_FOUND, "Nothing found");
		}
	}
}