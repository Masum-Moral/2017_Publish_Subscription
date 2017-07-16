<?php

include_once '/common/class.common.php';

$_URI = $_SERVER['REQUEST_URI'];

$new_url = unparse_url(parse_url($_URI));

/*ob_start();

if (session_status() == PHP_SESSION_NONE) {
	session_start();
}*/

if(isset($new_url)){


	// including all the content of the component page in this index page
	include $new_url;
}

//finding different partse of an url
function unparse_url($parsed_url) { 
	$scheme   = isset($parsed_url['scheme']) ? $parsed_url['scheme'] . '://' : ''; 
	$host     = isset($parsed_url['host']) ? $parsed_url['host'] : ''; 
 	$port     = isset($parsed_url['port']) ? ':' . $parsed_url['port'] : ''; 
 	$user     = isset($parsed_url['user']) ? $parsed_url['user'] : ''; 
 	$pass     = isset($parsed_url['pass']) ? ':' . $parsed_url['pass']  : ''; 
 	$pass     = ($user || $pass) ? "$pass@" : ''; 
 	$path     = isset($parsed_url['path']) ? $parsed_url['path'] : ''; 
 	$query    = isset($parsed_url['query']) ? '?' . $parsed_url['query'] : ''; 
 	$fragment = isset($parsed_url['fragment']) ? '#' . $parsed_url['fragment'] : ''; 

 	//extracting the page name such as user.php from the url
 	$page = substr($path, strrpos($path,'/')+1,strrpos($path,'.php')-strrpos($path,'/')+strlen('.php'));

 	//looking for the extracted page in the route list

 	$new_page=RouteUtil::get($page);

 	//rebuilding the page
 	//$path=str_replace('/'.$page, $new_page, $path);

 	return $new_page;
	//return "$scheme$user$pass$host$port$path$query$fragment"; 
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

	    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	    <!--[if lt IE 9]>
	      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	    <![endif]-->
	  </head>
	  <body>
	  	<br /><br />
	  	<div class="container" style="width:  900px;">
	  		<h3 align="center">Making treview</h3>
	  		<br /><br />
	  		<div id="treeview"></div>
	  	</div>
	  </body>
 </html>
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