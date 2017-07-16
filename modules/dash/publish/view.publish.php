<?php

include_once 'blade/view.publish.blade.php';
include_once '/../../common/class.common.php';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Publisher CRUD Operations</title>
		<link rel="stylesheet" href="style.css" type="text/css" />
	</head>

<body>
<center>
	<div id="header">
		<label>By : Kazi Masudul Alam</a></label>
	</div>

	<div id="form">
		<form method="post">
			<table width="100%" border="1" cellpadding="15" style="width: 500px">	
				<tr>
					<?php
						$Result = $_PublishBAO->getAllCategory();
						if ($Result->getIsSuccess())
							$CategoryList = $Result->getResultObject();					
				?>
				<td>
					<select name="category" style="width:160px;height: 30px">
					<option selected disabled>Select Category</option>
					<?php
						for ($i = 0; $i<sizeof($CategoryList); $i++){
							$Category = $CategoryList[$i];
					?>
					
						<option value="<?php echo $Category->getID();?>" > <?php echo $Category->getName(); ?> 
						</option>	
					
				<?php
				}	
				
				
				?>	
				</select>
				</td>
				</tr>
				<tr>
					<td><input type="text" name="institution" placeholder="publisher" value="<?php 
					if(isset($_GET['edit'])) echo $globalUser->getInstitution();  ?>" /></td>
				</tr>
				<tr>
					<td><input type="text" name="username" placeholder="username" value="<?php 
					if(isset($_GET['edit'])) echo $globalUser->getUsername();  ?>" /></td>
				</tr>
				<tr>
					<td><input type="password" name="password" placeholder="Password" value="<?php 
					if(isset($_GET['edit'])) echo $globalUser->getPassword();  ?>" /></td>
				</tr>
					

				<tr>
					<td>
						<?php
						if(isset($_GET['edit']))
						{
							?>
							<button type="submit" name="update">update</button>
							<?php
						}
						else
						{
							?>
							<button type="submit" name="save">save</button>
							<?php
						}
						?>
					</td>
				</tr>
			</table>
		</form>

<br />

	<table width="100%" border="1" cellpadding="15" align="center">
	<?php
	
	
	$Result = $_PublishBAO->getAllPublisher();

	//if DAO access is successful to load all the users then show them one by one
	if($Result->getIsSuccess()){

		$PublisherList = $Result->getResultObject();
	?>
		<tr>
			<td>ID</td>
			<td>Category ID</td>
			<td>Institution</td>
			<td>Username</td>
			<td>Password</td>
		</tr>
		<?php
		for($i = 0; $i < sizeof($PublisherList); $i++) {
			$Publisher = $PublisherList[$i];
			?>
		    <tr>
			    <td><?php echo $Publisher->getID(); ?></td>
			    <td><?php echo $Publisher->getCategory(); ?></td>
			    <td><?php echo $Publisher->getInstitution(); ?></td>
			    <td><?php echo $Publisher->getUsername(); ?></td>
			    <td><?php echo $Publisher->getPassword(); ?></td>
			    <td><a href="?edit=<?php echo $Publisher->getID(); ?>" onclick="return confirm('sure to edit !'); " >edit</a></td>
			    <td><a href="?del=<?php echo $Publisher->getID(); ?>" onclick="return confirm('sure to delete !'); " >delete</a></td>
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
</center>
</body>
</html>