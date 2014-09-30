<?php 
//title of page
$title = 'Calendar'; 
//header shown
include('header1.php');
?><html>
<head>  
<!--Linking to css stylesheet for calendar display-->
<link href="calendar.css" type="text/css" rel="stylesheet" />
</head>
<body>
<?php
//calendar is shown
include 'calendar.php';
 
$calendar = new Calendar();
 
echo $calendar->show();

//footer shown
include('footer1.php'); 

?>
</body>
</html>  
