<?php  

include_once '/../../common/class.common.php';
include_once 'blade/view.institution.blade.php';
include_once 'blade/view.subcategory.blade.php';
ob_start();

if (session_status() == PHP_SESSION_NONE) {
  session_start();

  $ID  =  $_SESSION['globalUser']->getID();

}
else
{
  $ID  =  $_SESSION['globalUser']->getID();
  echo $ID;
}
//session_start();
//$ID  =  $_SESSION['globalUser']->getID();
//echo $ID;
?>
<?php include 'header.php';?>
  <div class="container">
   <form class="form" method="post">
      <!--<div class="form-group">
         <lebel for="email">Email :</lebel>
         <input type="email" class="form-control" name="email" placeholder="Email">
      </div>
      <a href='view.institution.php?phone=0001112222'>click</a> -->    
   </form>
   <div class="row">
   <div class="col-sm-4">
    
    </div>
    <div class="col-sm-5">
        <h4>Which Category you want notice </h4>
        <div class="dropdown">
        
              <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Category Name
              <span class="caret"></span></button>
              <ul class="dropdown-menu">
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
    <div class="col-sm-3">
     
    </div>
    </div>

  </div>
  </div>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
<!--<?php //include 'footer.php';?>