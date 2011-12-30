<?php
class Items {
	public function index($name="", $props="") {

		if(empty($name)) {
			throw new RestException(5001, "Name is empty or too short");
		}
		
		$aItems = Db::findItemByName($name);

		if(count($aItems) > 0) {
			$aItem 	 = $aItems[0];
			$aResult = new stdClass();
			
			$aResult->name 			= $aItem['name'];
			$aResult->description 	= $aItem['description'];
			$aResult->excerpt 		= "Complete description.";
			$aResult->license 		= "MIT";
			$aResult->site 			= "http://toolsite.com";
			$aResult->repository	= "git://github.com/account/project-as3.git";
			$aResult->twitter		= "TwitterLogin";
			$aResult->stats 		= "OhlhoID";

			return $aResult;
			 
		} else {
			throw new RestException(5002, "Nothing found");
		}
	}
}