<?php
/*session_start();
if (!isset($_GET['CatId']))
{
	echo "Please Log in First";
	session_destroy();
}
else {*/
include_once 'blade/view.subscribe.blade.php';
include_once '/../../common/class.common.php';
//$SubscriberID  =  $_GET['CatID'];
//echo $SubscriberID;
//$institution =  $_SESSION['globalUser']->getInstitution();
//echo $institution;
ob_start();

if (session_status() == PHP_SESSION_NONE) {
  session_start();

  $ID   =  $_SESSION['globalUser']->getID();
  //echo $ID;
  $Name = $_SESSION['globalUser']->getFirstName();
 // echo $Name;

}
else
{
  $ID  =  $_SESSION['globalUser']->getID();
  $Name= $_SESSION['globalUser']->getFirstName();
  //echo $ID;
 // echo $Name;
}
?>
<?php 
   if (isset($_GET['CatId'])) {
      $cat = $_GET['CatId'];
      echo $cat;
  }
 ?>
<?php include 'header.php'; ?>
	<div class="container">
		<div class="col-xs-3"></div>
		<div class="col-xs-6">
		<div id="header">
			<label>By : Kazi Masudul Alam</label><br>
		</div>
	
		<table class="table table-bordered">
		<?php
		
		$Result = $_SubscribeBAO->getSelectedNotice($cat);

		//if DAO access is successful to load all the users then show them one by one
		if($Result->getIsSuccess()){

			$NoticeList = $Result->getResultObject();
		?>
			<tr class="success">
			
				<td>Category Name</td>
				<td>Publisher Name</td>
				<td>Notice</td>
				
			</tr>
			<?php
			for($i = 0; $i < sizeof($NoticeList); $i++) {
				$Notice = $NoticeList[$i];
				?>
			    <tr>
				    
				    <td><?php echo $_SubscribeBAO->getNamefromCategoryID($Notice->getCategoryID()); ?>
				    </td>
				    <td><?php echo $_SubscribeBAO->getNamefromPublisherID($Notice->getPublisherID()); ?>
				    </td>
				    <td><?php echo $Notice->getNotice(); ?></td>
				    
			    </tr>
		    <?php

			}

		}
		else{

			echo $Result->getResultObject(); //giving failure message
		}

		?>
		<?php
		//Show Image
		$Result = $_SubscribeBAO->getSelectedImage($cat);

		//if DAO access is successful to load all the users then show them one by one
		if($Result->getIsSuccess()){

			$FileList = $Result->getResultObject();
		?>
			<!--<tr>
				<td>ID</td>
				<td>Category Name</td>
				<td>Publisher Name</td>
				<td>Image</td>
				
			</tr>-->
			<?php
			for($i = 0; $i < sizeof($FileList); $i++) {
				$File = $FileList[$i];
				?>
			    <tr>
				 
				    <td><?php echo $_SubscribeBAO->getNamefromCategoryID($File->getCategoryID()); ?>
				    </td>
				    <td><?php echo $_SubscribeBAO->getNamefromPublisherID($File->getPublisherID()); ?>
				    </td>
				   
				    <td><img src="<?php echo $File->getImage(); ?>" height="200px" 
	                               width="200px"/></td>
				    
			    </tr>
		    <?php

			}

		}
		else{

			echo $Result->getResultObject(); //giving failure message
		}

		?>
		</table>
		</div>
		<div class="col-xs-3"></div>
	</div>

<?php include 'footer.php';  ?>
<?php 
//}
 ?>