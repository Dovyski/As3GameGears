<?php
class Item {
	public function index($name="", $props="") {
		
		if(empty($name)) {
			throw new RestException(400, "Empty item name");
		}
		
		$aItems = Db::findItemByName($name);

		if(count($aItems) > 0) {
			return Utils::createItem($aItems[0]);
			 
		} else {
			throw new RestException(400, "Unknown item " . $name);
		}
	}
}