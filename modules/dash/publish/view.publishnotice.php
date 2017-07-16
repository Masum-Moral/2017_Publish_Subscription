
<?php

include_once 'blade/view.publishnotice.blade.php';
include_once 'blade/view.subcategory.blade.php';
include_once '/../../common/class.common.php';
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
$i = 0;
?>
<?php include 'header.php'; ?>
   

   
	<div id="header">
		<label><a>By : Kazi Masudul Alam</a></label>
	</div>
	

<div class="container">
<div class="col-sm-3">
	<div style="background: #F5F6F7;height: 600px; padding: 20px">
	</div>
</div>
<div class="col-sm-6">
	<div style="background: #F5F6F7;height: 600px; padding: 20px">
	<form role = "form" method="post" enctype="multipart/form-data">
	<h3 style="color: #286090;padding-left: 150px" >Post Something</h3>
	<?php 
        if (isset($_POST['notice_save'])) {
          echo $msg;
    	}
    	if (isset($_POST['submit'])) {
          echo $msg;
    	}
    ?>	
	<?php 
		
		if (isset($_POST['notice_view'])) {
			$i = 1;
					
	 ?>
		<form method="post" enctype="multipart/form-data">
			
				<div style="background: #ddd;padding: 20px">
					<div class="form-group">
						<textarea type="notice" name="notice" class="form-control" placeholder="Write Something" value="<?php 
						if(isset($_GET['edit'])) echo $globalUser->getNotice();  ?>" rows="5"></textarea>
					</div>
					<button type="submit" name="notice_view" class="btn btn-primary">Notice</button>
					<button type="submit" name="image_view" class="btn btn-primary">Image</button><br></br>
				</div>

				<div >
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
							<button  type="submit" name="notice_save" class="btn btn-success">post</button><br>
							<?php
						}
						?>
				</div>
			
		
		</form>
		<?php
		 }  
		   if (isset($_POST['image_view'])) {
		   $i = 1;
	   ?>

		<form action="" method="post" enctype="multipart/form-data">
		<?php 
		 if (isset($_POST['submit'])) {
          echo $msg;
    	}
		 ?>
		<div style="background: #ddd;padding: 20px">				
			<div class="form-group">
				
		        <div class="uploadBtn"><input type="file" name="image" /></div>
            </div>
            <input style="color: #449D44" type="submit" name="submit" /></br></br>

			<button type="submit" name="notice_view" class="btn btn-primary">Notice</button>
			<button type="submit" name="image_view" class="btn btn-primary">Image</button>
		</div>
		</form>
		<?php } if($i == 0) {?>
		<form method="post" enctype="multipart/form-data">
			
			
				<div style="background: #ddd;padding: 20px">
				<div class="form-group">
					<textarea  type="notice" name="notice" class="form-control" placeholder="Write Something" value="<?php 
					if(isset($_GET['edit'])) echo $globalUser->getNotice();  ?>" rows="5" ></textarea>
				</div>
				<button type="submit" name="notice_view" class="btn btn-primary">Notice</button>
		        <button type="submit" name="image_view" class="btn btn-primary">Image</button></br></br>
		        </div><br>
					<div>
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
							<button  type="submit" name="notice_save" class="btn btn-success" >post</button>
							<?php
						}
						?>
					</div>
		
		</form>
		<?php } ?>
	</form>
	</div>
	</div>
	<div class="col-sm-3">
	<div style="background: #F5F6F7;height: 600px;width:300px ; padding: 20px">
	 <button class="btn btn-info" type="button" style="width: 250px;">Creat Notice</span></button></br>
       <div style="padding: 10px;font-size: 15px">
              <?php 
                  $Result = $_SubcategoryBAO->getPublisherSubcategory($ID);
                  if($Result->getIsSuccess()){

                  $SubcategoryList = $Result->getResultObject();
                  for ($i = 0; $i<sizeof($SubcategoryList); $i++){
                      $Subcategory = $SubcategoryList[$i];
              ?>
                <a href='view.publishnotice.php?categoryId=<?php echo $Subcategory->getCatID();?>'><?php echo $Subcategory->getName();?></a></br>
                 <?php 
                 }     
               }
               ?>
        </div>
	</div>
	</div>
</div>
		

<div class="container">
	<table class="table table-bordered">
	<?php
	
	
	$Result = $_PublishBAO->getAllNotice($a->getID());

	//if DAO access is successful to load all the users then show them one by one
	if($Result->getIsSuccess()){

		$NoticeList = $Result->getResultObject();
	?>
		<tr class="success">
			<td>ID</td>
			<td>Category ID</td>
			<td>Publisher ID</td>
			<td>Notice</td>
			<td>Edit</td>
			<td>Delete</td>
			
		</tr>
		<?php
		for($i = 0; $i < sizeof($NoticeList); $i++) {
			$Notice = $NoticeList[$i];
			?>
		    <tr>
			    <td><?php echo $Notice->getID(); ?></td>
			    <td><?php echo $Notice->getCategoryID(); ?></td>
			    <td><?php echo $Notice->getPublisherID(); ?></td>
			    <td><?php echo $Notice->getNotice(); ?></td>
			    
			    <td><a href="?edit=<?php echo $Notice->getID(); ?>" onclick="return confirm('sure to edit !'); " >edit</a></td>
			    <td><a href="?delete=<?php echo $Notice->getID(); ?>" onclick="return confirm('sure to delete !'); " >delete</a></td>
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