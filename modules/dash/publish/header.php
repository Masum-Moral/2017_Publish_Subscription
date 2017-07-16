<?php 
ob_start();

if (session_status() == PHP_SESSION_NONE) {
  session_start();

 // $ID  =  $_SESSION['globalUser']->getID();
  $Name = $_SESSION['globalUser']->getFirstName();
 // echo $Name;

}
else
{
  $ID   =  $_SESSION['globalUser']->getID();
  $Name = $_SESSION['globalUser']->getFirstName();
  //echo $Name;
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Publish_Subscription</title>

    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap/css/custom.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-treeview/1.2.0/bootstrap-treeview.min.js"></script>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-treeview/1.2.0/bootstrap-treeview.min.css">
    <script src="jquery.js"></script>
    <script src="bootstrap-treeview.js"></script>
    <script src="bootstrap/css/select2-bootstrap.min.css"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <?php 
      if (isset($_GET['action']) && $_GET['action'] == "logout") {
        session_start();
        session_destroy();
        header("Location:view.user.php");
      }
  ?>
  <body>
  <nav class="navbar navbar-default navbar-fixed-top" >
    <div style="color: #ddd">
      <div class="container" style="color: #3D3D3B">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
      </button>
        <a class="navbar-brand" href="#">Personal Page</a>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav navbar-right">
             <li class="active"><a href="view.userprofile.php?profile=<?php echo $ID; ?>"><?php echo $Name;?></a></li>
             <li class="active"><a href="home.php">Home</a></li>
             <li class="#"><a href="view.userprofile.php?profile=<?php echo $ID; ?>">Profile</a></li>
             <li class="#"><a href="?action=logout">Logout</a></li>
             <li class="dropdown">
                   <a href="#" class="dropdown-toggle" data-toggle="dropdown">Learn<b class="caret"></b>
                      <ul class="dropdown-menu">
                        <li class="dropdown-header">All Option</li>
                        <li><a href="view.institution.php">Creat Institution</a></li>
                        <li><a href="view.addpublisher.php">Add Publisher</a></li>
                        <li><a href="home.php">Add Subscriber</a></li>
                        <li><a href="view.noticeselect.php">Show Notice</a></li>
                        <li><a href="view.request.php">Approval Interface</a></li>
                      </ul>
                   </a>
              </li>

          </ul>
        </div>  
      </div>
      </div>

  </nav>