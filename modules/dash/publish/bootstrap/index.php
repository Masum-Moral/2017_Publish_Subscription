<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  <nav class="navbar navbar-default navbar-fixed-top">
    
  <div class="container">
    <button type="button" class="navbar-toggle"
      data-toggle="collapse" 
      data-target=".navbar-collapse">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="#">Personal Website</a>
    <div class="collapse navbar-collapse">
    <ul class="nav navbar-nav navbar-right">
             <li class="active"><a href="#">Home</a></li>
             <li class="#"><a href="#">About</a></li>
        <li class="dropdown">
             <a href="#" class="dropdown-toggle" data-toggle="dropdown">Learn<b class="caret"></b>
                <ul class="dropdown-menu">
                  <li class="dropdown-header">Example</li>
                  <li><a href="#">C++</a></li>
                  <li><a href="#">Java</a></li>
                  <li><a href="#">Php</a></li>
                  
                   <li class="dropdown-header">Tutorial</li>
                  <li><a href="#">C#</a></li>
                  <li><a href="#">Python</a></li>
                  <li><a href="#">Ruby</a></li>
                </ul>
             </a>
        </li>

    </ul>
    </div>
  </div>
  /*
    <!--
    <div class="navbar navbar-static">
    <div class="navbar-inner">
        <a href="#" class="brand">Brand</a>
        <ul role="navigation" class="nav">
            <li><a href="#">Home</a></li>
            <li><a href="#">Profile</a></li>
            <li class="dropdown">
                <a href="#" data-toggle="dropdown" class="dropdown-toggle">Messages <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li><a href="#">Inbox</a></li>
                    <li><a href="#">Drafts</a></li>
                    <li><a href="#">Sent Items</a></li>
                    <li class="divider"></li>
                    <li><a href="#">Trash</a></li>
                </ul>
            </li>
        </ul>
        <ul class="nav pull-right">
            <li class="dropdown">
                <a href="#" data-toggle="dropdown" class="dropdown-toggle">Admin <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li class="divider"></li>
                    <li><a href="#">Settings</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>!-->
  
  </nav>
   
  <div class="container">
    <div class="jumbotron text-center">
       <div><h2>Category Form</h2></div>
    </div>
   <form class="form">
      <div class="form-group">
         <lebel for="email">Email :</lebel>
         <input type="email" class="form-control" name="email" placeholder="Email">
      </div>     
   </form>
  </div>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>