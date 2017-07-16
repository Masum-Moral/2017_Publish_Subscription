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
	header("Location:view.userlogin.php");
}
/* saving a new Publisher account/notice*/
if(isset($_POST['notice_save']))
{
		if (isset($_GET['categoryId'])) {
		    $b = $_GET['categoryId'];
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
	 	//session_start();
	 	//$a = $_SESSION['globalUser'];
	 		 	
	 	$Notice = new Notice();

	 	$Notice->setID(Util::getGUID());
	 	$Notice->setCategoryID($b);
	 	$Notice->setPublisherID($a->getID());
	 	$Notice->setNotice($_POST['notice']);	

	 	if (empty($Notice->getNotice())) {
	 	    $msg = "<div class='alert alert-danger'><strong>Error ! </strong>Field must not be empty !! Please write something.</div>";
		    return $msg;
	 	}else{
	 	 	
	 	$child = $_PublishBAO->findChild($Notice->getCategoryID());
	 	for ($i=0; $i<count($child); $i++)
	 	{
	 		
	 		$Notice->setCategoryID($child[$i]);
	 		//$Notice->setPublisherID($_PublishBAO->PublisherIDfromCategoryID($child[$i]));
	 		$_PublishBAO->createNotice($Notice);	
	 	}
	 	$msg = "<div class='alert alert-success'><strong>Success !!</strong> Notice post successfully!! </div>";
	    return $msg;
	 }
	 	
}

if(isset($_POST['submit']))
{
	    if (isset($_GET['categoryId'])) {
		    $b = $_GET['categoryId'];
		    echo $b;
		  }
	    ob_start();
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
			$a = $_SESSION['globalUser']; 
			echo $a->getID();
		}
		else
		{
		 $a = $_SESSION['globalUser'];
		 echo $a->getID();

		}

    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_temp = $_FILES['image']['tmp_name'];
    $file_type = $_FILES['image']['type'];

    $div = explode('.', $file_name);
    $file_ext = strtolower(end($div));
    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
    $uploaded_image = "uploads/".$unique_image;

    if (empty($file_name)) {
       $msg = "<div class='alert alert-danger'><strong>Error ! </strong>Please Select any Image!</div>";
	   return $msg;
      }
      elseif ($file_size >1048567) {
       $msg = "<div class='alert alert-danger'><strong>Error ! </strong>Image Size should be less then 1MB!</div>";
	   return $msg;
      } 
      elseif (!$file_temp) {
      	$msg = "<div class='alert alert-danger'><strong>Error ! </strong>No File Selected,Upload Again!</div>";
	    return $msg;
      }
      else{
        move_uploaded_file($file_temp, $uploaded_image);

	 	$File = new File();

	 	$File->setCategoryID($b);
	 	$File->setPublisherID($a->getID());
	 	$File->setPublisherName($a->getFirstName());
	 	$File->setImage($uploaded_image);	
	 //	$File->setCreationDate(date("y/m/d"));
	 	 	
	 	$child = $_PublishBAO->findChild($File->getCategoryID());
	 	for ($i=0; $i<count($child); $i++)
	 	{
	 		$File->setID(Util::getGUID());
	 		$File->setCategoryID($child[$i]);
	 		$_PublishBAO->addFile($File);	
	 	}
	 	$msg = "<div class='alert alert-success'><strong>Success !!</strong> Image post successfully!! </div>";
	    return $msg;
	 }
	/* else{
	 	echo '<br>'.'<strong style=" color:red; ">'."Sorry, there was an error uploading your file.".'</strong>';
	 }*/
	 	

}


/* deleting an existing Notice */
if(isset($_GET['delete']))
{

	$Notice = new Notice();	
	$Notice->setID($_GET['delete']);
	
	$_PublishBAO->deleteNotice($Notice); 

	header("Location:view.notice.php");
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



//echo '<br> log:: exit blade.publishnotice.php';
$_Log->log(LogUtil::$DEBUG,"exit blade.publishnotice.php");

?>