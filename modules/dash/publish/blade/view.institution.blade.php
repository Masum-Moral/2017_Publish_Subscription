<?php

include_once '/../../../util/class.util.php';
include_once '/../../../bao/class.institutionbao.php';
include_once '/../../../bao/class.subcategorybao.php';

ob_start();

if (session_status() == PHP_SESSION_NONE) {
	session_start();
}
$_InstitutionBAO = new InstitutionBAO();
$_DB = DBUtil::getInstance();
$_Log= LogUtil::getInstance();

$globalInstitution = '';

if(isset($_POST['save']))
{
	ob_start();
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
		 $a = $_SESSION['globalUser'];
	}
	else
	{
	   $a = $_SESSION['globalUser'];
	}
	  // session_start();

	 $Institution = new Institution();	

	 $Institution->setID(Util::getGUID());
	 $Institution->setUserID($a->getID());
     $Institution->setName($_DB->secureInput($_POST['name']));
     $Institution->setAddress($_DB->secureInput($_POST['address']));
    /* if (empty($Institution->getName() || $Institution->getAddress() )) 
     {
     	$msg = "<div class='alert alert-danger'><strong>Error !</strong>Field must not be empty</div>";
		return $msg;
     }
     else
     {*/
	    $_InstitutionBAO->createInstitution($Institution);
	  /*  $msg = "<div class='alert alert-success'><strong>Success ! </strong>Create Institute Successfully!!</div>";
		return $msg;
	 }*/
	     
	 

	// header("Location:home.php");
	// session_destroy();
	 $Subcategory = new Subcategory();
	 	
	 $Subcategory->setCatID(Util::getGUID());
	 $Subcategory->setUserID($a->getID());
	 $Subcategory->setInstituteID($Institution->getID());
     $Subcategory->setName($_DB->secureInput($_POST['name']));
     $Subcategory->setParentID(0);

     $_InstitutionBAO->createSubcategory($Subcategory,$Institution->getID());
	 
}

if(isset($_GET['edit']))
{
	$Institution = new Institution();	
	$Institution->setID($_GET['edit']);	
	$globalInstitution = $_InstitutionBAO->readInstitutionData($Institution)->getResultObject(); //reading the user object from the result object
}
if (isset($_POST['update'])) {
	$Institution = new Institution();	

    $Institution->setID ($_GET['edit']);
   	
    $Institution->setName( $_POST['name'] );
    $Institution->setAddress ( $_POST['address'] );
   
	$Result = $_InstitutionBAO->updateInstitution($Institution);
	if ($Result->getIsSuccess()) {
		$msg = "<div class='alert alert-success'><strong>Success ! </strong>Update Institute Successfully!!</div>";
		return $msg;
	}

	//header("Location:view.userprofile.php");
}
if (isset($_GET['del'])) {

	$Institution = new Institution();	
	$Institution->setID($_GET['del']);	
	$_InstitutionBAO->deleteInstitution($Institution); //reading the user object from the result object

	//header("Location:".PageUtil::$Institution);

}


 //echo '<br> log:: exit blade.Institution.php';
 
?>