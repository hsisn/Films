<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$first_name				= $_POST['first_name'];
	$last_name				= $_POST['last_name'];
	$display_name                           = $_POST['display_name'];
	$email					= $_POST['email'];
	$password				= md5($_POST['password']);
	$confirm_password                       = $_POST['confirm_password'];

	$errors = [];

	if (email_exists($email))
	{
		$errors[] = "$email deja enregistrer.";
	}

	if (!empty($errors)) {
		foreach ($errors as $error) {
			validation_errors($error);
		}
	}else{
		$sql = "INSERT INTO member (first_name, last_name, display_name, email, password, date_added)
		VALUES ('$first_name', '$last_name', '$display_name', '$email', '$password', now())";
                  $_SESSION["uid"] = mysqli_insert_id($connexion);
		if ($connexion->query($sql) === TRUE) {
                    $_SESSION["email"]=$email;
			redirect("index.php");
			exit;

		} else {
			set_message("<p>Error: " . $sql . "<br>" . $connexion->error . "</p>");
		}

		$connexion->close();
	}
}
?>