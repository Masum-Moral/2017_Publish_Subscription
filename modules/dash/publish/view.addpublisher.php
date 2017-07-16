<?php 
/*$output = NULL;

if (isset($_POST['submit'])) {
  $db = new mysqli('localhost','root','','publish_subscription');
  $search = $db->real_escape_string($_POST['search']);
  if (empty($search)) {
    //header("Location:home.php");
  }else{
  $Result = $db->query("SELECT * FROM tbl_institution WHERE Name LIKE '%$search%'");
  if ($Result->num_rows>0) {
    while ($rows = $Result->fetch_assoc()) {

      $name = $rows['Name'];
      $id = $rows['ID'];
      
      $output .= "$name <br />";
      echo "<a href='view.addpublisher.php?id=$id'>$name</a><br />";
      
    }
  }else{
    $output = "no result";
  }
}
}*/
?>
<?php  

include_once '/../../common/class.common.php';
include_once 'blade/view.addpublisher.blade.php';
include_once 'blade/view.institution.blade.php';
include_once 'blade/view.subcategory.blade.php';

ob_start();

if (session_status() == PHP_SESSION_NONE) {
  session_start();

  $ID  =  $_SESSION['globalUser']->getID();
 // echo $ID;
}
else
{
  $ID  =  $_SESSION['globalUser']->getID();
 // echo $ID;
}

?>
<?php 
   if (isset($_GET['InstituteId'])) {
      $Ins_ID = $_GET['InstituteId'];
      echo $Ins_ID;
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
   <!-- <div class="jumbotron text-center">
       <div><h2>Publisher Page</h2></div>
    </div>
   <form class="form" method="post">
      <div class="form-group">
         <lebel for="email">Email :</lebel>
         <input type="email" class="form-control" name="email" placeholder="Email">
      </div>
      <a href='view.institution.php?phone=0001112222'>click</a> -->    
   </form>
   <div class="row">
     <div class="col-sm-4">
     <div style="background: #F5F6F7;height: 600px;padding: 20px">
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
    </div>
    
    <div class="col-sm-5" >
    <div style="background: #F5F6F7;height: 600px;padding: 20px">
    <?php 
        if (isset($_POST['sav'])) { 
            echo $msg;
             }
           ?>
    <label style="color: #286090;font-size: 20px">Search Institution to be a Publisher</label>
                <form  method="post" >
                  <div class="nav navbar-nav " style="padding: 10px; " >
                      <div class="input-group">
                          <input type="text" class="form-control" name="search" placeholder="Search Institution"/>
                           <div class="input-group-btn">
                              <button class="btn btn-default" type="submit" name="submit" style="padding: 9px"><i class="glyphicon glyphicon-search"></i></button>
                           </div>
                      </div>
                  </div>
                </form>
               <?php 
                    $output = NULL;

                    if (isset($_POST['submit'])) {
                      $db = new mysqli('localhost','root','','publish_subscription');
                      $search = $db->real_escape_string($_POST['search']);
                      if (empty($search)) {
                        //header("Location:home.php");
                      }else{
                      $Result = $db->query("SELECT * FROM tbl_institution WHERE Name LIKE '%$search%'");
                      if ($Result->num_rows>0) {
                        while ($rows = $Result->fetch_assoc()) {

                          $name = $rows['Name'];
                          $id = $rows['ID'];
                          
                          $output .= "$name <br />";
                          echo "<a href='view.addpublisher.php?id=$id'>$name</a><br />";
                          
                        }
                      }else{
                        $output = "no result";
                      }
                    }
                    }
              ?>

              <?php 
                  if (isset($_GET['id'])) {
                  
               ?>
      <form class="form" method="post" style="padding-top: 100px">
        <label style="color: #286090;font-size: 20px">Which Category you want to be a Publisher</label>
            <select name="catid" class="form-control" >
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
            </select></br>
              <button type="submit" class="btn btn-sm btn-info" name="sav">save</button>
      </form>
      <?php } ?>
    
   </div>
   </div>
    <div class="col-sm-3">
    <div style="background: #F5F6F7;height: 600px;padding: 20px">
     <button class="btn btn-info" type="button" style="width: 220px;">Creat Notice</span></button></br>
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
      <!--<div class="container">
          <h2>Dropdowns</h2>                                          
          <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Dropdown Example
            <span class="caret"></span></button>
            <ul class="dropdown-menu">
              <li><a href="#">HTML</a></li>
              <li><a href="#">CSS</a></li>
              <li><a href="#">JavaScript</a></li>
            </ul>
          </div>
      </div>-->
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