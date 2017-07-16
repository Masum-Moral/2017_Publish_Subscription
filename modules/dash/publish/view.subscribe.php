<?php

include_once 'blade/view.subscribe.blade.php';
include_once '/../../common/class.common.php';
  $db = new mysqli('localhost','root','','publish_subscription');
  $query = "SELECT ID,Name FROM tbl_category";
  $result = $db->query($query);

  while($row = $result->fetch_assoc()){
    $categories[] = array("id" => $row['ID'], "val" => $row['Name']);
  }

  $query = "SELECT ID, CategoryID, Institution FROM tbl_publisher";
  $result = $db->query($query);

  while($row = $result->fetch_assoc()){
    $subcats[$row['CategoryID']][] = array("id" => $row['Institution'], "val" => $row['Institution']);
  }

  $jsonCats = json_encode($categories);
  $jsonSubCats = json_encode($subcats);
  
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Subscriber CRUD Operations</title>
    <link rel="stylesheet" href="style.css" type="text/css" />

    <script type='text/javascript'>
      <?php
        echo "var categories = $jsonCats; \n";
        echo "var subcats = $jsonSubCats; \n";
      ?>
      function loadCategories(){
        var select = document.getElementById("cat");
        select.onchange = updateSubCats;
        for(var i = 0; i < categories.length; i++){
          select.options[i] = new Option(categories[i].val,categories[i].id);          
        }
      }
      function updateSubCats(){
        var catSelect = this;
        var catid = this.value;
        var subcatSelect = document.getElementById("subcat");
        subcatSelect.options.length = 0; //delete all options if any present
        for(var i = 0; i < subcats[catid].length; i++){
          subcatSelect.options[i] = new Option(subcats[catid][i].val,subcats[catid][i].id);
        }
      }
    </script>

  </head>

<body onload='loadCategories()'>
<center>
  <div id="header">
    <label>By : Kazi Masudul Alam</a></label>
  </div>

  <div id="form">
    <form method="post">
      <table width="100%" border="1" cellpadding="15" style="width: 500px">
        
        <tr>
        <td>
            <p>Select Category</p>
            <select name="category" id="cat" style="width:150px"> </select>
          
        </td>
        <td>
            <p>Select SubCategory</p>
            <select name="institution" id="subcat" style="width:150px"> </select>
          </td>
        </tr>
        <tr>
          
        </tr>
        <tr>
          <td>
              <p>Enter Username</p>
              <input type="text" name="username" placeholder="username" value="<?php 
              if(isset($_GET['edit'])) echo $globalUser->getFirstName();  ?>" />
          </td>

          <td>
               <p>Enter Password</p>
               <input type="password" name="password" placeholder="Password" value="<?php 
               if(isset($_GET['edit'])) echo $globalUser->getLastName();  ?>" />
          </td>
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

  <table width="100%" border="1" cellpadding="15" align="center" >
  <?php
  
  
  $Result = $_SubscribeBAO->getAllSubscriber();

  //if DAO access is successful to load all the users then show them one by one
  if($Result->getIsSuccess()){

    $SubscriberList = $Result->getResultObject();
  ?>
    <tr>
      <td>ID</td>
      <td>Category ID</td>
      <td>Institution</td>
      <td>Username</td>
      <td>Password</td>
    </tr>
    <?php
    for($i = 0; $i < sizeof($SubscriberList); $i++) {
      $Subscriber = $SubscriberList[$i];
      ?>
        <tr>
          <td><?php echo $Subscriber->getID(); ?></td>
          <td><?php echo $Subscriber->getCategory(); ?></td>
          <td><?php echo $Subscriber->getInstitution(); ?></td>
          <td><?php echo $Subscriber->getUsername(); ?></td>
          <td><?php echo $Subscriber->getPassword(); ?></td>
          <td><a href="?edit=<?php echo $Subscriber->getID(); ?>" onclick="return confirm('sure to edit !'); " >edit</a></td>
          <td><a href="?del=<?php echo $Subscriber->getID(); ?>" onclick="return confirm('sure to delete !'); " >delete</a></td>
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