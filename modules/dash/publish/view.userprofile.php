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
  <div class="col-xs-5">
    <div style="padding-top: 100px">
        <?php
          
            $Result = $_UserBAO->getUserProfileImage($ID);
            if($Result->getIsSuccess()){

            $UserImageList = $Result->getResultObject();
            for ($i = 0; $i<sizeof($UserImageList); $i++){
                $UserProfileImage = $UserImageList[$i];
              
        ?>
        <a href=""><img src="<?php echo $UserProfileImage->getImage(); ?>" height="250px" 
         width="250px"/></a>
        <?php } } ?>

     <form action="" method="post" enctype="multipart/form-data">
         <table class="table table-bordered" style="width: 100px">
            <tr class="success">            
                <td><input type="file" name="image"/></td>
            </tr>

            <tr>              
                 <td><input type="submit" name="submit" value="Upload"/></td>
            </tr>
         </table>
     </form>
     
     </div>
  </div>
  
   <div class="col-xs-6">
     <form  role="form" method="post">
            <?php 
                if (isset($_GET['edit'])) {     
             ?>
           <h2 style="color: #286090;padding-left: 150px" >Update Your Account</h2>
           <?php 
              if (isset($_POST['save'])) {
                echo $msg;
              }
            ?>

           <table>
               <label>First Name :</label>    
               <div class="form-group">  
                  <div class="input-group">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>  
                    <input type="text" name="firstname" class="form-control" value="<?php 
                       if(isset($_GET['edit'])) echo $globalUser->getFirstName();  ?>">
                  </div>
               </div>

                <label>Last Name :</label> 
               <div class="form-group">
                  <div class="input-group"> 
                    <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>   
                    <input type="text" name="lastname" class="form-control" value="<?php 
                       if(isset($_GET['edit'])) echo $globalUser->getLastName();  ?>">
                  </div>
               </div>

               <label>Email :</label> 
               <div class="form-group"> 
                  <div class="input-group">                 
                    <span class="input-group-addon">@</span>               
                    <input type="text" name="email" class="form-control" value="<?php 
                      if(isset($_GET['edit'])) echo $globalUser->getEmail();  ?>">
                  </div>
               </div>

               <label>Address :</label>
               <div class="form-group">
                  <div class="input-group">      
                    <span class="input-group-addon"><span class="glyphicon glyphicon-home"></span></span>
                    <input type="text" name="address" class="form-control" value="<?php 
                        if(isset($_GET['edit'])) echo $globalUser->getAddress();  ?>">
                  </div>
               </div>

               <button type="submit" name="update" class="btn btn-success">Update</button>

                 <a class="btn btn-info" href="view.changepassword.php?changpass=<?php echo $ID ; ?>">Change Password</a>
          
             
           </table>
           <?php } else { ?>
        </form>
      
      
    
      
        <?php 
          $Result = $_UserBAO->getLoginUser($ID);
          if($Result->getIsSuccess()){
            $UserList = $Result->getResultObject();
        ?>
          <?php
         
            for($i = 0; $i < sizeof($UserList); $i++) {
               $User = $UserList[$i];       
          ?> 
            <form  role="form" method="post">        
                <h3 style="padding-left: 250px">Welcome!! <?php echo $Name; ?></h3>          
                     <div class="form-group">                
                          <label for="firstname">First Name :</label> 
                          <input type="firstname" name="firstname" class="form-control" value="<?php echo $User->getFirstName(); ?> ">                
                     </div>

                    
                     <div class="form-group">                
                          <label for="lastname">Last Name :</label> 
                          <input type="lastname" name="lastname" class="form-control" value="<?php echo $User->getLastName(); ?>">                
                     </div>

                     <div class="form-group">                
                          <label for="email">Email :</label> 
                          <input type="email" name="email" class="form-control" value="<?php echo $User->getEmail(); ?>">                
                     </div>

                     
                     <div class="form-group">                
                          <label for="address">Address :</label> 
                          <input type="address" name="email" class="form-control" value="<?php echo $User->getAddress(); ?>">                
                     </div>

                     <a href="view.userprofile.php?edit=<?php echo $User->getID(); ?>" onclick="return confirm('Are You Sure to Edit !'); ">
                       <button type="button" class="btn btn-primary" >Edit Profile</button></a>          
              </form>
              
              <?php
            }
              }
                else{
                 echo $Result->getResultObject(); //giving failure message
                }
              }
                  ?>
      
    </div>
    <div class="col-xs-1"></div>
    </div>
    
  </div>
<?php include 'footer.php';  ?>