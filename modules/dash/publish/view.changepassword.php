<?php  
include_once 'blade/view.user.blade.php';
include_once '/../../common/class.common.php';
ob_start();

if (session_status() == PHP_SESSION_NONE) {
  session_start();

  $ID  =  $_SESSION['globalUser']->getID();
  //echo $ID;
  //$Name= $_SESSION['globalUser']->getFirstName();

}
else
{
  $ID   =  $_SESSION['globalUser']->getID();
  $Name = $_SESSION['globalUser']->getFirstName();
  //echo $ID;
}
?>
<?php include 'header.php'; ?>
<div class="container">

  <div class="col-xs-4"></div>
  
   <div class="col-xs-6">
   <h3 style="padding-left: 150px">Welcome!! <?php echo $Name; ?></h3>
     <form  role="form" method="post">        
         <h2 style="color: #286090;padding-left: 150px"  >Change your Password</h2>
           <?php 
              if (isset($_POST['changpass'])) {
                echo $msg;
              }
            ?>          
               <div class="form-group">                
                    <label for="old_pass">Old Password :</label> 
                    <input type="password" name="old_pass" class="form-control">                
               </div>

               
               <div class="form-group">                
                    <label for="password">New Password :</label> 
                    <input type="password" name="password" class="form-control">                
               </div>

               <button type="submit" name="changpass" class="btn btn-success">Update</button>          
      </form>    
    </div>
     <div class="col-xs-2"></div>
</div>
    
  
<?php include 'footer.php';  ?>