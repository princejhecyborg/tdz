<?php
include 'draftingzone.php';


class dailytime_controller extends draftingzone
{
	
	function __construct()
	{
		parent::__construct();
	}
	function DTR()
	{
		$load = "backend/dtr_area/dailytime_view";
		$this->pageLoader($load, $array = array(), $pageLoader = array());
	}
}
