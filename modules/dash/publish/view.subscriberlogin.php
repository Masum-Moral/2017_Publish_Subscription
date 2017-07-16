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
    <title>Subscriber LogIn Operations</title>
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
            <select name="category" id="cat" style="width:170px"> </select>
          
        </td>
        <td>
            <p>Select SubCategory</p>
            <select name="institution" id="subcat" style="width:170px"> </select>
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
          
        <tr style="padding-left: 150px;">
          <td style="text-align: center;">
              <button type="submit" name="log_in">Log In</button>
             
          </td>
        </tr>
      </table>
    </form>

<br />

  </div>
</center>
</body>
</html>