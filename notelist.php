<?php

  header('Content-type: text/xml');
  $res = "<root>";

  include_once("docs/database/db_conn.php");
  $notes = array();
	$query = "SELECT * FROM notes";
	$result = $conn->query($query);


		while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
			$noteID = $row['noteID'];
			$dateCreated = $row['dateCreated'];
			$lastEdited = $row['lastEdited'];
			$message = $row['message'];

       

          $res .= " <note>
          <noteid>" . $noteID . "
          </noteid>
          <dateCreated>" . $dateCreated . "</dateCreated>
          <lastEdited>" . $lastEdited . "</lastEdited>
          <message>" . $message . "</message>
      
          
        </note>
      
          ";
		}


  
  $res .= "</root>";
  echo $res;

?>

