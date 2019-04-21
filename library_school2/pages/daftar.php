<!DOCTYPE html>
<html>
<head>
	<title>Login Pustakawan</title>

	<link rel="stylesheet" type="text/css" href="../style.css">
	<link rel="stylesheet" type="text/css" href="../css/fontawesome/css/all.css">
	<link rel="stylesheet" type="text/css" href="../css/wow/css/libs/animate.css">

</head>
<body bgcolor="#1A1A1A" class="preload">

	<center class="logincontent wow fadeInUp">

		<span class="logintitle">Daftar akun baru <b>Pustakawan</b></span>

		<div class="formcontent">
			<form action="../proses/proses_addAccount.php" method="post" autocomplete="off">
				<table align="center" cellpadding="5">
					
					<tr>
						<td width="10%">
							<i class="fa fa-card"></i>
						</td>
						<td width="90%">
							<input id="loginform2" type="text" name="name" placeholder="Nama">
						</td>
					</tr>
					<tr>
						<td width="10%">
							<i class="fa fa-user"></i>
						</td>
						<td width="90%">
							<input id="loginform" type="text" name="username" placeholder="Username">
						</td>
					</tr>
					<tr>
						<td width="10%">
							<i class="fa fa-lock"></i>
						</td>
						<td width="90%">
							<input id="loginform" type="password" name="password" placeholder="Password">
						</td>
						
					</tr>
					<tr>
						<td width="10%">
							<i class="fa fa-phone"></i>
						</td>
						<td width="90%">
							<input id="loginform" type="password" name="phone" placeholder="No. Telp">
						</td>
						
					</tr>
					<tr>
						<td colspan="2">
								<input class="loginbtn" type="submit" name="submit" value="CREATE">
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<hr class="loginhr" width="400">
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<a class="logina" href="login.php">Sudah Punya Akun Pustakawan ?</a>
						</td>
					</tr>

				</table>
			</form>
		</div>
	</center>

	<script src="../css/wow/dist/wow.min.js"></script>

    <script>
    new WOW().init();
    </script>

	<script type="text/javascript">
		$(window).load(function() {
		  $("body").removeClass("preload");
		});
	</script>

</body>
</html>