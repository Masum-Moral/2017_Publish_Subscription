<?php 
/*$login = Session::get("login");
if (isset($login) != true) {
  header("Location:home.php");
}*/
?>
<?php 


/*mysql_connect("localhost","root","");
mysql_select_db("publish_subscription");
  //$db = new mysqli('localhost','root','','publish_subscription');
  $search = mysql_real_escape_string(trim($_POST['search']));
  $Result = mysql_query("SELECT * FROM tbl_institution WHERE Name LIKE '%$search%'");
  while ($rows = mysql_fetch_assoc($Result)) {
    $Name = $rows['Name'];
    $id = $rows['ID'];
    echo "<a href='view.addpublisher.php?id=$id'>$Name</a><br />";
  }*/

?>
<?php  
include_once 'blade/view.institution.blade.php';
include_once 'blade/view.subcategory.blade.php';
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
<?php 
    $loginmsg = Session::get("loginmsg");
    if (isset($loginmsg)) {
      echo $loginmsg;
    }
    Session::set("loginmsg",NULL);
 ?>

<?php include 'header.php'; ?>
  <div class="container">
    <!--<div class="jumbotron text-center">
       <div><h2>Home Page</h2></div>
    </div>-->
   <form class="form" method="post">
      
   </form>
   <div class="row">
   <div class="col-sm-4" >
   
   <h5><a href="view.institution.php">Creat Institution</a></h5>
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
     
        <label style="color: #286090;font-size: 20px">Which Institution you want to be a Subscriber</label>
                 <form  method="post">
                  <div class="nav navbar-nav " style="padding: 10px;" >
                      <div class="input-group">
                          <input type="text" class="form-control" name="search" placeholder="Search Institution"/>
                           <div class="input-group-btn">
                              <button class="btn btn-default" type="submit" style="padding: 9px" name="submit"><i class="glyphicon glyphicon-search"></i></button>
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
                        echo "<a href='view.addsubscriber.php?id=$id'>$name</a><br />";
                        
                      }
                    }else{
                      $output = "no result";
                    }
                  }
                  }
                ?>
               
      
              
        <?php 
            /*  $Result = $_InstitutionBAO->getAllInstitution();
              if($Result->getIsSuccess()){

                $InstitutionList = $Result->getResultObject();
                for ($i = 0; $i<sizeof($InstitutionList); $i++){
                    $Institution = $InstitutionList[$i];
                   // echo $Subcategory->getName();?>
                <li><a href='view.addpublisher.php?InstituteId=<?php echo $Institution->getID();?>'><?php echo $Institution->getName();?></a></li>
                  <?php 
                  }     
                }*/

            ?>
              
             
        
   

  
    <!--<h4>Which Institution you want to be a Subscriber </h4>-->
    <div class="dropdown">
    
          <!--<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Institute Name
          <span class="caret"></span></button>
          <ul class="dropdown-menu">-->
           <?php 
          $Result = $_InstitutionBAO->getAllInstitution();
          if($Result->getIsSuccess()){

            $InstitutionList = $Result->getResultObject();
            for ($i = 0; $i<sizeof($InstitutionList); $i++){
                $Institution = $InstitutionList[$i];
               // echo $Subcategory->getName();?>
            <li><a href='view.addsubscriber.php?InstituteId=<?php echo $Institution->getID();?>'><?php echo $Institution->getName();?></a></li>
              <?php 
              }     
            }

        ?>
          <!--</ul>-->
         
    </div>
    <br /><br />
    
       <!-- <h2 align="center">Make Treeview</h2>
        <br /><br />
       <div id="treeview"></div>-->
   
       
  </div>
    <div class="col-sm-3">
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
      <button class="btn btn-info" type="button" style="width: 250px">Notice</button>
            <div class="dropdown">
        
              <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" style="width: 250px">Select Category
              <span class="caret"></span></button>
              <ul class="dropdown-menu" style="width: 250px;">
               <?php 
               $Result = $_SubcategoryBAO->getSubscriberSubcategory($ID);
                  if($Result->getIsSuccess()){

                  $SubcategoryList = $Result->getResultObject();
                for ($i = 0; $i<sizeof($SubcategoryList); $i++){
                    $Subcategory = $SubcategoryList[$i];
                    ?>
                <li><a href='view.notice.php?CatId=<?php echo $Subcategory->getCatID();?>'><?php echo $Subcategory->getName();?></a></li>
                  <?php 
                  }     
                }
                  ?>
              </ul>       
           </div>
    </div>

  </div>
  </div>

<?php include 'footer.php';  ?>


<script>
  $(document).ready(function(){
    $.ajax({
      url:"tree.php",
      method:"POST",
      dataType:"json",
      success:function(data)
      {
        $('#treeview').treeview({data:data});
      }
    })
  });
</script>