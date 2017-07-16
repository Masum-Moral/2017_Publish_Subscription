<?php

include_once '/../util/class.util.php';
include_once '/../dao/class.requestdao.php';

/*
	Role Business Object 
*/
Class RequestBAO{

	private $_DB;
	private $_RequestDAO;
	
	function RequestBAO(){

		$this->_RequestDAO = new RequestDAO();

	}

	public function sentRequest($Request){

		$Result = new Result();	
		$Result = $this->_RequestDAO->sentRequest($Request);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in sentRequest.sentRequest()");		

		return $Result;
	}

	public function getAllRequestFromCategory($CatID){
		$Result = new Result();	
		$Result = $this->_RequestDAO->getAllRequestFromCategory($CatID);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in getAllRequestFromCategory.getAllRequestFromCategory()");		

		return $Result;
	}

	public function getCategoryIDFromRequest($b){

		return $this->_AddSubscriberDAO->getCategoryIDFromRequest($b);
	}

	public function UpdateRequestSubscriber($Request){

		$Result = new Result();	
		$Result = $this->_RequestDAO->UpdateRequestSubscriber($Request);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in updateRequestSubscriber.UpdateRequestSubscriber()");		

		return $Result;
	}

	public function deleteRequestSubscriber($Request){
		$Result = new Result();	
		$Result = $this->_RequestDAO->deleteRequestSubscriber($Request);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in deleteRequestSubscriber.deleteRequestSubscriber()");		

		return $Result;
	}
}
//echo '<br> log:: exit the class.Requestbao.php';
?>