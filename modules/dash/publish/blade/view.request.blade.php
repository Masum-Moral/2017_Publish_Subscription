<?php

include_once '/../../../util/class.util.php';
include_once '/../../../bao/class.requestbao.php';

$_RequestBAO = new RequestBAO();
$_DB = DBUtil::getInstance();
$_Log= LogUtil::getInstance();

$globalUser = '';

if(isset($_POST['request']))
{
	echo "Problem Occured";
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
	    // $a->getID();
	}

	 $Request = new Request();

	 $Request->setRequestID(Util::getGUID());
     $Request->setInstituteID($b);
     $Request->setSubscriberID($a->getID());
     $Request->setCatID($_DB->secureInput($_POST['catid']));
     $Request->setStatus(2);
     
     echo "Problem Occured 2";
	 $_RequestBAO->sentRequest($Request);

	 header("Location:home.php");
}
if(isset($_GET['accept']))
{
	$Request = new Request();
    $Request->setSubscriberID($_GET['accept']);

	$_RequestBAO->UpdateRequestSubscriber($Request);

	//header("Location: view.Request.php");
}
if(isset($_GET['reject']))
{

	$Request = new Request();	
	$Request->setSubscriberID($_GET['reject']);	
	
	$_RequestBAO->deleteRequestSubscriber($Request); 

	//header("Location: view.Request.php");
}

//echo '<br> log:: exit blade.addsubscriber.php';
 
?>