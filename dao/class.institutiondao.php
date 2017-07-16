<?php
// write dao object for each class
include_once '/../common/class.common.php';
include_once '/../util/class.util.php';

Class InstitutionDAO{

	private $_DB;
	private $_Institution;

	function InstitutionDAO(){

		$this->_DB = DBUtil::getInstance();
		$this->_Institution = new Institution();
	}

	public function createInstitution($Institution){

		$ID      = $Institution->getID();
		$UserID  = $Institution->getUserID();
		$Name    = $Institution->getName();
		$Address = $Institution->getAddress();

		$SQL = "INSERT INTO tbl_institution(ID,UserID,Name,Address) VALUES('$ID','$UserID','$Name','$Address')";
		//$SQL = "INSERT INTO tbl_child_cat(CatID,UserID,InstituteID,Name,ParentID) VALUES('1','$UserID','$Name','$Address')";

		$SQL = $this->_DB->doQuery($SQL);		
		
	 	$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($SQL);

		return $Result;
	}

	public function getAllInstitution(){

		$InstitutionList = array();

		$this->_DB->doQuery("SELECT * FROM tbl_institution ");

		$rows = $this->_DB->getAllRows();

		for($i = 0; $i < sizeof($rows); $i++) {
			$row = $rows[$i];
			$this->_Institution = new Institution();

		    $this->_Institution->setID ( $row['ID']);
		    $this->_Institution->setUserID ( $row['UserID']);
		    $this->_Institution->setName( $row['Name'] );
		    $this->_Institution->setAddress( $row['Address']);

		    $InstitutionList[]=$this->_Institution;
   
		}
		//todo: LOG util with level of log

		$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($InstitutionList);

		return $Result;
	}
	public function getInstitution($ID){

		$InstitutionList = array();

		$this->_DB->doQuery("SELECT * FROM tbl_institution WHERE UserID = '".$ID."' ");

		$rows = $this->_DB->getAllRows();

		for($i = 0; $i < sizeof($rows); $i++) {
			$row = $rows[$i];
			$this->_Institution = new Institution();

		    
		    $this->_Institution->setID ( $row['ID']);
		    $this->_Institution->setUserID ( $row['UserID']);
		    $this->_Institution->setName( $row['Name'] );
		    $this->_Institution->setAddress( $row['Address']);


		    $InstitutionList[]=$this->_Institution;
   
		}
		//todo: LOG util with level of log

		$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($InstitutionList);

		return $Result;
	}

	public function getInstituteAsRootParent($ID,$Ins_ID){

		$InstitutionList = array();

		$this->_DB->doQuery("SELECT * FROM tbl_institution WHERE UserID = '".$ID."' AND ID ='".$Ins_ID."' ");
		
			                         

		$rows = $this->_DB->getAllRows();

		for($i = 0; $i < sizeof($rows); $i++) {
			$row = $rows[$i];
			$this->_Institution = new Institution();

		    
		    $this->_Institution->setID ( $row['ID']);
		    $this->_Institution->setUserID ( $row['UserID']);
		    $this->_Institution->setName( $row['Name'] );
		    $this->_Institution->setAddress( $row['Address']);


		    $InstitutionList[]=$this->_Institution;
   
		}
		//todo: LOG util with level of log

		$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($InstitutionList);

		return $Result;
	}
	
	public function createSubcategory($Subcategory){
		//echo "Error";

		$CatID       = $Subcategory->getCatID();
		$UserID      = $Subcategory->getUserID();
		$InstituteID = $Subcategory->getInstituteID();
		//echo $InstituteID;
		$Name        = $Subcategory->getName();
		$ParentID    = $Subcategory->getParentID();


		$SQL = "INSERT INTO tbl_child_cat(CatID,UserID,InstituteID,Name,ParentID) VALUES('$CatID','$UserID','$InstituteID','$Name','$ParentID')";


		$SQL = $this->_DB->doQuery($SQL);		
		//echo "Error";
	 	$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($SQL);

		return $Result;
	}

	public function readInstitutionData($Institution){
		$SQL = "SELECT * FROM tbl_institution WHERE ID ='".$Institution->getID()."'";
		$this->_DB->doQuery($SQL);

		//reading the top row for this user from the database
		$row = $this->_DB->getTopRow();

		$this->_Institution = new Institution();

		//preparing the user object
	    $this->_Institution->setID ( $row['ID']);
	    $this->_Institution->setName ( $row['Name'] );    
	    $this->_Institution->setUserID ( $row['UserID'] );
	    $this->_Institution->setAddress( $row['Address'] );
		   


	 	$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($this->_Institution);

		return $Result;
	}

	public function updateInstitution($Institution){
		$SQL = "UPDATE tbl_institution SET
		 
	    Name = '".$Institution->getName()."',
		Address   = '".$Institution->getAddress()."'

		WHERE ID = '".$Institution->getID()."' ";

		$SQL = $this->_DB->doQuery($SQL);

	 	$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($SQL);
		return $Result;
	}
	public function deleteInstitution($Institution){
		$SQL = "DELETE from tbl_institution where ID ='".$Institution->getID()."'";
	
		$SQL = $this->_DB->doQuery($SQL);

	 	$Result = new Result();
		$Result->setIsSuccess(1);
		$Result->setResultObject($SQL);

		return $Result;
	}
	
}

//echo '<br> log:: exit the class.institutiondao.php';

?>