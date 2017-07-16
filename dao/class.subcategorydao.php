<?php
// write dao object for each class
include_once '/../common/class.common.php';
include_once '/../util/class.util.php';

Class SubcategoryDAO{

	private $_DB;
	private $_Subcategory;
	private $_NewPublisher;

	function SubcategoryDAO(){

		$this->_DB = DBUtil::getInstance();
		$this->_Subcategory = new Subcategory();
		$this->_NewPublisher = new NewPublisher();

	}

	// get all the Subcategory from the database using the database query
	public function getAllSubcategory($ID,$Ins_ID){

		$SubcategoryList = array();

		$this->_DB->doQuery("SELECT * FROM tbl_child_cat WHERE UserID = '".$ID."' 
			                         AND InstituteID ='".$Ins_ID."' ");

		$rows = $this->_DB->getAllRows();

		for($i = 0; $i < sizeof($rows); $i++) {
			$row = $rows[$i];
			$this->_Subcategory = new Subcategory();

		    $this->_Subcategory->setCatID ( $row['CatID']);
		    $this->_Subcategory->setUserID ( $row['UserID']);
		    $this->_Subcategory->setInstituteID ( $row['InstituteID']);
		    $this->_Subcategory->setName( $row['Name'] );
		    $this->_Subcategory->setParentID( $row['ParentID'] );


		    $SubcategoryList[]=$this->_Subcategory;
   
		}

		//todo: LOG util with level of log


		$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($SubcategoryList);

		return $Result;
	}

	public function getInstituteSubcategory($Ins_ID){

		$SubcategoryList = array();

		$this->_DB->doQuery("SELECT * FROM tbl_child_cat WHERE InstituteID = '".$Ins_ID."' ");

		$rows = $this->_DB->getAllRows();

		for($i = 0; $i < sizeof($rows); $i++) {
			$row = $rows[$i];
			$this->_Subcategory = new Subcategory();

		    $this->_Subcategory->setCatID ( $row['CatID']);
		    $this->_Subcategory->setInstituteID ( $row['InstituteID']);
		    $this->_Subcategory->setName( $row['Name'] );
		    $this->_Subcategory->setParentID( $row['ParentID'] );


		    $SubcategoryList[]=$this->_Subcategory;
   
		}

		//todo: LOG util with level of log


		$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($SubcategoryList);

		return $Result;
	}
	public function getPublisherSubcategory($ID){
		$SubcategoryList = array();

		$this->_DB->doQuery("SELECT c.Name,c.CatID FROM tbl_child_cat c, tbl_new_publisher p WHERE p.PublisherID = '".$ID."' and p.CategoryID = c.CatID");
		$rows = $this->_DB->getAllRows();

		for($i = 0; $i < sizeof($rows); $i++) {
			$row = $rows[$i];
			$this->_Subcategory = new Subcategory();
		    $this->_Subcategory->setCatID ( $row['CatID']);
		    $this->_Subcategory->setName( $row['Name'] );
		 
		    $SubcategoryList[]=$this->_Subcategory;   
		}

		//todo: LOG util with level of log
		$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($SubcategoryList);

		return $Result;
	}


	// get all the Permissions from the database using the database query
	public function getAllPermissions(){

		$PermissionList = array();

		$this->_DB->doQuery("SELECT * FROM tbl_Permission");

		$rows = $this->_DB->getAllRows();

		for($i = 0; $i < sizeof($rows); $i++) {
			$row = $rows[$i];
			$this->_Permission = new Permission();

		    $this->_Permission->setID ( $row['ID']);
		    $this->_Permission->setName( $row['Name'] );
		    $this->_Permission->setCategory( $row['Category'] );

		    $PermissionList[]=$this->_Permission;
   
		}

	
		$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($PermissionList);

		return $Result;
	}

		//read an Role object based on its id form Role object
	public function readSubcategory($Subcategory){
		
		$SQL = "SELECT * FROM tbl_child_cat WHERE CatID='".$Subcategory->getCatID()."'";
		$this->_DB->doQuery($SQL);

		//reading the top row for this Role from the database
		$row = $this->_DB->getTopRow();

		$this->Subcategory = new Subcategory();

		//preparing the Role object
	    $this->_Subcategory->setCatID ( $row['CatID']);
	    $this->_Subcategory->setName( $row['Name'] );



	 	$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($this->_Subcategory);

		return $Result;
	}
	//update an Role object based on its 
	public function updateSubcategory($Subcategory){

		$SQL = "UPDATE tbl_child_cat SET Name='".$Subcategory->getName()."' WHERE CatID='".$Subcategory->getCatID()."'";


		$SQL = $this->_DB->doQuery($SQL);

	 	$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($SQL);

		return $Result;

	}

	//delete an Subcategory based on its id of the database
	public function deleteSubcategory($Subcategory){

        echo $Subcategory->getCatID();
		$SQL = "DELETE from tbl_child_cat where CatID ='".$Subcategory->getCatID()."' ";
	
		$SQL = $this->_DB->doQuery($SQL);

	 	$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($SQL);

		return $Result;

	}
	public function getSubscriberSubcategory($ID){
		$SubcategoryList = array();

		$this->_DB->doQuery("SELECT c.Name,c.CatID FROM tbl_child_cat c,tbl_add_subscriber s WHERE 
			s.SubscriberID = '".$ID."' and s.CategoryID = c.CatID");

		$rows = $this->_DB->getAllRows();

		for($i = 0; $i < sizeof($rows); $i++) {
			$row = $rows[$i];
			$this->_Subcategory = new Subcategory();

		    $this->_Subcategory->setCatID ( $row['CatID']);
		    $this->_Subcategory->setName( $row['Name'] );

		    $SubcategoryList[]=$this->_Subcategory;
   
		}

		//todo: LOG util with level of log


		$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($SubcategoryList);

		return $Result;
	}

}

//echo '<br> log:: exit the class.subcategorydao.php';

?>