<?php
require 'vendor/autoload.php';

include("docs/database/db_conn.php");

//If there is any received error message 
if (isset($_GET['error'])) {
	$errormessage = $_GET['error'];
	//show error message using javascript alert
	// echo "<script>alert('$errormessage');</script>";
	echo 
		"<div style='text-align: center'>
			<span style='color: red'>$errormessage</span>
		</div>";
}

function display_notes()
{
	// need to change the ip and port
	$ip="localhost";
	$port="";
	$url="MITM/notelist.php";
	$query="";

	try {
	
		$client = new GuzzleHttp\Client(['verify' => false]);
		$response = $client->request('GET', 'http://'.$ip.":".$port. "/".$url. "?" . $query);

		//If all right then display the form
		if ($response->getStatusCode() == 200) {
			$xml = simplexml_load_string($response->getBody());
            foreach ($xml->note as $n) {
               			echo "
					<div class='row ml-4 pl-4'>
						<div class='row' style='border:2px solid grey;border-radius:5px'>
							<h4>" . $n->dateCreated . "</h4>
						</div>
						<div class='row'>
							<p>" . $n->message . "</p>
						</div>
					</div>
				";
            }
		} else {
			echo "Error : " . $response->getStatusCode();
		}
	} catch (Exception $e) {
		echo "Error [RES]: \n";
		echo "<pre>";
		print_r($e);
		echo "</pre>";
	}
}

//USE CASE 
?>

<!doctype html>
<html lang="en-GB">
	<head>
		<title>Notable - A free online notes app</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="A free online notes application.">
		
		<!-- Import Latest CSS -->
		<link  rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css">
		<!-- JavaScript Bundle with Popper -->
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
		<!-- Import jQuery -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<!-- Icon library -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
	</head>
	
	<body>
		<!-- Main Body -->
		<div class="container-fluid homepage-body mb-0" style="height:100vh">
			<div class=row>
				<div class="col-2 align-self-center">
				</div>
				<div class="col-8 align-self-center">
					<h3 class="display-3" style="text-align:center">Welcome to Notable!</h3>
				</div>
				<div class="col-2 align-self-right pt-3">
					<form method="post" name="clear-form" action="clear_db.php" class="clear-form" id="clear-form">
						<input type="submit" class="btn btn-outline-secondary" value="Clear" formaction="docs/clear_db.php">
					</form>
				</div>
				<div class="row px-5">
					<form method="post" name="note-form" action="new_note.php" class="note-form" id="note-form">
						<span id="error-message" style="color: red; display: none">Please fill out this field</span>
						<div class="form-floating">
							<textarea class="form-control" id="message" name="message" rows="3" required></textarea>
							<label for="message">New note</label>
						</div>
						<div class="row my-3">
							<input type="submit" class="btn btn-primary" value="Save (UC01)" formaction="docs/new_note.php">
						</div>
						<div class="row my-3">
							<input type="button" onclick="submitLatency()" class="btn btn-success" value="Save and check latency (UC02)">
						</div>
						<div class="row my-3">
							<input type="submit" class="btn btn-info" value="Save with hash (UC05)" formaction="docs/new_note_hash.php">
						</div>
					</form>
					<form method="post" name="note-form-latency" action="docs/new_note_latency.php" class="note-form-latency" id="note-form-latency">
						<input name="time" id="time" hidden>
						<input name="message-copy" id="message-copy" hidden>
					</form>
				</div>
				<div class="row px-5 mt-5">
					<?php display_notes(); ?>
				</div>
			</div>
		</div>
	</div>
	<!-- JavaScript Linking -->
	<script src="scripts/script.js"></script>
</body>

</html>