<?php
// write dao object for each class
include_once '/../common/class.common.php';
include_once '/../util/class.util.php';

Class RequestDAO{

	private $_DB;
	private $_Request;

	function RequestDAO(){

		$this->_DB = DBUtil::getInstance();
		$this->_Request= new Request();
	}

	public function sentRequest($Request){

		$ReqID        = $Request->getRequestID();
		$InstituteID  = $Request->getInstituteID();
		$SubscriberID = $Request->getSubscriberID();	
		$CatID        = $Request->getCatID();
		$Status       = $Request->getStatus();
		
		$RequestQuery = "SELECT * FROM tbl_request WHERE SubscriberID = '$SubscriberID' and CatID = '$CatID'  LIMIT 1";
		$RequestQuery = $this->_DB->doQuery($RequestQuery);

		$rows = $this->_DB->getAllRows();
		
		if (sizeof($rows) == 1) {
			echo "You Sent Already a Request in this Category";

		$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($RequestQuery);
		return $Result;
		}
		else
		{
		$SQL = "INSERT INTO tbl_request(ReqID,InstituteID,SubscriberID,CatID,Status) VALUES ('$ReqID','$InstituteID','$SubscriberID','$CatID',$Status)";

		$SQL = $this->_DB->doQuery($SQL);
		
	 	$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($SQL);
		return $Result;
	   }
	}

	public function getAllRequestFromCategory($CatID){
		$RequestList = array();

		$this->_DB->doQuery("SELECT r.* FROM tbl_request r, tbl_user u WHERE 
			r.CatID = '".$CatID."' and r.SubscriberID = u.ID and r.Status = '2' ");

		$rows = $this->_DB->getAllRows();

		for($i = 0; $i < sizeof($rows); $i++) {
			$row = $rows[$i];
			$this->_Request = new Request();

		    $this->_Request->setSubscriberID($row['SubscriberID']);
		    $this->_Request->setCatID( $row['CatID']);

		    $RequestList[]=$this->_Request;
   
		}

		//todo: LOG util with level of log


		$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($RequestList);

		return $Result;

	}

	public function getCategoryIDFromRequest($b){

		$this->_DB->doQuery("SELECT CatID FROM tbl_request Where SubscriberID = '".$b."' ");
		$rows = $this->_DB->getAllRows();
		$row = '';
		for ($i=0; $i<sizeof($rows); $i++)
		{
			$row = $rows[$i];
		}
		return $row['CatID'];
	}

	public function UpdateRequestSubscriber($Request){

		$SQL = "UPDATE  tbl_request SET Status = '1' WHERE SubscriberID ='".$Request->getSubscriberID()."' ";


		$SQL = $this->_DB->doQuery($SQL);

	 	$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($SQL);

		return $Result;
	}

	public function deleteRequestSubscriber($Request){
	   // echo $Subcategory->getCatID();
		$SQL = "DELETE from tbl_request where SubscriberID ='".$Request->getSubscriberID()."' ";
	
		$SQL = $this->_DB->doQuery($SQL);

	 	$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($SQL);

		return $Result;
	}
	
}
//echo '<br> log:: exit the class.Requestdao.php';
?>