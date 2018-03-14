<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$email		= $_POST['email'];
	$password	= md5($_POST['password']);

	$sql = "SELECT email, password FROM member WHERE email = '$email' AND password = '$password'";
	$result = $connexion->query($sql);

	if ($result->num_rows == 1) {
		if (isset($_POST['remember'])) {
			setcookie('email', $email, time() + 86400);
		}

		$_SESSION['email'] = $email;

		redirect("index.php");
		exit;
	} else {
		set_message('<div class="alert alert-warning" role="alert" col-md-12"><p> username ou Mot de passe errone.</p></div>');
	}
}
?>