<?php

include_once '/../../../util/class.util.php';
include_once '/../../../bao/class.publishbao.php';

$_PublishBAO = new PublishBAO();
$_DB = DBUtil::getInstance();
$_Log= LogUtil::getInstance();

$globalPublisher = '';
if(isset($_POST['log_out'])){
	session_start();
	session_destroy();
	header("Location:view.publishlogin.php");
}
if(isset($_POST['login']))
{
	$Publisher = new Publisher();	
    $Publisher->setUsername($_DB->secureInput($_POST['username']));
    $Publisher->setPassword($_DB->secureInput($_POST['password']));

	$Result = $_PublishBAO->readPublisherRolesPermissions($Publisher); //reading the user object from the result 

	if($Result->getIsSuccess()){

		//storing the user object with all the roles and related permissions available in the complete system
		$globalUser = $Result->getResultObject();
		
		//required to access session variables;		
		//session_id($globalUser[0]->getID());
		
		session_start();
		if (!isset($_SESSION['globarUser'])){
		$_SESSION["globalUser"]=$globalUser;

		header("Location:view.publishnotice.php");		
	}
	
	}
	else{
		echo '<br>Wrong user name or password';
		//header("Location:view.login.php");	
	}
	
}
/* saving a new Publisher account/notice*/
if(isset($_POST['save']))
{
	 if (isset($_POST['notice']))
	 {
	 	session_start();
	 	$a = $_SESSION['globalUser'];
	 	$Notice = new Notice();
	 	$Notice->setID(Util::getGUID());
	 	$Notice->setPublisherID($a->getID());
	 	$Notice->setNotice($_POST['notice']);

	 	$_PublishBAO->createNotice($Notice);
	 } 

	 else {
	 $Publisher = new Publisher();	
	 $Publisher->setID(Util::getGUID());
     $Publisher->setCategory($_DB->secureInput($_POST['category']));
     $Publisher->setInstitution($_DB->secureInput($_POST['institution']));
     $Publisher->setUsername($_DB->secureInput($_POST['username']));
     $Publisher->setPassword($_DB->secureInput($_POST['password']));

    
	 $_PublishBAO->createPublisher($Publisher);
	 }		 
}


/* deleting an existing Publisher */
if(isset($_GET['del']))
{

	$Publisher = new Publisher();	
	$Publisher->setID($_GET['del']);	
	$_PublishBAO->deletePublisher($Publisher); //reading the Publisher object from the result object

	header("Location:view.publish.php");
}


/* reading an existing Publisher information */
if(isset($_GET['edit']))
{
	$Publisher = new Publisher();	
	$Publisher->setID($_GET['edit']);	
	$globalPublisher = $_PublisherBAO->readPublisherRolesPositions($Publisher)->getResultObject(); //reading the Publisher object from the result object
}

/*updating an existing Publisher information*/
if(isset($_POST['update']))
{
	$Publisher = new Publisher();	

    $Publisher->setID ($_GET['edit']);
    $Publisher->setUniversityID ( $_POST['txtUniversityID'] );   
    $Publisher->setEmail ( $_POST['txtEmail'] );
    $Publisher->setPassword ( $_POST['txtPassword'] );
    $Publisher->setFirstName( $_POST['txtFirstName'] );
    $Publisher->setLastName( $_POST['txtLastName'] );

    if(isset($_POST['assignedRoles'])){

	    foreach ($_POST['assignedRoles'] as $select)
		{
			$Role = new Role();
			$Role->setID($select);
			$Roles[]=$Role;
		}

		$Publisher->setRoles($Roles);
	}

	if(isset($_POST['assignedPositions'])){
	    foreach ($_POST['assignedPositions'] as $select)
		{
			$Position = new Position();
			$Position->setID($select);
			$Positions[]=$Position;
		}

		$Publisher->setPositions($Positions);
	}

	$_PublisherBAO->updatePublisher($Publisher);

	header("Location:".PageUtil::$Publisher);
}


//if a role(ID) is present in the list of list(roles(ID))
function isRoleAvailable($Role, $Roles)
{
	

	for ($i=0; $i < sizeof($Roles); $i++) { 
		# code...
		if(!strcmp($Role->getID(),$Roles[$i]->getID())){
			return true;
		}
	}

	return false;
}


//echo '<br> log:: exit blade.publish.php';
$_Log->log(LogUtil::$DEBUG,"exit blade.publish.php");

?>