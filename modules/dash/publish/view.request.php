
<?php  
include_once '/../../common/class.common.php';
include_once 'blade/view.addsubscriber.blade.php';
include_once 'blade/view.subcategory.blade.php';
include_once 'blade/view.request.blade.php';

ob_start();

if (session_status() == PHP_SESSION_NONE) {
  session_start();
   $ID  =  $_SESSION['globalUser']->getID();
	if (isset($_GET['categoryId'])) {
		$_SESSION['myValue'] = $_GET['categoryId'];
	} 
}
else
{
  $ID = $_SESSION['globalUser']->getID();
    if (isset($_GET['categoryId'])) {
	$_SESSION['catId'] = $_GET['categoryId'];
  }
}

?>
<?php 
   if (isset($_GET['categoryId'])) {
      $CatID = $_GET['categoryId'];
    //  echo $CatID;
  }
 ?>

<?php include 'header.php';?>

<div class="container">
	<div class="row">
		<div class="col-xs-4">
		<h4>Category</h4>
		
		    <?php 
                  $Result = $_SubcategoryBAO->getPublisherSubcategory($ID);
                  if($Result->getIsSuccess()){
	                  $SubcategoryList = $Result->getResultObject();
	                  for ($i = 0; $i<sizeof($SubcategoryList); $i++){
	                      $Subcategory = $SubcategoryList[$i];
              ?>
                <a href='view.request.php?categoryId=<?php echo $Subcategory->getCatID();?>'><?php echo $Subcategory->getName();?></a><br>
                 <?php 
                 }     
               }
              ?>

		</div>
		<?php 
   if (isset($_GET['categoryId'])) {
      $CatID = $_GET['categoryId']; 
 ?>
		<div class="col-xs-8">
		<h3>Approval Interface</h3>
		
			<table class="table table-bordered">
				<?php	
					$Result = $_RequestBAO->getAllRequestFromCategory($CatID);
					if($Result->getIsSuccess()){
						$RequestList = $Result->getResultObject();
				?>
				<tr class="success">
					<td>#</td>							
					<td>Name</td>
					<td>Email</td>	
					<td>Status</td>	
					<td>Accept</td>	
					<td>Reject</td>
				</tr>
					<?php
					$count = 1;
						for($i = 0; $i < sizeof($RequestList); $i++) {
						   $Request = $RequestList[$i];			   
					?>
				<tr>
					<td><?php echo $count++; ?></td>
					<td><?php echo $_AddSubscriberBAO->getNamefromSubscriberID($Request->getSubscriberID()); ?></td>
					<td><?php echo $_AddSubscriberBAO->getEmailfromSubscriberID($Request->getSubscriberID()); ?></td>					
					<td><?php echo "Pending" ?></td>
					<td><a href="?accept=<?php echo $Request->getSubscriberID(); ?>" onclick="return confirm('Are You Sure to Accept This Request !'); ">
					<button type="button" class="btn btn-default" name="approve">Accept</button></a></td>
                    <td><a href="?reject=<?php echo $Request->getSubscriberID(); ?>" onclick="return confirm('Are You Sure to Reject This Request !'); "><button type="button" class="btn btn-default">Reject</button></a></td>
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
		<?php }
		else{
			//echo "Select Any Category Name for Show Request";
			?>
			<div class="col-xs-8">
		    <h3>Approval Interface</h3>
			<table class="table table-bordered">
			<tr class="success">
					<td>#</td>							
					<td>Name</td>
					<td>Email</td>	
					<td>Status</td>	
					<td>Accept</td>	
					<td>Reject</td>
				</tr>
				</table>
				</div>
				<?php 
			} ?>
		
	</div>
	
</div>
<?php include 'footer.php';?>