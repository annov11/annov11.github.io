<!DOCTYPE html>
<html>
<head>
	<link rel="icon" href="../../favicon.png">
	<title>Login</title>
	<link href="../vendor/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<link rel="stylesheet"  href="../../css/login.css">

<!------ Include the above in your HEAD tag ---------->


</head>
<body>
	<?php 
	session_start();

	// if (isset($_SESSION["login"])) {
	// 	header("Location: database.php");
	// 	exit;
	// }
	require '../koneksi.php';

	if (isset($_POST["login"])) {
		
		$username = $_POST["username"];
		$password = $_POST["password"];

		$result = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$username'");


		// cek username
		if (mysqli_num_rows($result) === 1) {
			
			// cek password
			$row = mysqli_fetch_assoc($result);
			
			if (password_verify($password, $row["PASSWORD"]) ) {
				// set session
				$_SESSION["login"] = true;
				$_SESSION["id_user"] = $row["ID_USER"];
				$_SESSION["id_grup"] = $row["ID_GRUP_USER"];

				if ($row["ID_GRUP_USER"] == 1) {
					header("Location: ../login/tampil_tu.php");
				}
				if ($row["ID_GRUP_USER"] == 2) {
					header("Location: tampil_guru.php");
				}
				if ($row["ID_GRUP_USER"] == 3) {
					header("Location: tampil_ortu.php");
				}
				if ($row["ID_GRUP_USER"] == 4) {
					header("Location: tampil_siswa.php");
				}


			}
		}

		$error = true;

	}
		

	 ?>
	 <?php if (isset($error)) : ?>
		<div class="alert alert-danger" role="alert">
		  Username / Password Salah
		</div>
	<?php endif; ?>

	 <div class="wrapper fadeInDown">
  		<div id="formContent">
    <!-- Tabs Titles -->

    <!-- Icon -->
    <div class="fadeIn first">
      <img src="../../img/logo_sekolah.png" id="icon" alt="SMKN 1 DLANGGU" />
      <h1>SMKN 1 DLANGGU</h1>
    </div>

    <!-- Login Form -->
    <form action="" method="post">
      <input type="text" id="login" class="fadeIn second" name="username" placeholder="USERNAME">
      <input type="password" id="password" class="fadeIn third" name="password" placeholder="PASSWORD">
      <input type="submit" class="fadeIn fourth" name="login" value="Log In">
    </form>

    <!-- Remind Passowrd -->
  </div>
</div>



	
<script src="../vendor/js/bootstrap.min.js"></script>
<script src="../vendor/jquery/jquery.min.js"></script>
</body>
</html>