<?php

include_once '/../util/class.util.php';
include_once '/../dao/class.subscribedao.php';


/*
	Role Business Object 
*/
Class SubscribeBAO{

	private $_DB;
	private $_SubscribeDAO;

	function SubscribeBAO(){

		$this->_SubscribeDAO = new SubscribeDAO();

	}

	//get all Questions
	public function getAllCategory(){

		$Result = new Result();	
		$Result = $this->_SubscribeDAO->getAllCategory();
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in QuestionDAO.getAllQuestions()");		

		return $Result;
	}
	/*public function getAllNotice($PublisherID){

		$Result = new Result();	
		$Result = $this->_SubscribeDAO->getAllNotice($PublisherID);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in QuestionDAO.getAllNotice()");		

		return $Result;
	}*/
	public function getNamefromPublisherID($id)
	{
		return $this->_SubscribeDAO->getNamefromPublisherID($id);
	}
	public function getNamefromCategoryID($id)
	{
		return $this->_SubscribeDAO->getNamefromCategoryID($id);
	}
	//Bao in Show notice
	public function getSelectedNotice($SubscriberID){

		$Result = new Result();	
		$Result = $this->_SubscribeDAO->getSelectedNotice($SubscriberID);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in QuestionDAO.getAllNotice()");		

		return $Result;
	}
		//Bao in Show Image
	public function getSelectedImage($CategoryID){

		$Result = new Result();	
		$Result = $this->_SubscribeDAO->getSelectedImage($CategoryID);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in FileDAO.getAllFile()");		

		return $Result;
	}
	public function getAllSubscriber(){

		$Result = new Result();	
		$Result = $this->_SubscribeDAO->getAllSubscriber();
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in QuestionDAO.getAllQuestions()");		

		return $Result;
	}
	public function createSubscriber($Subscribe){

		$Result = new Result();	
		$Result = $this->_SubscribeDAO->createSubscriber($Subscribe);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in SubscribeDAO.createSubscriber()");		

		return $Result;

	
	}
	public function deleteSubscriber($Subscribe){

		$Result = new Result();	
		$Result = $this->_SubscribeDAO->deleteSubscriber($Subscribe);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in SubscribeDAO.deleteSubscriber()");		

		return $Result;

	
	}

	public function readSubscriberRolesPermissions($Subscriber){
		$Result = new Result();	
		$Result = $this->_SubscribeDAO->readSubscriberRolesPermissions($Subscriber);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in SubscribeDAO.deleteSubscriber()");		

		return $Result;	
	}

	public function createNotice($Notice){

		$Result = new Result();	
		$Result = $this->_SubscribeDAO->createNotice($Notice);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in SubscribeDAO.createNotice()");		

		return $Result;

	
	}
	public function deleteNotice($Notice){

		$Result = new Result();	
		$Result = $this->_SubscribeDAO->deleteNotice($Notice);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in SubscribeDAO.createNotice()");		

		return $Result;

	
	}

}

//echo '<br> log:: exit the class.subscribebao.php';

?>