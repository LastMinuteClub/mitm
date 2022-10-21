<?php

  header('Content-type: text/xml');
  $res = "<root>";

  include_once("docs/database/db_conn.php"); //Get database connection
  $notes = array(); //Create array
	$query = "SELECT * FROM notes"; //Query for database
	$result = $conn->query($query); //Get notes from database


		while ($row = $result->fetch_array(MYSQLI_ASSOC)) { //Loop through notes from database
			$noteID = $row['noteID'];
			$dateCreated = $row['dateCreated']; //Assign database variables to php variables
			$lastEdited = $row['lastEdited'];
			$message = $row['message'];

       
          //Form html element with variables
          $res .= " <note>
          <noteid>" . $noteID . "
          </noteid>
          <dateCreated>" . $dateCreated . "</dateCreated>
          <lastEdited>" . $lastEdited . "</lastEdited>
          <message>" . $message . "</message>
      
          
        </note>
      
          ";
		}


  
  $res .= "</root>"; //Add to end of html element
  echo $res; //Echo element result

?>

