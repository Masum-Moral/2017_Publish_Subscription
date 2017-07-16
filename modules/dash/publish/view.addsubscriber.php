<?php  

include_once '/../../common/class.common.php';
//include_once 'blade/view.addsubscriber.blade.php';
include_once 'blade/view.request.blade.php';
include_once 'blade/view.institution.blade.php';
include_once 'blade/view.subcategory.blade.php';

ob_start();

if (session_status() == PHP_SESSION_NONE) {
  session_start();

  $ID  =  $_SESSION['globalUser']->getID();
  echo $ID;
}
else
{
  $ID  =  $_SESSION['globalUser']->getID();
  echo $ID;
}

?>
<?php 
   if (isset($_GET['InstituteId'])) {
      $Ins_ID = $_GET['InstituteId'];
      //echo $Ins_ID;
  }
 ?>
 <?php 
   if (isset($_GET['id'])) {
      $Ins_ID = $_GET['id'];
     // echo $Ins_ID;
  }
 ?>
<?php include 'header.php';?>
   
  <div class="container">
    <!--<div class="jumbotron text-center">
       <div><h2>Publisher Page</h2></div>
    </div>-->
   <form class="form" method="post">
      <!--<div class="form-group">
         <lebel for="email">Email :</lebel>
         <input type="email" class="form-control" name="email" placeholder="Email">
      </div>
      <a href='view.institution.php?phone=0001112222'>click</a> -->    
   </form>
   <div class="row">
     <div class="col-sm-4">
    <h4>My Institution</h4>
        <?php 
          $Result = $_InstitutionBAO->getInstitution($ID);
          if($Result->getIsSuccess()){

            $InstitutionList = $Result->getResultObject();
            for ($i = 0; $i<sizeof($InstitutionList); $i++){
                $Institution = $InstitutionList[$i];
               // echo $Subcategory->getName();?>
                <a href='view.subcategory.php?InstituteId=<?php echo $Institution->getID();?>'><?php echo $Institution->getName();?></a><br>

        <?php 
              }     
            }
        ?>
    </div>
    <div class="col-sm-5">
      <form class="form" method="post">
        <label style="color: #286090;">Which Category you want to be a Subscriber</label>
            <select name="catid" class="form-control">
            <?php 
                  $Result = $_SubcategoryBAO->getInstituteSubcategory($Ins_ID);
                  if($Result->getIsSuccess()){

                  $SubcategoryList = $Result->getResultObject();
                  for ($i = 0; $i<sizeof($SubcategoryList); $i++){
                      $Subcategory = $SubcategoryList[$i];
              ?>
                <option value="<?php echo $Subcategory->getCatID();?>"><?php echo $Subcategory->getName();?></option>
                 <?php 
                 }     
               }
               ?>
            </select> </br>
              <button type="submit" class="btn btn-sm btn-info" name="request">Request Sent</button>
           
      </form>
    
   </div>
   <div class="col-sm-3">

   </div>
  </div>
  </div>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
<?php include 'footer.php';?>