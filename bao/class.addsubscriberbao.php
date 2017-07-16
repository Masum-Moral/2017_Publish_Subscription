<?php

include_once '/../util/class.util.php';
include_once '/../dao/class.addsubscriberdao.php';

/*
	Role Business Object 
*/
Class AddSubscriberBAO{

	private $_DB;
	private $_AddSubscriberDAO;
	
	function AddSubscriberBAO(){

		$this->_AddSubscriberDAO = new AddSubscriberDAO();

	}

	public function createAddSubscriber($AddSubscriber){

		$Result = new Result();	
		$Result = $this->_AddSubscriberDAO->createAddSubscriber($AddSubscriber);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in AddSubscriber.createAddSubscriber()");		

		return $Result;
	}

	public function getNamefromSubscriberID($id)
	{
		return $this->_AddSubscriberDAO->getNamefromSubscriberID($id);
	}
	
	public function getEmailfromSubscriberID($id)
	{
		return $this->_AddSubscriberDAO->getEmailfromSubscriberID($id);
	}


	/*public function getCategoryIDFromRequest($b){

		return $this->_AddSubscriberDAO->getCategoryIDFromRequest($b);
	}*/

}
//echo '<br> log:: exit the class.addpublisherbao.php';
?>