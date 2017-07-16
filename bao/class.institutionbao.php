<?php

include_once '/../util/class.util.php';
include_once '/../dao/class.institutiondao.php';
include_once '/../dao/class.subcategorydao.php';

/*
	Role Business Object 
*/
Class InstitutionBAO{

	private $_DB;
	private $_InstitutionDAO;
	private $_SubcategoryDAO;

	function InstitutionBAO(){

		$this->_InstitutionDAO = new InstitutionDAO();

	}

	public function createInstitution($Institution){

		$Result = new Result();	
		$Result = $this->_InstitutionDAO->createInstitution($Institution);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in InstitutionDAO.createInstitution()");		

		return $Result;

	
	}

	public function getAllInstitution(){

		$Result = new Result();	
		$Result = $this->_InstitutionDAO->getAllInstitution();
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in InstitutionDAO.getAllInstitution()");		

		return $Result;
	}

	public function getInstitution($ID){

		$Result = new Result();	
		$Result = $this->_InstitutionDAO->getInstitution($ID);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in InstitutionDAO.getAllInstitution()");		

		return $Result;
	}
	public function getInstituteAsRootParent($ID,$Ins_ID){

		$Result = new Result();	
		$Result = $this->_InstitutionDAO->getInstituteAsRootParent($ID,$Ins_ID);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in InstitutionDAO.getInstituteAsRootParent()");		

		return $Result;
	}

	public function createSubcategory($Subcategory){

		$Result = new Result();	
		$Result = $this->_InstitutionDAO->createSubcategory($Subcategory);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in SubcategoryDAO.createSubcategory()");		

		return $Result;	
	}

	public function readInstitutionData($Institution){
	    $Result = new Result();	
		$Result = $this->_InstitutionDAO->readInstitutionData($Institution);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in SubcategoryDAO.createSubcategory()");		

		return $Result;
	}

	public function updateInstitution($Institution){
		$Result = new Result();	
		$Result = $this->_InstitutionDAO->updateInstitution($Institution);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in SubcategoryDAO.updateInstitution()");		

		return $Result;
	}

	public function deleteInstitution($Institution){
		$Result = new Result();	
		$Result = $this->_InstitutionDAO->deleteInstitution($Institution);
		
		if(!$Result->getIsSuccess())
			$Result->setResultObject("Database failure in InstitutionDAO.deleteInstitution()");		

		return $Result;
	}

}

//echo '<br> log:: exit the class.institutionbao.php';

?>