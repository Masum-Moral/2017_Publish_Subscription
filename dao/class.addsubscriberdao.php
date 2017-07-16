<?php
// write dao object for each class
include_once '/../common/class.common.php';
include_once '/../util/class.util.php';

Class AddSubscriberDAO{

	private $_DB;
	private $_AddSubscriber;

	function AddSubscriberDAO(){

		$this->_DB = DBUtil::getInstance();
		$this->_AddSubscriber= new AddSubscriber();
	}

	public function createAddSubscriber($AddSubscriber){
		//echo "Binayak";

		$InstituteID  = $AddSubscriber->getInstituteID();	
		$CategoryID   = $AddSubscriber->getCategoryID();
		$SubscriberID = $AddSubscriber->getSubscriberID();

		$SubscriberQuery = "SELECT * FROM tbl_add_subscriber WHERE SubscriberID = '$SubscriberID' and CategoryID = '$CategoryID'  LIMIT 1";
		$SubscriberQuery = $this->_DB->doQuery($SubscriberQuery);

		$rows = $this->_DB->getAllRows();
		
		if (sizeof($rows) == 1) {
			echo "You are alredy a Subscriber in this Category";

		$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($SubscriberQuery);


		return $Result;
		}
		else
		{
		$SQL = "INSERT INTO tbl_add_subscriber(InstituteID,CategoryID,SubscriberID) VALUES ('$InstituteID','$CategoryID','$SubscriberID')";


		$SQL = $this->_DB->doQuery($SQL);

		
	 	$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($SQL);


		return $Result;
	}

	}

	public function getNamefromSubscriberID($id)
	{
		$this->_DB->doQuery("SELECT * FROM tbl_user Where ID = '".$id."' ");
		$rows = $this->_DB->getAllRows();
		$row = '';
		for ($i=0; $i<sizeof($rows); $i++)
		{
			$row = $rows[$i];
		}

		return $row['FirstName']." ".$row['LastName'];
	}

	public function getEmailfromSubscriberID($id){

		$this->_DB->doQuery("SELECT * FROM tbl_user Where ID = '".$id."' ");
		$rows = $this->_DB->getAllRows();
		$row = '';
		for ($i=0; $i<sizeof($rows); $i++)
		{
			$row = $rows[$i];
		}

		return $row['Email'];
	}


/*	public function getCategoryIDFromRequest($b){

		$this->_DB->doQuery("SELECT * FROM tbl_request Where SubscriberID = '".$b."' ");
		$rows = $this->_DB->getAllRows();
		$row = '';
		for ($i=0; $i<sizeof($rows); $i++)
		{
			$row = $rows[0];
		}
		return $row['CatID'];
	}*/
	
}
//echo '<br> log:: exit the class.addsubscriberdao.php';
?>