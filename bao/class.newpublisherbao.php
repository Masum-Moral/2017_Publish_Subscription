<?php

include_once '/../util/class.util.php';
include_once '/../dao/class.newpublisherdao.php';

/*
	Role Business Object 
*/
Class NewPublisherBAO{

	private $_DB;
	private $_NewPublisherDAO;
	
	function NewPublisherBAO(){

		$this->_NewPublisherDAO = new NewPublisherDAO();

	}

	public function createNewPublisher($NewPublisher){

		$Result = new Result();	
		$Result = $this->_NewPublisherDAO->createNewPublisher($NewPublisher);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in NewPublisher.createNewPublisher()");		

		return $Result;
	}
	/*public function getPublisherIDFromNewPublisher($PublisherID){
		$Result = new Result();	
		$Result = $this->_NewPublisherDAO->getPublisherIDFromNewPublisher($PublisherID);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in NewPublisher.getPublisherIDFromNewPublisher()");		

		return $Result;
	}*/

}
//echo '<br> log:: exit the class.newpublisherbao.php';
?>