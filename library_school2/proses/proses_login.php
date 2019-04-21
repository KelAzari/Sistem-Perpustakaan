<?php  
	session_start();
	include ("connection.php");

	$user=$_POST['username'];
	$pass=$_POST['password'];

	if ($user == null || $pass == null) {
		header("Refresh:0.1; url=../pages/login.php");
		echo "<script>alert('Lengkapi form terlebih dahulu')</script>";
	}else{
		$query="SELECT * from tb_pustakawan where username=? AND password=?";
		$stmt=$db->prepare($query);
		$stmt->bindParam(1,$user);
		$stmt->bindParam(2,$pass);
		$stmt->execute();
	
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$username = $row['username'];
			$password = $row['password'];
			$nama = $row['nama'];
		}
	
		if($stmt->rowCount() == 1) {
			$_SESSION['nama']=$nama;
			header('Location:../pages/dashboard.php');
		}else{
			header("Refresh:0.1; url=../pages/login.php");
			echo "<script>alert('Username atau Password salah !')</script>";
		}
	}

	
	
?>