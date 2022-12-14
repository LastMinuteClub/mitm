<?php
require 'vendor/autoload.php';
include("docs/database/db_conn.php");
include("docs/session/session.php");
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
	$ip = "localhost";
	$port = "";
	$url = "MITM/notelist.php";
	$query = "";

	try {

		$client = new GuzzleHttp\Client(['verify' => false]);
		$response = $client->request('GET', 'http://' . $ip . ":" . $port . "/" . $url . "?" . $query);

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

//Encrypts data with public key
function public_key_encrypt($data, $public_key)
{
	openssl_public_encrypt($data, $encrypted_data, $public_key);
	return $encrypted_data;
}

//Hashes message using SHA256 algo
function hash_message($data)
{
	return hash("sha256", $data);
}

if (isset($_POST['uc03'])) { //Detects when button it pressed
	$data = htmlspecialchars($_POST['message']); //Get message
	$letter = substr($data, -1); //Get last letter
	$client = new GuzzleHttp\Client(['verify' => false]);
	$response = $client->request('POST', 'http://' . "localhost" . ":" . "" . "/" . "MITM/docs/packet_inspection.php" . "?" . "", [ //Send request to backend with
		'form_params' => [																											//required data
			'data' => $data,
			'secure' => $letter,
		]
	]);
	unset($_POST['uc04']); //Unset button variable
	header("Location: homepage.php"); //Redirect to homepage
}
if (isset($_POST['uc04'])) { //Detects when button it pressed
	$data = htmlspecialchars($_POST['message']); //Get message
	$key = $server_pub_key; //Get public key of server
	$encrypted_data = public_key_encrypt($data, $key); //Encrypt message
	$encrypted_data = base64_encode($encrypted_data); //Encode encrypted message in base64
	$client = new GuzzleHttp\Client(['verify' => false]);
	$response = $client->request('POST', 'http://' . "localhost" . ":" . "" . "/" . "MITM/docs/new_note_encrypted.php" . "?" . "", [
		'form_params' => [						//Send request to backend with required data
			'data' => $encrypted_data,
		]
	]);
	unset($_POST['uc04']); //Unset button variable
	header("Location: homepage.php"); //Redirect to homepage
}
if (isset($_POST['uc05'])) { //Detects when button it pressed
	$data = htmlspecialchars($_POST['message']); //Get message
	$hashed = hash_message($data); //Get hash of message
	$key = $server_pub_key; //Get public key of server
	$encrypted_data = public_key_encrypt($data, $key); //Encrypt message
	$encrypted_data = base64_encode($encrypted_data); //Encode encrypted message in base64
	$client = new GuzzleHttp\Client(['verify' => false]);
	$response = $client->request('POST', 'http://' . "localhost" . ":" . "" . "/" . "MITM/docs/new_note_encrypted_with_hash.php" . "?" . "", [
		'form_params' => [ 						//Send request to backend with required data
			'data' => $encrypted_data,
			'hash' => $hashed,
		]
	]);
	unset($_POST['uc05']); //Unset button variable
	header("Location: homepage.php"); //Redirect to homepage
}
if (isset($_POST['uc06'])) { //Detects when button it pressed
	$data = htmlspecialchars($_POST['message']); //Get message
	$hashed = hash_message($data); //Get hash of message
	$letter = substr($data, -1); //Get last letter
	$key = $server_pub_key; //Get public key of server
	$encrypted_data = public_key_encrypt($data, $key); //Encrypt message
	$encrypted_data = base64_encode($encrypted_data); //Encode encrypted message in base64
	$client = new GuzzleHttp\Client(['verify' => false]);
	$response = $client->request('POST', 'http://' . "localhost" . ":" . "" . "/" . "MITM/docs/new_note_all_use_cases.php" . "?" . "", [
		'form_params' => [						//Send request to backend with required data
			'data' => $encrypted_data,
			'hash' => $hashed,
			'secure' => $letter,
		]
	]);
	unset($_POST['uc06']); //Unset button variable
	header("Location: homepage.php"); //Redirect to homepage
}
?>

<!doctype html>
<html lang="en-GB">

<head>
	<title>Notable - A free online notes app</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="A free online notes application.">

	<!-- Import Latest CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css">
	<!-- JavaScript Bundle with Popper -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
	<!-- Import jQuery -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<!-- Icon library -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

	<script type=text/javascript>
		//Hash function
		function hash(string) {
			const utf8 = new TextEncoder().encode(string);
			console.log("utf8");
			console.log(utf8);
			return crypto.subtle.digest('SHA-256', utf8).then((hashBuffer) => {
				const hashArray = Array.from(new Uint8Array(hashBuffer));
				const hashHex = hashArray
					.map((bytes) => bytes.toString(16).padStart(2, '0'))
					.join('');
				return hashHex;
			});
		}
		/*The function strToArrayBuffer converts string to fixed-length raw binary data buffer because 
		encrypt method must return a Promise that fulfills with an ArrayBuffer containing the "ciphertext"*/
		function strToArrayBuffer(str) {
			var buf = new ArrayBuffer(str.length * 2);
			var bufView = new Uint16Array(buf);
			for (var i = 0, strLen = str.length; i < strLen; i++) {
				bufView[i] = str.charCodeAt(i);
			}
			return buf;
		}
		//The function arrayBufferToString converts fixed-length raw binary data buffer to 16-bit unsigned String as our plaintext
		function arrayBufferToString(buf) {
			return String.fromCharCode.apply(null, new Uint16Array(buf));
		}
		//This will generate random values of 8-bit unsigned integer
		var iv = "";

		function encrypt_with_js() {

			if (localStorage.getItem('key') == "yes") {
				iv = strToArrayBuffer(localStorage.getItem('iv'));
				console.log(iv);
			} else {
				iv = window.crypto.getRandomValues(new Uint8Array(12));
				localStorage.setItem('iv', arrayBufferToString(iv));
				localStorage.setItem('key', "yes");
				console.log("fff");
			}

			//This object will generate our encryption algorithm
			var algoEncrypt = {
				name: "AES-GCM",
				iv: iv,
				tagLength: 128,
			};
			console.log("iv now is ");
			console.log(iv);
			var cyper;
			$(document).ready(function() {
						$("form#note-form").submit(function() {
							// we want to store the values from the form input box, then send via ajax below  
							var plainText = $('#message').val();


							//This object below will generate our algorithm key
							var algoKeyGen = {
								name: "AES-GCM",
								length: 256,
							};


							//states that key usage is for encryption
							var keyUsages = ["encrypt", "decrypt"];
							// var plainText = "This is a secure message from Mary";
							var secretKey;

							var encodemsg = "";
							//This generates our secret Key with key generation algorithm
							window.crypto.subtle
								.generateKey(algoKeyGen, false, keyUsages)
								.then(function(key) {
									secretKey = key;
									//Encrypt plaintext with key and algorithm converting the plaintext to ArrayBuffer
									return window.crypto.subtle.encrypt(
										algoEncrypt,
										key,
										strToArrayBuffer(plainText)
									);
								})
								.then(function(cipherText) {
									//print out Ciphertext in console
									encodemsg = arrayBufferToString(cipherText)

									console.log("Cipher Text: " + encodemsg);
									console.log(cipherText);

									hash(plainText).then(function(hex) {
											console.log(hex)

											console.log(hex);
											console.log("digest");
											var postForm = { //Fetch form data
												'message': encodemsg, //Store name fields value
												'origin': plainText,
												'hash': hex

											};

											$.ajax({
												type: "POST",
												url: "newnotetest.php",
												data: postForm,
												success: function(response) {
													console.log(response);
													console.log("hah");
													// header("Location: homepage.php");

												},
												error: function(jqXHR, textStatus, errorThrown) {
													console.log(textStatus, errorThrown);

													console.log("vvvv");
													alert(errorThrown);
												}
											});

										}

									);


									return window.crypto.subtle.decrypt(algoEncrypt, secretKey, cipherText);
								})
								.then(function(plainText) {
									console.log("Plain Text: " + arrayBufferToString(plainText));
								})
								.catch(function(err) {
									console.log("Error: " + err.message);
								});

							var encodemsg = "";
							//This generates our secret Key with key generation algorithm
							window.crypto.subtle
								.generateKey(algoKeyGen, false, keyUsages)
								.then(function(key) {
									secretKey = key;
									//Encrypt plaintext with key and algorithm converting the plaintext to ArrayBuffer
									return window.crypto.subtle.encrypt(
										algoEncrypt,
										key,
										strToArrayBuffer(plainText)
									);
								})
								.then(function(cipherText) {
									//print out Ciphertext in console
									encodemsg = arrayBufferToString(cipherText)

									console.log("Cipher Text: " + encodemsg);
									console.log(cipherText);

									hash(plainText).then(function(hex) {
											console.log(hex)

											console.log(hex);
											console.log("digest");
											var postForm = { //Fetch form data
												'message': encodemsg, //Store name fields value
												'origin': plainText,
												'hash': hex

											};

											$.ajax({
												type: "POST",
												url: "docs/newnotetest.php",
												data: postForm,
												success: function(response) {
													console.log(response);
													console.log("hah");
													// header("Location: homepage.php");

												},
												error: function(jqXHR, textStatus, errorThrown) {
													console.log(textStatus, errorThrown);

													console.log("vvvv");
													alert(errorThrown);
												}
											});

										}

									);


									return window.crypto.subtle.decrypt(algoEncrypt, secretKey, cipherText);
								})
								.then(function(plainText) {
									console.log("Plain Text: " + arrayBufferToString(plainText));
								})
								.catch(function(err) {
									console.log("Error: " + err.message);
								});


							// return false;
							<?php header("Location: homepage.php"); ?>
						});
					};
				}

						//Syntax for encrypt function
						// const result = crypto.subtle.encrypt(algorithm, key, data);
						// const secure = window.crypto.getRandomValues(new Uint8Array(10));
						// console.log(secure);
						function decrypt(cipherText) {
							console.log("iv decrypt ");
							console.log(iv);
							algoEncrypt = {
								name: "AES-GCM",
								iv: iv,
								tagLength: 128,
							};
							//This states that the keyusage for decrypting
							var keyUsages = ["decrypt"];
							//This object below is for algorithm key generation
							var algoKeyGen = {
								name: "AES-GCM",
								length: 256,
							};
							var plainText = "This is a secure message from Mary";
							var secretKey;
							//This will generate secrete key with algorithm key and keyusage
							window.crypto.subtle
								.generateKey(algoKeyGen, false, keyUsages)
								.then(function(key) {
									secretKey = key;
									console.log(cipherText);
									//This will decrypt Cipheretext to plaintext
									return window.crypto.subtle.decrypt(algoEncrypt, secretKey, strToArrayBuffer(cipherText));
								})
								//  Print plaintext in console.
								.then(function(plainText) {

									console.log("Plain Text: " + arrayBufferToString(plainText));
									return plainText;
								})
								.catch(function(err) {
									console.log("Error: " + err);
								});
						}

						function resetPage() {

							localStorage.removeItem("key");
						}
	</script>

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
				<form method="post" name="note-form" class="note-form" id="note-form">
					<span id="error-message" style="color: red; display: none">Please fill out this field</span>
					<div class="form-floating">
						<textarea class="form-control" id="message" name="message" rows="3" required></textarea>
						<label for="message">New note</label>
					</div>
					<div class="row my-3">
						<input type="submit" class="btn btn-primary" value="Save (UC01)" formaction="docs/new_note.php">
					</div>
					<div class="row my-3">
						<input type="button" onClick="submitLatency()" name="uc07" class="btn btn-success" value="Save and check latency (UC02)">
					</div>
					<div class="row my-3">
						<input type="submit" name="uc03" class="btn btn-danger" value="Save with packet inspection (UC03)">
					</div>
					<div class="row my-3">
						<input type="submit" name="uc04" class="btn btn-warning" value="Save with encryption (UC04)">
					</div>
					<div class="row my-3">
						<input type="submit" name="uc05" class="btn btn-info" value="Save with encryption and hash checking (UC05)">
					</div>
					<div class="row my-3">
						<input type="submit" name="uc06" class="btn btn-secondary" value="All use cases combined">
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