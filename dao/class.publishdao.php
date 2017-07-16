<?php
// write dao object for each class
include_once '/../common/class.common.php';
include_once '/../util/class.util.php';

Class PublishDAO{

	private $_DB;
	private $_Publish;
	private $_Category;

	function PublishDAO(){

		$this->_DB = DBUtil::getInstance();
		$this->_Publish = new Publisher();
		$this->_Category = new Category();
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
	public function getAllNotice($PublisherID){

		$NoticeList = array();
		$this->_DB->doQuery("SELECT * FROM tbl_notice where PublisherID = '$PublisherID' ");
		$rows = $this->_DB->getAllRows();

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

	public function getAllPublisher(){

		$PublisherList = array();

		$this->_DB->doQuery("SELECT * FROM tbl_publisher");

		$rows = $this->_DB->getAllRows();

		for($i = 0; $i < sizeof($rows); $i++) {
			$row = $rows[$i];
			$this->_Publish = new Publisher();

		    $this->_Publish->setID ( $row['ID']);
		    $this->_Publish->setCategory( $row['CategoryID'] );
		    $this->_Publish->setInstitution( $row['Institution'] );
		    $this->_Publish->setUsername( $row['Username']);
		    $this->_Publish->setPassword( $row['Password']);

		    $PublisherList[]=$this->_Publish;
   
		}
		//todo: LOG util with level of log

		$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($PublisherList);

		return $Result;
	}
	public function createPublisher($Publisher){

		$ID          = $Publisher->getID();
		$Category    = $Publisher->getCategory();
		$Institution = $Publisher->getInstitution();
		$Username    = $Publisher->getUsername();
		$Password    = $Publisher->getPassword();

		$SQL = "INSERT INTO tbl_publisher(ID,CategoryID,Institution,Username,Password) VALUES('$ID','$Category','$Institution','$Username','$Password')";

		$SQL = $this->_DB->doQuery($SQL);		
		
	 	$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($SQL);

		return $Result;
	}

	public function PublisherIDfromCategoryID($id)
	{
		$con = mysqli_connect("localhost","root","","publish_subscription");
		$result = mysqli_query($con, "SELECT * FROM tbl_new_publisher where CategoryID = '$id'");
		$a = 1;
		while($row = mysqli_fetch_assoc($result))
		{
			$a = $row['PublisherID'];	
		}
		return $a;
	}

public function findChild ($a)
 {
 	$GLOBALS['c'] =array();
 	$children = array();

	 array_push($children, $a);

	 if (hasChild($a) == true) 
	 {	
	 	$value = $GLOBALS['c'];
	 	for($i = 0; $i < count($value); $i++) {
	 		
	 		array_push($children, $value[0]);
	 		$g =  hasChild($value[0]);
	 		array_splice($GLOBALS['c'], 0, 1);
	 		$value = $GLOBALS['c'];
	 		$i = -1;
	 	}
	 }
	 return $children;
 }


   //Creat Notice
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
	//Add File 
	public function addFile($File){
		$ID    = $File->getID();
		$cID   = $File->getCategoryID();
		$pID   = $File->getPublisherID();
		$pName = $File->getPublisherName();
		$Image = $File->getImage();
	
		$SQL = "INSERT INTO tbl_file(ID,CategoryID,PublisherID,PublisherName,Image) VALUES('$ID','$cID','$pID','$pName','$Image')";

		$SQL = $this->_DB->doQuery($SQL);		
		
	 	$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($SQL);

		return $Result;
	}

	public function deletePublisher($Publish){


		$SQL = "DELETE from tbl_publisher where ID ='".$Publish->getID()."'";
	
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

	public function readPublisherRolesPermissions($Publisher){
	
		$Result = new Result();
		
		//start::user reading information
		$SQL = "SELECT * FROM tbl_publisher WHERE Username='".$Publisher->getUsername()."' and Password='".$Publisher->getPassword()."'";
	
		$this->_DB->doQuery($SQL);
		//reading the top row for this user from the database
		$row = $this->_DB->getTopRow();

		if(isset($row)){

			$this->_Publish = new Publisher();

			//preparing the user object
		    $this->_Publish->setID ( $row['ID']);
		    $this->_Publish->setCategory ( $row['CategoryID'] );   
		    $this->_Publish->setInstitution ( $row['Institution'] );
		    $this->_Publish->setUsername ( $row['Username'] );
		    $this->_Publish->setPassword( $row['Password'] );
			//end::user reading information

			$Result->setIsSuccess(1);
			$Result->setResultObject($this->_Publish);

		}

		return $Result;
	}

}
function hasChild($parent)
{
	$con = mysqli_connect("localhost","root","","publish_subscription");
	$flag = false;
	$result = mysqli_query($con, "SELECT * FROM tbl_child_cat where ParentID = '$parent'");

	if (mysqli_num_rows($result) > 0)
	{
		$flag = true;
		while ($row = mysqli_fetch_assoc($result))
		{
			array_push($GLOBALS['c'], $row['CatID']);
		}
	}

	return $flag;

}
echo '<br> log:: exit the class.publishdao.php';

?>