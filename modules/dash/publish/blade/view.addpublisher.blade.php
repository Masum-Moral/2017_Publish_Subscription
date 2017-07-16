<?php

include_once '/../../../util/class.util.php';
include_once '/../../../bao/class.newpublisherbao.php';

$_NewPublisherBAO = new NewPublisherBAO();
$_DB = DBUtil::getInstance();
$_Log= LogUtil::getInstance();

$globalUser = '';

if(isset($_POST['sav']))
{
	if (isset($_GET['id'])) {
		$b = $_GET['id'];
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

	 $NewPublisher = new NewPublisher();


     $NewPublisher->setInstituteID($b);
     $NewPublisher->setCategoryID($_DB->secureInput($_POST['catid']));
     $NewPublisher->setPublisherID($a->getID());

	 $Result = $_NewPublisherBAO->createNewPublisher($NewPublisher);
	 if ($Result->getIsSuccess()) {
	 	$msg = "<div class='alert alert-success'><strong>Success !!</strong> You Are Now Publisher This Category.</div>";
	    return $msg;
	 }

	 //Location("view.addpublisher.php");
}


 //echo '<br> log:: exit blade.addpublisher.php';
 
?>