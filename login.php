<?php
include("docs/database/db_conn.php");

$invalidLogin = false;
if (isset($_POST["username"]) && isset($_POST["password"])) {

  $username = $_POST['username'];
  $password = $_POST['password'];

  if (authenticate($username, $password) == false) {
    session_start();
    $_SESSION["userID"] = $username;
    header("Location:homepage.php");
  } else {
    $invalidLogin = true;
  }
}

function authenticate($user, $pass)
{
  global $conn;

  $db_func = $conn->prepare("SELECT password FROM user WHERE username=?");
  $db_func->bind_param('s', $user);
  $db_func->execute();
  $db_return = $db_func->get_result();
  $password_hash = $db_return->fetch_object();

  if ($db_return->num_rows > 0) {
    $check = password_verify($_POST['password'], $password_hash->password);
  } else {
    $check = false;
  }

  if ($check) {
    $conn->close();
    return false;
  } else {
    $conn->close();
    return true;
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
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
  <div id="wrapper" class="container-fluid homepage-body mb-0">
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
      <table>
        <div class="panel-fields">
          <label class="reg-label" for="username">Username: </label>
          <br>
          <input class="reg-input" type="text" id="username" name="username" required><br>
          <label class="reg-label" for="password">Password: </label>
          <br>
          <input class="reg-input" type="password" id="password" name="password" required><br><br>
          <input class="btn btn-primary" type="submit" id="login" name="login" value="LOGIN">
        </div>
      </table>
    </form>

    <?php
    if ($invalidLogin == true) {
      echo "<span style='color: red;'> <br> Invalid username or password. <br> Please try again.</span>";
    }
    ?>
  </div>
</body>

</html>