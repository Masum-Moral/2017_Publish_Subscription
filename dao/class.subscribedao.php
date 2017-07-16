<?php
// write dao object for each class
include_once '/../common/class.common.php';
include_once '/../util/class.util.php';

Class SubscribeDAO{

	private $_DB;
	private $_Publish;
	private $_Category;
	private $_Subscribe;

	function SubscribeDAO(){

		$this->_DB = DBUtil::getInstance();
		$this->_Publish = new Publisher();
		$this->_Category = new Category();
		$this->_Subscribe = new Subscriber();
	}

	// get all the Terms from the database using the database query
	public function getAllCategory(){

		$CategoryList = array();

		$this->_DB->doQuery("SELECT * FROM tbl_category");

		$rows = $this->_DB->getAllRows();

		for($i = 0; $i < sizeof($rows); $i++) {
			$row = $rows[$i];
			$this->_Category = new Category();

		    $this->_Category->setID ( $row['ID']);
		    $this->_Category->setName( $row['Name'] );


		    $CategoryList[]=$this->_Category;
   
		}
		//todo: LOG util with level of log

		$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($CategoryList);

		return $Result;
	}
	/*public function getAllNotice($PublisherID){

		$CategoryList = array();

		$this->_DB->doQuery("SELECT * FROM tbl_notice WHERE PublisherID = '".$PublisherID."' ");

		$rows = $this->_DB->getAllRows();

		for($i = 0; $i < sizeof($rows); $i++) {
			$row = $rows[$i];
			$this->_Category = new Notice();

		    $this->_Category->setID ( $row['ID']);
		    $this->_Category->setPublisherID( $row['PublisherID'] );
		    $this->_Category->setNotice( $row['Notice'] );


		    $CategoryList[]=$this->_Category;
   
		}
		//todo: LOG util with level of log

		$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($CategoryList);

		return $Result;
	}*/
	public function getNamefromPublisherID($id)
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
	
	public function getNamefromCategoryID($id)
	{
		$this->_DB->doQuery("SELECT * FROM tbl_child_cat Where CatID = '".$id."' ");
		$rows = $this->_DB->getAllRows();
		$row = '';
		for ($i=0; $i<sizeof($rows); $i++)
		{
			$row = $rows[$i];
		}
		return $row['Name'];
	}
	//Dao for show Notice
	public function getSelectedNotice($SubscriberID){

		$NoticeList = array();

		//$this->_DB->doQuery("SELECT CategoryID FROM tbl_add_subscriber where SubscriberID='".$SubscriberID."' ");
		//$rows= $this->_DB->getAllRows();
		//$row = $rows[0];
		//$value = $row['CategoryID'];

		$this->_DB->doQuery("SELECT * FROM tbl_notice Where CategoryID = '".$SubscriberID."' ");

		$rows = $this->_DB->getAllRows();
		$row = '';
		//$row = $rows[0];
		for($i = 0; $i < sizeof($rows); $i++) {
			$row = $rows[$i];
			$this->_Notice = new Notice();

		    $this->_Notice->setID ( $row['ID']);
		    $this->_Notice->setCategoryID ( $row['CategoryID']);
		    $this->_Notice->setPublisherID( $row['PublisherID'] );
		    $this->_Notice->setNotice( $row['Notice'] );


		    $NoticeList[]=$this->_Notice;
   
		}
		//todo: LOG util with level of log

		$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($NoticeList);

		return $Result;
	}
		//Dao for show image
	public function getSelectedImage($CategoryID){

		$FileList = array();

		//$this->_DB->doQuery("SELECT CategoryID FROM tbl_add_subscriber where SubscriberID='".$SubscriberID."' ");
		//$rows= $this->_DB->getAllRows();
		//$row = $rows[0];
		//$value = $row['CategoryID'];

		$this->_DB->doQuery("SELECT * FROM tbl_file Where CategoryID = '".$CategoryID."' ");

		$rows = $this->_DB->getAllRows();
		$row = '';
		//$row = $rows[0];
		for($i = 0; $i < sizeof($rows); $i++) {
			$row = $rows[$i];
			$this->_File = new File();

		    $this->_File->setID ( $row['ID']);
		    $this->_File->setCategoryID ( $row['CategoryID']);
		    $this->_File->setPublisherID( $row['PublisherID'] );
		    $this->_File->setImage( $row['Image'] );


		    $FileList[]=$this->_File;
   
		}
		//todo: LOG util with level of log

		$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($FileList);

		return $Result;
	}

	public function getAllSubscriber(){

		$SubscriberList = array();

		$this->_DB->doQuery("SELECT * FROM tbl_subscriber");

		$rows = $this->_DB->getAllRows();

		for($i = 0; $i < sizeof($rows); $i++) {
			$row = $rows[$i];
			$this->_Subscribe = new Subscriber();

		    $this->_Subscribe->setID ( $row['ID']);
		    $this->_Subscribe->setCategory( $row['CategoryID'] );
		    $this->_Subscribe->setInstitution( $row['Institution'] );
		    $this->_Subscribe->setUsername( $row['Username']);
		    $this->_Subscribe->setPassword( $row['Password']);

		    $SubscriberList[]=$this->_Subscribe;
   
		}
		//todo: LOG util with level of log

		$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($SubscriberList);

		return $Result;
	}
	public function createSubscriber($Subscribe){

		$ID          = $Subscribe->getID();
		$Category    = $Subscribe->getCategory();
		$Institution = $Subscribe->getInstitution();
		$Username    = $Subscribe->getUsername();
		$Password    = $Subscribe->getPassword();

		$SQL = "INSERT INTO tbl_subscriber(ID,CategoryID,Institution,Username,Password) VALUES('$ID','$Category','$Institution','$Username','$Password')";

		$SQL = $this->_DB->doQuery($SQL);		
		
	 	$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($SQL);

		return $Result;
	}
	public function createNotice($Notice){

		$ID  = $Notice->getID();
		$pID = $Notice->getPublisherID();
		$Not = $Notice->getNotice();

		$SQL = "INSERT INTO tbl_notice(ID,PublisherID,Notice) VALUES('$ID','$pID','$Not')";

		$SQL = $this->_DB->doQuery($SQL);		
		
	 	$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($SQL);

		return $Result;
	}

	public function deleteSubscriber($Subscriber){


		$SQL = "DELETE from tbl_subscriber where ID ='".$Subscriber->getID()."'";
	
		$SQL = $this->_DB->doQuery($SQL);

	 	$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($SQL);

		return $Result;

	}
	public function deleteNotice($Notice){


		$SQL = "DELETE from tbl_notice where ID ='".$Notice->getID()."'";
	
		$SQL = $this->_DB->doQuery($SQL);

	 	$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($SQL);

		return $Result;

	}

	public function readSubscriberRolesPermissions($Subscribe){
	
		$Result = new Result();
		
		//start::user reading information
		$SQL = "SELECT * FROM tbl_subscriber WHERE CategoryID='".$Subscribe->getCategory()."' and Institution = '".$Subscribe->getInstitution()."' and Username='".$Subscribe->getUsername()."' and Password='".$Subscribe->getPassword()."'";
	
		$this->_DB->doQuery($SQL);
		//reading the top row for this user from the database
		$row = $this->_DB->getTopRow();

		if(isset($row)){

			$this->_Subscribe = new Subscriber();

			//preparing the user object
		    $this->_Subscribe->setID ( $row['ID']);
		    $this->_Subscribe->setCategory ( $row['CategoryID'] );   
		    $this->_Subscribe->setInstitution ( $row['Institution'] );
		    $this->_Subscribe->setUsername ( $row['Username'] );
		    $this->_Subscribe->setPassword( $row['Password'] );
			//end::user reading information

		
			//start::getting all the roles of the user
			

			//end::getting all the roles of the user
		    

			$Result->setIsSuccess(1);
			$Result->setResultObject($this->_Subscribe);

		}

		return $Result;
	}

}

//echo '<br> log:: exit the class.subscribedao.php';

?>