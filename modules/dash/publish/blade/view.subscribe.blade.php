<?php

include_once '/../../../util/class.util.php';
include_once '/../../../bao/class.subscribebao.php';

$_SubscribeBAO = new SubscribeBAO();
$_DB = DBUtil::getInstance();
$_Log= LogUtil::getInstance();

if(isset($_POST['logout'])){
	session_start();
	session_destroy();
	header("Location:view.userlogin.php");
}
if(isset($_POST['log_in']))
{
	$Subscribe = new Subscriber();	
	$Subscribe->setCategory($_DB->secureInput($_POST['category']));
	$Subscribe->setInstitution($_DB->secureInput($_POST['institution']));
    $Subscribe->setUsername($_DB->secureInput($_POST['username']));
    $Subscribe->setPassword($_DB->secureInput($_POST['password']));

	$Result = $_SubscribeBAO->readSubscriberRolesPermissions($Subscribe); //reading the user object from the result 

	if($Result->getIsSuccess()){

		//storing the user object with all the roles and related permissions available in the complete system
		$globalUser = $Result->getResultObject();
		
		session_start();
		$_SESSION["globalUser"]=$globalUser;

		header("Location:view.notice.php");		
	}
	
	
	else{
		echo '<br>Wrong user name or password';
		//header("Location:view.login.php");	
	}
	
}


/* saving a new Publisher account/notice*/
if(isset($_POST['save']))
{
	 echo "save called";
	 $Subscribe = new Subscriber();	
	 $Subscribe->setID(Util::getGUID());
     $Subscribe->setCategory($_DB->secureInput($_POST['category']));
     $Subscribe->setInstitution($_DB->secureInput($_POST['institution']));
     $Subscribe->setUsername($_DB->secureInput($_POST['username']));
     $Subscribe->setPassword($_DB->secureInput($_POST['password']));
    
	 $_SubscribeBAO->createSubscriber($Subscribe);
	 echo "save called";	 
}


/* deleting an existing Publisher */
if(isset($_GET['del']))
{

	$Subscribe = new Subscriber();	
	$Subscribe->setID($_GET['del']);	
	$_SubscribeBAO->deleteSubscriber($Subscribe); //reading the Publisher object from the result object

	header("Location:view.subscribe.php");
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

	header("Location:view.subscribe.php");
}



//echo '<br> log:: exit blade.subscribe.php';
$_Log->log(LogUtil::$DEBUG,"exit blade.subscribe.php");

?>