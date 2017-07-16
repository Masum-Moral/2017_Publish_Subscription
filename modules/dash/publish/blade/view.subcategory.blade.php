<?php

include_once '/../../../util/class.util.php';
include_once '/../../../bao/class.subcategorybao.php';
include_once '/../../../bao/class.institutionbao.php';
ob_start();

if (session_status() == PHP_SESSION_NONE) {
	session_start();
}
$globalUser = '';
$_SubcategoryBAO = new SubcategoryBAO();
$_InstitutionBAO = new InstitutionBAO();
$_DB = DBUtil::getInstance();

if(isset($_POST['save']))
{
	if (isset($_GET['InstituteId'])) {
		$b = $_GET['InstituteId'];
	}

    ob_start();
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
		$a = $_SESSION['globalUser']; 
	}
	else
	{
	 $a = $_SESSION['globalUser'];
	}
	 $Subcategory = new Subcategory();
	 	
	 $Subcategory->setCatID(Util::getGUID());
	 $Subcategory->setUserID($a->getID());
	 $Subcategory->setInstituteID($b);
     $Subcategory->setName($_DB->secureInput($_POST['txtName']));
     $Subcategory->setParentID($_DB->secureInput($_POST['parentId']));

     if ($Subcategory->getName() == "")  {
     	$msg = "<div class='alert alert-danger'><strong>Error !</strong>Category Name must not be empty</div>";
		return $msg;
     }else{
	    $_InstitutionBAO->createSubcategory($Subcategory,$b);
	    $msg = "<div class='alert alert-success'><strong>Success !!</strong>Category Add Successfully!!</div>";
	    return $msg;
	    }
	 // header("Location:view.subcategory.php");
			 
}

/* deleting an existing Subcategory */
if(isset($_GET['del']))
{

	$Subcategory = new Subcategory();	
	$Subcategory->setCatID($_GET['del']);	
	$_SubcategoryBAO->deleteSubcategory($Subcategory); //reading the Subcategory object from the result object

	header("Location: view.subcategory.php");
}


/* reading an existing Subcategory information */
if(isset($_GET['edit']))
{
	$Subcategory = new Subcategory();	
	$Subcategory->setCatID($_GET['edit']);	
	$getROW = $_SubcategoryBAO->readSubcategory($Subcategory)->getResultObject(); //reading the Subcategory object from the result object
}

/*updating an existing Role information*/
if(isset($_POST['update']))
{
	$Subcategory = new Subcategory();	

    $Subcategory->setCatID ($_GET['edit']);
    $Subcategory->setName( $_POST['txtName'] );
	$Subcategory->setParent( $_POST['parent'] );

	$_SubcategoryBAO->updateSubcategory($Subcategory);

	header("Location: view.Subcategory.php");
}



//echo '<br> log:: exit blade.Subcategory.php';

?>




















