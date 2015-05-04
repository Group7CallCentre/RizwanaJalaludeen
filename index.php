
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>School Leavers</title>
<link rel="stylesheet" type="text/css" href="style.css" />
<script src="jquery.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.3/jquery.min.js"></script>
<script type="text/javascript" src="pagination.js"></script>
<link rel="stylesheet" type="text/css" href="css/normalize.css" />
<link rel="stylesheet" type="text/css" href="css/component.css" />
<link rel="stylesheet" type="text/css" href="css/content.css" />
<script src="js/modernizr.custom.js"></script>		

</head>
 
<body>
<?php
include("../include/session.php");
if($session->logged_in){
   
   echo "[<a href=\"..\process.php\">Logout</a>]";
}
else{

if($form->num_errors > 0){
   echo "<font size=\"2\" color=\"#ff0000\">".$form->num_errors." error(s) found</font>";
}
}
?>
    <div id="formDiv">
	      <form id="formSearch" >
            Search by Name <input type="text" id="fieldSearch" name="search_text" >
	        <input type="submit" value="Search">
		  </form>
	   <div  id="divLoading"></div> 
       <div id="selectDiv">
         <small>
          <select id="pageRecord">
            <option value="1">1</option>
            <option value="2">2</option>
            <option selected value="3">3</option>
            <option value="4">4</option>
          </select><i> Record per Page</i>
         </small>
      </div>
	 </div>
	  
	<div  id="divPageData"></div>
</body>
</html>