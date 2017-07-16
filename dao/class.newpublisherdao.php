<?php
// write dao object for each class
include_once '/../common/class.common.php';
include_once '/../util/class.util.php';

Class NewPublisherDAO{

	private $_DB;
	private $_NewPublisher;

	function NewPublisherDAO(){

		$this->_DB = DBUtil::getInstance();
		$this->_NewPublisher= new NewPublisher();
	}

	public function createNewPublisher($NewPublisher){

		$InstituteID = $NewPublisher->getInstituteID();	
		$CategoryID  = $NewPublisher->getCategoryID();
		$PublisherID = $NewPublisher->getPublisherID();

		$CategoryQuery = "SELECT * FROM tbl_new_publisher WHERE CategoryID = '$CategoryID' LIMIT 1";
		$CategoryQuery = $this->_DB->doQuery($CategoryQuery);

		$rows = $this->_DB->getAllRows();
		
		if (sizeof($rows) == 1) {
			echo "Here exist alredy a publisher in this Category";

		$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($CategoryQuery);


		return $Result;
		}
		else
		{
		$SQL = "INSERT INTO tbl_new_publisher(InstituteID,CategoryID,PublisherID) VALUES ('$InstituteID','$CategoryID','$PublisherID')";


		$SQL = $this->_DB->doQuery($SQL);

		
	 	$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($SQL);


		return $Result;
	}

	}
	public function createNotice($Notice){

		$ID  = $Notice->getID();
		$cID = $Notice->getCategoryID();
		$pID = $Notice->getPublisherID();
		$Not = $Notice->getNotice();
	
		$SQL = "INSERT INTO tbl_notice(ID,CategoryID,PublisherID,Notice) VALUES('$ID','$cID','$pID', '$Not')";

		$SQL = $this->_DB->doQuery($SQL);		
		
	 	$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($SQL);

		return $Result;
	}
	/*public function getPublisherIDFromNewPublisher($PublisherID){
		$this->_DB->doQuery("SELECT * FROM tbl_new_publisher Where PublisherID = '$PublisherID' ");
		$rows = $this->_DB->getAllRows();
		$row = '';
		for ($i=0; $i<sizeof($rows); $i++)
		{
			$row = $rows[$i];
		}
		return $row['PublisherID'];
	}*/
	
}
//echo '<br> log:: exit the class.newpublisherdao.php';
?>