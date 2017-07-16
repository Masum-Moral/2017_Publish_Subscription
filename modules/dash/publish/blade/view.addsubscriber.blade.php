<?php

include_once '/../../../util/class.util.php';
include_once '/../../../bao/class.addsubscriberbao.php';

$_AddSubscriberBAO = new AddSubscriberBAO();
$_DB = DBUtil::getInstance();
$_Log= LogUtil::getInstance();

$globalUser = '';

if(isset($_GET['accept']))
{
    ob_start();
	if (session_status() == PHP_SESSION_NONE) {
		
        session_start();
        $b = $_SESSION['catId'];
	}
	 $AddSubscriber = new AddSubscriber();

     $AddSubscriber->setInstituteID(30);
     $AddSubscriber->setCategoryID($b);
     $AddSubscriber->setSubscriberID($_GET['accept']);

	 $_AddSubscriberBAO->createAddSubscriber($AddSubscriber);
     
     
}


 //echo '<br> log:: exit blade.addsubscriber.php';
 
?>