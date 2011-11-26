<?php
class Items {
	function index($name="", $props="") {
		$result = new stdClass();
		
		$result->name 			= "My tool";
		$result->description 	= "Complete description here.";
		$result->excerpt 		= "Complete description.";
		$result->license 		= "MIT";
		$result->site 			= "http://toolsite.com";
		$result->repository		= "git://github.com/account/project-as3.git";
		$result->twitter		= "TwitterLogin";
		$result->stats 			= "OhlhoID";
		
		return $result;
	}
}