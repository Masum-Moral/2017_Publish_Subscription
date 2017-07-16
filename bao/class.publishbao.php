<?php

include_once '/../util/class.util.php';
include_once '/../dao/class.publishdao.php';


/*
	Role Business Object 
*/
Class PublishBAO{

	private $_DB;
	private $_PublishDAO;

	function PublishBAO(){

		$this->_PublishDAO = new PublishDAO();

	}

	//get all Questions
	public function getAllCategory(){

		$Result = new Result();	
		$Result = $this->_PublishDAO->getAllCategory();
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in QuestionDAO.getAllQuestions()");		

		return $Result;
	}
	public function getAllNotice($PublisherID){

		$Result = new Result();	
		$Result = $this->_PublishDAO->getAllNotice($PublisherID);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in QuestionDAO.getAllNotice()");		

		return $Result;
	}
	public function getAllPublisher(){

		$Result = new Result();	
		$Result = $this->_PublishDAO->getAllPublisher();
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in QuestionDAO.getAllQuestions()");		

		return $Result;
	}
	public function createPublisher($Publisher){

		$Result = new Result();	
		$Result = $this->_PublishDAO->createPublisher($Publisher);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in PublishDAO.createPublisher()");		

		return $Result;

	
	}
	public function deletePublisher($Publisher){

		$Result = new Result();	
		$Result = $this->_PublishDAO->deletePublisher($Publisher);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in PublishDAO.deletePublisher()");		

		return $Result;

	
	}

	public function readPublisherRolesPermissions($Publisher){
		$Result = new Result();	
		$Result = $this->_PublishDAO->readPublisherRolesPermissions($Publisher);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in PublishDAO.deletePublisher()");		

		return $Result;	
	}

	public function createNotice($Notice){

		$Result = new Result();	
		$Result = $this->_PublishDAO->createNotice($Notice);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in PublishDAO.createNotice()");		

		return $Result;
	
	}

  // Add File in database
	public function addFile($File){
		$Result = new Result();	
		$Result = $this->_PublishDAO->addFile($File);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in PublishDAO.addFile()");		

		return $Result;
	}
	public function findChild($catID){

		return $this->_PublishDAO->findChild($catID);
	
	}

	public function PublisherIDfromCategoryID($id)
	{
		return $this->_PublishDAO->PublisherIDfromCategoryID($id);
	}

	public function deleteNotice($Notice){

		$Result = new Result();	
		$Result = $this->_PublishDAO->deleteNotice($Notice);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in PublishDAO.createNotice()");		

		return $Result;

	
	}

}

echo '<br> log:: exit the class.publishbao.php';

?>