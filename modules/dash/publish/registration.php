<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Publish_Subscription</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  <nav class="navbar navbar-default navbar-fixed-top">    
     <div class="container" >
        <a class="navbar-brand" href="#">Publisher_Subscription</a>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav navbar-right">
            
             <li class="active"><a href="#">Home</a></li>
             <li class="#"><a href="#">About</a></li>
             <li class="dropdown">
                   <a href="#" class="dropdown-toggle" data-toggle="dropdown">Learn<b class="caret"></b>
                      <ul class="dropdown-menu">
                        <li class="dropdown-header">All Option</li>
                        <li><a href="#">Creat Institution</a></li>
                        
                      </ul>
                   </a>
              </li>
          </ul>
        </div>  
      </div>

  </nav>

      <div class="container">
    
        <form role="form" method="post">
           <h2 style="color: #286090"  >Creat a new account</h2>
           
               <div class="form-group"> 
                  <label for="firstname">First Nmae :</label>        
                  <input type="text" name="firstname" class="form-control" placeholder="First Name">
               </div>

               <div class="form-group">
                  <label for="lastname">Last Name :</label>  
                  <input type="text" name="lastname" class="form-control" placeholder="Last Name">
               </div>

               <div class="form-group">
                  <label for="email">Email :</label>  
                  <input type="text" name="email" class="form-control" placeholder="Email">
               </div>

               <div class="form-group">
                  <label for="password">Password :</label> 
                  <input type="password" name="password" class="form-control" placeholder="Password">
               </div>

               <div class="form-group">
                  <label for="address">Address :</label>
                  <input type="text" name="address" class="form-control" placeholder="Address">
               </div>

               <button type="button" name="save" class="btn btn-success">Creat Account</button>
             
          
        </form>
        <?php 
           echo date("d/m/Y");
           echo date("l");
         ?>
        
       <!-- <div class="col-sm-3">
            <form class="" role="form" action="post">
                 <h2 style="color: #286090"  >Log in</h2>
                 <table>
                     <div class="form-group">            
                        <input type="text" name="email" class="form-control" placeholder="Email">
                     </div>

                     <div class="form-group">           
                        <input type="password" name="password" class="form-control" placeholder="Password">
                     </div>
                      <a href="">Forgotten password?</a><br>
                     <button type="button" name="#" class="btn btn-primary">Log in</button>
                   
                 </table>
            </form>
        </div>-->

  </div>
  <div class="navbar navbar-inverse navbar-fixed-bottom">
    <div class="container">
      <div class="navbar-text pull-left">
         <p>@Copyright Publish-Subscription-network 2017</p>
      </div>
    </div>
  </div>
      <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
