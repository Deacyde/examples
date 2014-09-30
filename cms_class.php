<?php
//connects to DB via variables defined by page ( am learning about PDO but is slightly different, roughly the same but faster )
class modernCMS {
	var $host;
	var $username;
	var $password;
	var $db; 

	function connect() {
	$con = mysql_connect($this->host, $this->username, $this->password);
	mysql_select_db($this->db, $con) or die(mysql_error()); 
}
//Grabs info from the database to display, displays in descending order, allows for urls based on title id, for single page viewing of title and body inputs. If url is entered not matching what is in database as  a title ID returns error uh oh... 
	function get_content($id = '') {
		
		if($id != ""):
			$id = mysql_real_escape_string($id); 
			$sql = "SELECT * FROM CMS WHERE id = '$id'";
			
			$return = '<p><a href="index.php">Go Back To Content</a></p>';
		else:
			$sql = "SELECT * FROM CMS ORDER BY id DESC";
		endif;
	
		$res = mysql_query($sql) or die(mysql_error());
		
		if(mysql_num_rows($res) !=0):
			while($row = mysql_fetch_assoc($res)) {
				echo '<h1><a href="index.php?id=' . $row['id'] . '">' . $row['title'] . '</a></h1>';
				echo '<p>' . $row['body'] . '</p>';
	    }
		else:
			echo '<p>Uh Oh!, This is not found!</p>';
		endif;
		
		echo $return;
    }
//Allows user to add content based on user input via two sections, returns error if input fields are empty, returns Success msg if all goes without error.
	function add_content($p) {
		$title = mysql_real_escape_string($p['title']);
		$body = mysql_real_escape_string($p['body']);
		
	
		if(!$title || !$body):
		
			if(!$title):
				echo "<p>The Title Is Required</p>";
			endif;
			if(!$body): 
				echo "<p>The Body Is Required</p>";		
			endif;
			
			echo '<p><a href="add-content.php">Try Again!</a></p>';
		else:
			$sql = "INSERT INTO CMS VALUES (null, '$title', '$body')";
			$res = mysql_query($sql) or die(mysql_error());
			echo "Added Successfully!, View it<a href='http://deacyde.com/test/cms'> here</a>";
		endif;
}
} //Ends Our Class

?>

