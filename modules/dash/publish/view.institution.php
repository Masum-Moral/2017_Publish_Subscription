<?php

include_once 'blade/view.institution.blade.php';
include_once '/../../common/class.common.php';
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
<?php include 'header.php'; ?>
	<div id="header">
		<label>By : Kazi Masudul Alam</label>
	</div>

	<div class="container">
		<div class="col-xs-4"></div>
			<div class="col-xs-4">
				<form role="form" method="post">
				<h3 style="color: #286090;padding-left: 100px" >Add Institution</h3>
				<?php 
	           		//if (isset($_POST['save']) || isset($_POST['update'])) {
	           		//	echo $msg;
	           		 // }
                ?>
						
						<div class="form-group"> 
						    <label for="name">Institution Name :</label> 
							<input type="name" name="name" placeholder="Institution Name"  class="form-control" value="<?php 
							if(isset($_GET['edit'])) echo $globalInstitution->getName();  ?>" />
						</div>

						<div class="form-group" >
						    <label for="name">Address :</label> 
							<input type="address" name="address" placeholder="Address"  class="form-control" value="<?php 
							if(isset($_GET['edit'])) echo $globalInstitution->getAddress();  ?>" />
						</div>
						
								<?php
								if(isset($_GET['edit']))
								{
									?>
									<button type="submit" name="update" class="btn btn-success">update</button>
									<?php
								}
								else
								{
									?>
									<button type="submit" name="save"  class="btn btn-success">save</button>
									<?php
								}
								?>
						
					
				</form>
			</div>
		<div class="col-xs-4"></div>


	<table class="table table-bordered">
	<?php
	
	
	$Result = $_InstitutionBAO->getInstitution($ID);

	//if DAO access is successful to load all the users then show them one by one
	if($Result->getIsSuccess()){

		$InstitutionList = $Result->getResultObject();
	?>
		<tr class="success">
			<td>ID</td>
			<td>UserID</td>
			<td>Institute Name</td>
			<td>Address</td>
			<td>Edit</td>
			<td>Delete</td>
		</tr>
		<?php
		for($i = 0; $i < sizeof($InstitutionList); $i++) {
			$Institution = $InstitutionList[$i];
			?>
		    <tr>
			    <td><?php echo $Institution->getID(); ?></td>
			    <td><?php echo $Institution->getUserID(); ?></td>
			    <td><?php echo $Institution->getName(); ?></td>
			    <td><?php echo $Institution->getAddress(); ?></td>
			    <td><a href="?edit=<?php echo $Institution->getID(); ?>" onclick="return confirm('sure to edit !'); " >edit</a></td>
			    <td><a href="?del=<?php echo $Institution->getID(); ?>" onclick="return confirm('sure to delete !'); " >delete</a></td>
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

<?php include 'footer.php';  ?>